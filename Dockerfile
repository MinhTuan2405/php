# 1. Sử dụng PHP-FPM + Nginx (Production ready, không lỗi MPM)
FROM php:8.3-fpm

# 2. Cài đặt Nginx và các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Cấu hình Nginx
RUN rm -rf /etc/nginx/sites-enabled/* /etc/nginx/sites-available/*
COPY <<EOF /etc/nginx/sites-available/laravel
server {
    listen 80;
    server_name _;
    root /var/www/html/public;
    index index.php index.html;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
EOF

RUN ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/laravel

# 4. Cấu hình Supervisor (quản lý PHP-FPM + Nginx)
COPY <<EOF /etc/supervisor/conf.d/supervisord.conf
[supervisord]
nodaemon=true
user=root

[program:php-fpm]
command=/usr/local/sbin/php-fpm
autostart=true
autorestart=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0

[program:nginx]
command=/usr/sbin/nginx -g 'daemon off;'
autostart=true
autorestart=true
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
EOF

# 5. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Thiết lập thư mục làm việc
WORKDIR /var/www/html

# 7. Copy toàn bộ source code
COPY . .

# 8. Cài dependency PHP
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 9. Tạo thư mục cần thiết
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# 10. Phân quyền cho Laravel (www-data cho PHP-FPM và Nginx)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 11. Tạo storage link
RUN php artisan storage:link || true

# 12. Expose port
EXPOSE 80

# 13. Tạo startup script
RUN echo '#!/bin/bash\n\
php artisan migrate --force\n\
php artisan config:cache\n\
php artisan route:cache\n\
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' > /start.sh \
    && chmod +x /start.sh

# 14. Chạy supervisor để quản lý PHP-FPM + Nginx
CMD ["/start.sh"]

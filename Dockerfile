# 1. Sử dụng PHP-FPM + Nginx (Production ready)
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
RUN echo 'server {\n\
    listen 80;\n\
    server_name _;\n\
    root /var/www/html/public;\n\
    index index.php index.html;\n\
\n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
\n\
    location ~ \.php$ {\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_index index.php;\n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;\n\
        include fastcgi_params;\n\
    }\n\
\n\
    location ~ /\.ht {\n\
        deny all;\n\
    }\n\
}' > /etc/nginx/sites-available/default \
    && ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# 4. Cấu hình Supervisor để quản lý PHP-FPM + Nginx
RUN echo '[supervisord]\n\
nodaemon=true\n\
user=root\n\
\n\
[program:php-fpm]\n\
command=/usr/local/sbin/php-fpm\n\
autostart=true\n\
autorestart=true\n\
stdout_logfile=/dev/stdout\n\
stdout_logfile_maxbytes=0\n\
stderr_logfile=/dev/stderr\n\
stderr_logfile_maxbytes=0\n\
\n\
[program:nginx]\n\
command=/usr/sbin/nginx -g "daemon off;"\n\
autostart=true\n\
autorestart=true\n\
stdout_logfile=/dev/stdout\n\
stdout_logfile_maxbytes=0\n\
stderr_logfile=/dev/stderr\n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/supervisord.conf

# 5. Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Set thư mục làm việc
WORKDIR /var/www/html

# 7. Copy source code
COPY . .

# 8. Cài dependency PHP
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 9. Tạo thư mục cần thiết cho Laravel
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# 10. Set quyền cho www-data
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 11. Tạo storage link
RUN php artisan storage:link || true

# 12. Expose port 80
EXPOSE 80

# 13. Tạo startup script
RUN echo '#!/bin/bash\n\
php artisan migrate --force\n\
php artisan config:cache\n\
php artisan route:cache\n\
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' > /start.sh \
    && chmod +x /start.sh

# 14. Start với Supervisor (quản lý PHP-FPM + Nginx)
CMD ["/start.sh"]

# 1. Sử dụng image PHP với Apache
FROM php:8.4-apache

# 2. Cài đặt thư viện hệ thống
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 3. Fix Apache MPM (CÁCH ĐÚNG, KHÔNG XÓA FILE HỆ THỐNG)
RUN a2dismod mpm_event mpm_worker \
    && a2enmod mpm_prefork

# 4. Cấu hình Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Bật mod rewrite
RUN a2enmod rewrite

# 6. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Thiết lập thư mục làm việc
WORKDIR /var/www/html

# 8. Copy toàn bộ source code
COPY . .

# 9. Cài dependency PHP
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 10. Tạo thư mục cần thiết
RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# 11. Phân quyền cho Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 12. Tạo storage link
RUN php artisan storage:link || true

# 13. Expose port
EXPOSE 80

# 14. Startup command
CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && php artisan route:cache && exec apache2-foreground"]

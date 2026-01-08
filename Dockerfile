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

# 3. Fix Apache MPM - XÓA TRIỆT ĐỂ
# Xóa tất cả MPM modules (enabled và available)
RUN rm -f /etc/apache2/mods-enabled/mpm_*.conf \
    && rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && rm -f /etc/apache2/mods-available/mpm_event.* \
    && rm -f /etc/apache2/mods-available/mpm_worker.* \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load \
    && ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

# 4. Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Bật Mod Rewrite
RUN a2enmod rewrite

# 6. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Thiết lập thư mục
WORKDIR /var/www/html

# 8. Copy toàn bộ code (Bao gồm cả folder public/build bạn đã push ở bước trước)
COPY . .

# 9. Cài đặt các gói PHP (cài trong thời gian build để mọi thành viên không cần chạy composer sau khi clone)
# Ghi chú: giữ --ignore-platform-reqs để tránh lỗi platform trong môi trường khác nhau
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 10. Tạo thư mục logs và set permission
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/bootstrap/cache

# 11. Phân quyền đầy đủ cho storage và bootstrap
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 12. Tạo storage link
RUN php artisan storage:link || true

# 13. Expose Port (Railway tự động map port)
EXPOSE 80

# 14. Startup command
CMD ["sh", "-c", "php artisan migrate --force && php artisan config:cache && php artisan route:cache && exec apache2-foreground"]
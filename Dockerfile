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

# 3. Cấu hình Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Bật Mod Rewrite
RUN a2enmod rewrite

# 5. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Thiết lập thư mục
WORKDIR /var/www/html

# 7. Copy toàn bộ code (Bao gồm cả folder public/build bạn đã push ở bước trước)
COPY . .

# 8. Cài đặt các gói PHP (cài trong thời gian build để mọi thành viên không cần chạy composer sau khi clone)
# Ghi chú: giữ --ignore-platform-reqs để tránh lỗi platform trong môi trường khác nhau
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# 9. Phân quyền
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Expose Port
EXPOSE 80

# 11. Chạy server
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && apache2-foreground"]
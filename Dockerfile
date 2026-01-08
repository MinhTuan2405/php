FROM php:8.4-cli

# Cài thư viện hệ thống + PHP extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www

# Copy source code
COPY . .

# Cài dependency PHP
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# Tạo thư mục cần thiết cho Laravel
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache

# Set quyền
RUN chmod -R 775 storage bootstrap/cache

# Tạo storage link
RUN php artisan storage:link || true

# Railway dùng biến PORT
EXPOSE 8080

# Start app
CMD ["sh", "-c", "php artisan migrate --force && exec php -S 0.0.0.0:$PORT -t public"]

FROM php:8.3-cli

# Cài system libs + PHP extensions
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
        zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www

# Copy source code
COPY . .

# Cài dependency
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# Tạo thư mục cần thiết cho Laravel
RUN mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

# Storage link
RUN php artisan storage:link || true

# Railway dùng PORT động
EXPOSE 8080

# Start web server
CMD ["sh", "-c", "PORT=${PORT:-8080} && exec php -S 0.0.0.0:$PORT -t public public/index.php"]

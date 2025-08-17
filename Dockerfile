FROM php:8.2-fpm

# Cài extension PHP cần thiết
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www/portfolio-be

# Copy code vào container
COPY . .

# Cài vendor
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# FPM sẽ chạy, Nginx sẽ proxy vào
CMD ["php-fpm"]

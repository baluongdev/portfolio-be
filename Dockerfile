FROM php:8.2-fpm

# Cài extension PHP
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Làm việc tại thư mục dự án
WORKDIR /var/www/portfolio-be

# Mở cổng Laravel
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
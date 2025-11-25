# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libpng-dev libonig-dev libxml2-dev

# Install extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy project
WORKDIR /var/www
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port
EXPOSE 8000

# Run Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000

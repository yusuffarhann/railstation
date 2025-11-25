FROM webdevops/php-apache:8.2

# Atur workdir
WORKDIR /app

# Copy seluruh project
COPY . /app

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permission storage & bootstrap
RUN chmod -R 775 storage bootstrap/cache

# Generate key (opsional — nanti bisa via artisan)
# RUN php artisan key:generate

# Expose default apache port
EXPOSE 80

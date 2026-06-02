FROM dunglas/frankenphp:php8.2-alpine

# Install PHP extensions required for Laravel & MySQL
RUN install-php-extensions \
    pdo_mysql \
    pcntl \
    gd \
    zip \
    redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy all project files
COPY . .

# Install dependencies PHP via Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HTTP_TIMEOUT=600
ENV COMPOSER_PROCESS_TIMEOUT=2000

# Bypass IPv6/Timeout issues on Docker Packagist
RUN composer config --global repo.packagist composer https://packagist.org

RUN composer install --no-dev --optimize-autoloader

# Install Laravel Octane & configure server for FrankenPHP
RUN composer require laravel/octane --no-interaction \
    && php artisan octane:install --server=frankenphp --no-interaction

# Create necessary directories and set permissions
RUN mkdir -p storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    public/candidates \
    database \
    && chmod -R 777 storage bootstrap/cache public/candidates database

# Expose port 8003 for the app (as requested by user)
EXPOSE 8003

# Run server using Octane Worker Mode (FrankenPHP) on port 8003
CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8003"]

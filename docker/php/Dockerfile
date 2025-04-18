FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpq-dev

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy only composer files to leverage Docker cache
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader

# Copy the rest of the application
COPY . .

# Generate autoload files
RUN composer dump-autoload --no-scripts --optimize 
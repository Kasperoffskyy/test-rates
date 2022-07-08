FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG USER_ID
ARG GROUP_ID

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-install zip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Install Redis Extension
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

# Set working directory
WORKDIR /var/www
USER "${USER_ID}:${GROUP_ID}"

FROM php:8.2-fpm

# Cài extension cần cho Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Cài thêm tool
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

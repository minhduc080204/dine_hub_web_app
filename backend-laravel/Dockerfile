FROM php:8.2.4-apache

RUN apt-get update && apt-get install -y \
    curl \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Cài đặt Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /server

COPY package*.json ./
COPY ./app ./app
COPY ./bootstrap ./bootstrap
COPY ./config ./config
COPY ./database ./database
COPY ./public ./public
COPY ./resources ./resources
COPY ./routes ./routes
COPY ./storage ./storage
COPY ./tests ./tests
COPY .editorconfig .editorconfig
COPY .env .env
COPY artisan artisan
COPY composer.json composer.json
COPY composer.lock composer.lock
COPY phpunit.xml phpunit.xml
COPY vite.config.js vite.config.js


# Cài đặt Composer dependencies
RUN composer install

# Cài đặt npm packages
RUN npm install
EXPOSE 8000
    

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
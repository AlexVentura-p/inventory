FROM php:8.0.2-fpm as php
ARG work-dir

#php libraries
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev

WORKDIR $work-dir

# php extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql gd && docker-php-ext-enable pdo_mysql gd
RUN docker-php-ext-configure gd --enable-gd --with-jpeg

#composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#Once containers are up you can execute bash script with basic initialization commands
# located at Docker/entrypoint.sh

#For first-party api client authentication passport is available
#To create first-party client
#php artisan passport:keys
#php artisan passport:client --password

#if needed seeder also available for development
#php artisan db:seed


FROM php:8.0.2-fpm as php
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev

WORKDIR /var/www
RUN docker-php-ext-install mysqli pdo pdo_mysql gd && docker-php-ext-enable pdo_mysql gd
RUN docker-php-ext-configure gd --enable-gd --with-jpeg
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN php artisan migrate:fresh --seed
#RUN php artisan storage:link
#RUN chown -R www-data:www-data storage




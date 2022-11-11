FROM php:8.0.2-fpm as php
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip \

COPY ../ /var/www/
WORKDIR /var/www
RUN docker-php-ext-install mysqli pdo pdo_mysql gd && docker-php-ext-enable pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer



FROM nginx:1.19-alpine as nginx
RUN rm /etc/nginx/conf.d/default.conf
COPY Docker/nginx-files/ /etc/nginx/conf.d/



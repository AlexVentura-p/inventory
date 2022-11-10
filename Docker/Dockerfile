FROM php:8.0.2-fpm as php

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip
COPY ../ /var/www/
WORKDIR /var/www

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

FROM nginx:1.19-alpine as nginx
RUN rm /etc/nginx/conf.d/default.conf

COPY ../ /var/www/
COPY Docker/nginx-files/ /etc/nginx/conf.d/



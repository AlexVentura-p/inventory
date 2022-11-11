#!/bin/bash
composer install
php artisan storage:link
chown -R www-data:www-data storage
php artisan migrate

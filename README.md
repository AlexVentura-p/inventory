# Project Name


This learning project is a web application for an online store that allows customers to browse, order, and rate products, and an admin panel for managing the products and orders.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://user-images.githubusercontent.com/78453595/236002623-182edec6-e65b-4122-bac2-bc4f4a954058.png" width="700"></a></p>


## Project Details

The project includes the following features:

- Login functionality for both admin and customers
- Product list page
- Laravel Breeze for authentication on web and Laravel passport (password grant client) with API tokens for authentication on API endpoints
- postman collection with API endpoints
- MVC pattern
- CRUD functionality for admin
- Orders list page for admin with a field that shows conversion from USD to EUR by making use of Exchange Rates Data API
- Shopping cart for customers
- Rating product for customers
- Filter options on product list
- Queue jobs functionality to optimize images
- Seeders for testing data

This project was made for learning purposes, and it is developed using Laravel 8 framework.

## Requirements

- PHP 7.3 or later
- Composer
- Relational database
- Exchange Rates Data API key (https://apilayer.com/marketplace/exchangerates_data-api)

## Environment Setup using docker

There are two docker compose files, docker-composer-dev.yml for development and docker-composer-pro.yml for production, each one uses their own Dockerfile located on 'Docker' folder

## Notes for Dockerfile for development

Once containers are up you can execute bash script with basic initialization commands
located at Docker/entrypoint.sh or execute them manually on command line

To create first-party client Laravel passport(To register our application as the primary client and avoid going through the entire OAuth2 authorization code redirect flow in our own application and use username/email and password instead)
`php artisan passport:keys`
`php artisan passport:client --password` (when it asks for user provider you can leave it black and just hit enter)

!!!Remember to use given client id and secret on api register and login endpoints for email/username and password

if needed seeder also available for development
`php artisan db:seed`

## Notes for Dockerfile for production

Once containers are up you execute following commands at first start
`composer install`
`php artisan migrate --force`
`php artisan storage:link`
`chown -R www-data:www-data storage`


#For first-party api client authentication passport is available
#To create first-party client
`php artisan passport:keys`
`php artisan passport:client --password` (when it asks for user provider you can leave it black and just hit enter)

!!!Remember to use given client id and secret on api register and login endpoints for email/username and password

## Seeder usage note:
When using seeders for DEVELOPMENT purpose 2 default users are created for testing purposes, please do not use seeder for production environment:
email: av@gmail.com, password:12345678 -admin
email: a@gmail.com, password:12345678 -customer

## License

This project is licensed under the MIT License - see the `LICENSE` file for details.

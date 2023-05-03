# Inventory


This learning project is a web application for an online store that allows customers to browse, order, and rate products, and an admin panel for managing the products and orders.

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

There are two docker compose files, **docker-composer-dev.yml** for development and **docker-composer-pro.yml** for production, each one uses their own Dockerfile located on **Docker** folder

## Notes for Dockerfile for development

Once containers are up you can execute bash script with basic initialization commands
located at **Docker/entrypoint.sh** or execute them manually on command line

To create first-party client Laravel passport(To register our application as the primary client and avoid going through the entire OAuth2 authorization code redirect flow in our own application and use username/email and password instead) </br>

`php artisan passport:keys`</br>
`php artisan passport:client --password` (when it asks for user provider you can leave it black and just hit enter)

!!!Remember to use given client id and secret on api register and login endpoints for email/username and password

if needed seeder also available for development </br>
`php artisan db:seed`

## Notes for Dockerfile for production

Once containers are up you execute following commands at first start </br>
`composer install` </br>
`php artisan migrate --force` </br>
`php artisan storage:link` </br>
`chown -R www-data:www-data storage`


#For first-party api client authentication passport is available
#To create first-party client </br>
`php artisan passport:keys` </br>
`php artisan passport:client --password` (when it asks for user provider you can leave it black and just hit enter)

!!!Remember to use given client id and secret on api register and login endpoints for email/username and password

## Seeder usage note:
When using seeders for DEVELOPMENT purpose 2 default users are created for testing purposes, please do not use seeder for production environment: </br>
email: av@gmail.com, password:12345678 -admin </br>
email: a@gmail.com, password:12345678 -customer 

## License

This project is licensed under the MIT License - see the `LICENSE` file for details.

## Images
<p>
    <img src="https://user-images.githubusercontent.com/78453595/236059777-912db7f2-3a56-4efc-b070-2f4bd5daa467.png" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236060309-8e96bbc0-7af2-44d5-8651-0a562303dd51.png" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062318-bd7581f2-4bde-432d-b887-9b7971d265dc.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062455-672586a0-912b-41ef-9ae5-ebb1660ac2a9.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062485-e3c16337-f455-4a55-8541-d7aae194e5e7.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062524-f4208f6f-026d-447c-8c45-cb6125108eb1.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062584-865353e6-33df-492d-afe7-bfaa3ea12592.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062638-e060afe5-7bcf-4df7-9596-fba974b61c04.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062641-1cbfdc05-da68-43a0-9654-9c7631eee3a1.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062642-8f8ce899-ee4d-437c-ad89-da2328162cd1.JPG" width="300">
    <img src="https://user-images.githubusercontent.com/78453595/236062644-cf650912-52e6-4b20-8cf6-6929dd7a4a66.JPG" width="300">
</p>
<img src="https://user-images.githubusercontent.com/78453595/236062645-45f97b10-bcd6-4a5d-bb9e-dbf15a18762a.JPG" width="300">

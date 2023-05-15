## ## STEP 1 BACKEND SETUP

## Version Required
Laravel 9 and php >=8


Go to backend folder then follow the below steps:

``` bash
## composer install
Run composer install

## database setup
Run cp .env.example .env or copy .env.example .env
create a db an then set up your credetials.

Then Run 'php artisan optimize' command

Run 'php artisan migrate'

Necessary tables will be added then to your desire database. 

## install passport

Run 'php artisan passport:install'

``` 

## ## STEP 2 FRONTEND (cart-system) SETUP
## Version Required
vue2

Go to cart-system folder then follow the below steps:

## Build Setup

``` bash
# install dependencies
npm install

# set api url
change your API_URL,  in config/constants.php

change API_TOKEN with new user login access token in config/constants.php

# serve with hot reload at localhost:8080
npm run dev
``` 




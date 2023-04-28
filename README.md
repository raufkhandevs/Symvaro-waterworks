<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About

Symvaro-waterworks: This is the task given to me by [Symvaro](https://symvaro.com/) as a coding challenge, I used service approach to make code saleable and reuseable.

## Setup

There is no docker involves so setup is pretty simple:

-   `composer install` - Install packages
-   `cp .env.example .env` - copy .env.example
-   `php artisan key:generate` - generate `APP_KEY=`
-   `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` - Setup database credential
-   `php artisan migrate` - Run migrations
-   `php artisan db:seed` - Generate Initial data

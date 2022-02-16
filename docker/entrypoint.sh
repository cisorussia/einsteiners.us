#!/bin/sh

cp ./config_env/.env ./

php artisan storage:link
php artisan livewire:publish
php artisan key:generate

php artisan serve --host=0.0.0.0

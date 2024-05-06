#!/bin/bash

if [ "$APP_ENV" = 'production' ]; then
    cp .env.production .env
else
    cp .env.development .env
fi

php artisan config:cache
php-fpm
#!/bin/bash

composer dump-env prod

composer install --no-dev --optimize-autoloader

APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear

php bin/console doctrine:migrations:migrate

npm install

npm run build

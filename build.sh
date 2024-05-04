#!/usr/bin/bash

rm -Rf vendor/
rm -Rf node_modules/
composer install --ignore-platform-reqs
npm install
composer dump-env prod
php bin/console doctrine:schema:create
php bin/console doctrine:migrations:migrate
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear
npm cache clean
npm run build

#!/usr/bin/env bash
echo "Running composer"
composer install --no-interaction --no-progress --optimize-autoloader
composer update

echo "Generating Key..."
php artisan key:generate --show

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force
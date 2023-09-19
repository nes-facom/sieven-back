#!/usr/bin/env bash
echo "Running composer"
composer install --no-dev
composer update

echo "Generating Key..."
php artisan key:generate

echo "Clearing caches..."
php artisan optimize:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "done deploying"
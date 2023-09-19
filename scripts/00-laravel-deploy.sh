#!/usr/bin/env bash
echo "Running composer"
docker-compose exec app composer update
docker-compose exec app composer install

echo "Clearing caches..."

docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize:clear

echo "Caching config..."
docker-compose exec app php artisan config:cache


echo "Caching routes..."
docker-compose exec app php artisan route:cache

echo "Running migrations..."
docker-compose exec app php artisan migrate:fresh --seed

echo "done deploying"
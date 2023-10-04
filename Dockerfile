FROM composer:2.0 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM php:8.2-apache as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN apt-get update && apt-get install -y libpq-dev git && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=build /app /var/www/html
COPY .env.example /var/www/html/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite
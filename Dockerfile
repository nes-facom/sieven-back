FROM composer:2.0 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

FROM php:8.2-apache as production

ENV APP_ENV=production
ENV APP_DEBUG=false

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && apt-get install -y libpq-dev git && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_pgsql

COPY --from=build /app /var/www/html
COPY .env.example /var/www/html/.env

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan key:generate && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    chmod 777 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite
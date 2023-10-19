FROM php:8.1-apache AS builder

WORKDIR /var/www/html

RUN pecl install -o -f redis && docker-php-ext-enable redis
RUN apt-get update
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite && service apache2 restart
# RUN chmod -R 777 /var/www/html/storage/
# RUN php artisan key:generate


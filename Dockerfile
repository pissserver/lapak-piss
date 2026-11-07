FROM php:5.6-apache

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql && a2enmod rewrite

COPY . /var/www/html/

EXPOSE 80

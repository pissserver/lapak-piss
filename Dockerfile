FROM php:5.6-apache

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql \
    && a2enmod rewrite

COPY . /var/www/html/lapak-piss

RUN sed -i 's|^RewriteBase /lapak-piss/|RewriteBase /|' /var/www/html/lapak-piss/.htaccess \
    && sed -i 's|/var/www/html|/var/www/html/lapak-piss|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

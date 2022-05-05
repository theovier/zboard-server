FROM php:8.1-apache
RUN apt-get update && apt-get install -y libpq-dev libzip-dev zip
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

COPY ./ /var/www/html/

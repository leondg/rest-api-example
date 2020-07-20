FROM php:7.4-fpm

# libonig-dev required for mbstring
RUN apt-get update && apt-get install -y libonig-dev
RUN docker-php-ext-install mysqli mbstring 

WORKDIR /var/www
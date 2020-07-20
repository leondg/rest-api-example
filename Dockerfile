FROM php:7.4-fpm

# libonig-dev required for mbstring
RUN apt-get update && apt-get install -y libonig-dev
RUN docker-php-ext-install mysqli mbstring

# install xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

WORKDIR /var/www
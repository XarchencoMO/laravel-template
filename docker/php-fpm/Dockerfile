FROM php:8.1-fpm

# Base libs
RUN apt update && \
    apt install -y wget git unzip && \
    apt install -y libpng-dev && \
    apt install -y libzip-dev && \
    apt install -y zip && \
    apt install -y automake && \
    apt install -y openssl
# Xdebug and helpers
RUN apt install -y vim && \
    apt install -y openssh-server && \
    pecl install xdebug &&  \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo_mysql
# Composer
RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet \
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www

FROM php:8.1-fpm-alpine

# Install Helpers, Xdebug, Databases
RUN apk update && \
    apk add vim openssh-server  \
    php81-pecl-xdebug  \
    php81-pdo_mysql
# "Install" (create links to) Extensions
RUN ln -s /usr/lib/php81/modules/xdebug.so \
        /usr/local/lib/php/extensions/no-debug-non-zts-20210902/xdebug.so && \
    ln -s /usr/lib/php81/modules/pdo_mysql.so \
        /usr/local/lib/php/extensions/no-debug-non-zts-20210902/pdo_mysql.so
# Composer
RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www

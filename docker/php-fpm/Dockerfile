FROM alpine:latest

LABEL maintainer_1="XarchencoMO"
LABEL maintainer_2="andtit2001"
# php packages
RUN apk add vim openssh\
    php82 \
    php82-fpm \
    php82-ctype \
    php82-curl \
    php82-dom \
    php82-fileinfo \
    php82-ftp \
    php82-gd \
    php82-iconv \
    php82-json \
    php82-mbstring \
    php82-mysqlnd \
    php82-openssl \
    php82-pdo_mysql \
    php82-phar \
    php82-posix \
    php82-session \
    php82-sodium \
    php82-simplexml \
    php82-tokenizer \
    php82-xdebug \
    php82-xml \
    php82-xmlreader \
    php82-xmlwriter \
    php82-zlib \
    php82-zip \
    && ln -sf /usr/bin/php82 /usr/bin/php \
    && rm -rf /var/cache/apk/* \
    && cp /etc/php82/php-fpm.d/www.conf /etc/php82/php-fpm.d/docker.conf
# Composer
RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www

CMD ["/usr/sbin/php-fpm82", "-R", "--nodaemonize"]

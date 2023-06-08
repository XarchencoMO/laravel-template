FROM alpine:latest

LABEL maintainer_1="XarchencoMO"
LABEL maintainer_2="andtit2001"
# php packages
RUN apk add vim openssh\
    php81 \
    php81-fpm \
    php81-ctype \
    php81-curl \
    php81-dom \
    php81-fileinfo \
    php81-ftp \
    php81-gd \
    php81-iconv \
    php81-json \
    php81-mbstring \
    php81-mysqlnd \
    php81-openssl \
    php81-pdo_mysql \
    php81-phar \
    php81-posix \
    php81-session \
    php81-sodium \
    php81-simplexml \
    php81-tokenizer \
    php81-xdebug \
    php81-xml \
    php81-xmlreader \
    php81-xmlwriter \
    php81-zlib \
    php81-zip \
    && ln -sf /usr/bin/php81 /usr/bin/php \
    && rm -rf /var/cache/apk/* \
    && cp /etc/php81/php-fpm.d/www.conf /etc/php81/php-fpm.d/docker.conf
# Composer
RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www

CMD ["/usr/sbin/php-fpm81", "-R", "--nodaemonize"]

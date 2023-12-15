FROM php:7.4.4-fpm-alpine3.11

LABEL maintainer="volerdman@yandex.ru"

# Install gmp
RUN apk add --no-cache gmp gmp-dev libpng-dev libzip-dev icu-dev

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install opcache && \
    docker-php-ext-configure gd && \
    docker-php-ext-install -j$(nproc) gd && \
    docker-php-ext-install zip && \
    docker-php-ext-install intl

RUN docker-php-ext-install mysqli pdo pdo_mysql

ADD ./docker/php/php.ini /usr/local/etc/php
ADD ./docker/php/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# Composer
# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www

COPY . ./

RUN composer install -o

RUN chown -R www-data:www-data /var

VOLUME ["/var/www/vendor"]

CMD ["php-fpm"]

EXPOSE 9000

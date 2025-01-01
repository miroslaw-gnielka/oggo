FROM php:8.3-fpm-alpine

RUN apk update
RUN apk add bash curl git
RUN apk add icu-data-full icu-dev libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN git config --global --add safe.directory /app

RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl

RUN docker-php-ext-install zip

RUN adduser -D -s /bin/bash user

USER user

RUN git config --global user.email "user@example.com"
RUN git config --global user.name "user"

WORKDIR /app

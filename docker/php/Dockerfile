FROM composer:1.8.4 AS composer
FROM php:7.3-fpm-alpine

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app
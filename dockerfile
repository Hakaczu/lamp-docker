FROM php:8.2-apache
LABEL maintainer="Hakaczu"
RUN docker-php-ext-install mysqli pdo pdo_mysql
FROM php:8.0-fpm

# install php missing dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev \
        unzip \
        libicu-dev \
        libpq-dev \
    && docker-php-ext-install \
        opcache \
        zip \
        intl \
        pdo \
        pdo_pgsql \
    && apt-get clean

# copy php ini configuration
COPY ./php/conf.d/php.ini /usr/local/etc/php/conf.d/docker-php.ini

WORKDIR /www
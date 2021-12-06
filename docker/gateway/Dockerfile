FROM php:8.0-fpm AS base

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

FROM base AS builder

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod a+x /usr/local/bin/composer

# install symfony binary
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv $HOME/.symfony/bin/symfony /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony

# install php cs fixer
RUN curl -L https://cs.symfony.com/download/php-cs-fixer-v3.phar -o php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer \
    && chmod a+x /usr/local/bin/php-cs-fixer

# install node 16
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update && apt-get install -y --no-install-recommends nodejs && apt-get clean \
    && npm install -g yarn

FROM builder AS test

FROM builder AS dev

# install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# copy xdebug ini configuration
COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-xdebug.ini

FROM builder AS deploy

# install ssh
RUN apt-get update && apt-get install -y --no-install-recommends openssh-client && apt-get clean

FROM base AS prod
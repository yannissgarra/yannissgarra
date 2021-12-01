FROM php:8.0-fpm

# install dependencies
RUN apt-get update \
    #
    # install missing php dependencies
    && apt-get update && apt-get install -y --no-install-recommends \
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
    #
    # install xdebug
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    #
    # install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod a+x /usr/local/bin/composer \
    #
    # install symfony binary
    && curl -sS https://get.symfony.com/cli/installer | bash \
    && mv $HOME/.symfony/bin/symfony /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony \
    #
    # install php cs fixer
    && curl -L https://cs.symfony.com/download/php-cs-fixer-v3.phar -o php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer \
    && chmod a+x /usr/local/bin/php-cs-fixer \
    #
    # install git
    && apt-get update && apt-get install -y --no-install-recommends git \
    #
    # install node 16
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update && apt-get install -y --no-install-recommends nodejs \
    && npm install -g yarn

# copy php ini configuration
COPY ./php/conf.d/php.ini /usr/local/etc/php/conf.d/docker-php.ini

# copy xdebug ini configuration
COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-xdebug.ini

WORKDIR /www
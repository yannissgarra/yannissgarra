FROM php:8.0-fpm

# install general dependencies
RUN apt-get update && apt-get install -y --no-install-recommends libicu-dev libpq-dev \
    && docker-php-ext-install opcache intl pdo pdo_pgsql

# copy php ini configuration
COPY ./php/conf.d/php.ini /usr/local/etc/php/conf.d/docker-php.ini

# install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-xdebug.ini

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

WORKDIR /www
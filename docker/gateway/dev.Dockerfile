FROM registry.gitlab.com/yannissgarra/yannissgarra/gateway/build:latest

# install xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# copy xdebug ini configuration
COPY ./php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-xdebug.ini
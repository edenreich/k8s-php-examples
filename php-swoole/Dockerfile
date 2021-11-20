FROM composer AS builder
WORKDIR /app
COPY composer.json composer.lock /app/
RUN composer install --no-dev

FROM php:7.4.24-fpm-alpine3.14

RUN rm -rf /var/www/html
WORKDIR /var/www
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN apk upgrade --update \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install swoole \
    && docker-php-ext-enable swoole \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*
RUN docker-php-ext-enable swoole
RUN apk add --no-cache libstdc++
COPY --chown=www-data:www-data index.php /var/www/
COPY --from=builder --chown=www-data:www-data /app/vendor /var/www/vendor
RUN chown -R www-data:www-data /run
USER www-data

EXPOSE 9000

CMD [ "php", "./index.php" ]
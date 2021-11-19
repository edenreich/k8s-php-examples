FROM php:7.4.24-fpm-alpine3.14

RUN rm -rf /var/www/html
WORKDIR /var/www
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY --chown=www-data:www-data index.php /var/www/
USER www-data

EXPOSE 9000

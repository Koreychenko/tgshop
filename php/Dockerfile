FROM php:7.4-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && cd  / && rm -fr /src \
    && rm -rf /tmp/* 

RUN apk --update --no-cache add autoconf g++ make && \
        pecl install -f xdebug && \
        docker-php-ext-enable xdebug && \
        apk del --purge autoconf g++ make

ADD ./php.ini /usr/local/etc/php/conf.d/90-php.ini

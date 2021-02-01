FROM php:7.4-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && cd  / && rm -fr /src \
    && rm -rf /tmp/* 

RUN apk --update --no-cache add autoconf g++ make && \
        pecl install -f xdebug && \
        docker-php-ext-enable xdebug && \
        apk del --purge autoconf g++ make
RUN apk add --no-cache freetype-dev libjpeg-turbo-dev libjpeg-turbo libpng-dev
RUN apk add --no-cache libzip-dev zlib-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd zip

ADD ./php.ini /usr/local/etc/php/conf.d/90-php.ini

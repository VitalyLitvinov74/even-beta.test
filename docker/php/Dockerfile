FROM php:8.1-fpm
ARG COMPOSER_VER
ENV COMPOSER_VER ${COMPOSER_VER:-2.2.9}
USER $USER

WORKDIR /var/www/html
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash
RUN apt-get -y install nodejs \
    git \
    unzip

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libxml2-dev \
        curl

RUN docker-php-ext-install \
        soap \
        zip \
        bcmath \
        exif \
        gd \
        iconv \
        intl \
        opcache \
        pdo_mysql \
        sockets

RUN pecl install xdebug \
   && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | \
            php -- --install-dir /usr/local/bin --filename composer --version ${COMPOSER_VER}

ARG EXTERNAL_IP

COPY xdebug.ini $PHP_INI_DIR/conf.d/

USER $USER
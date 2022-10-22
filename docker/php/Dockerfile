FROM php:7.3-fpm
ARG COMPOSER_VER
ENV COMPOSER_VER ${COMPOSER_VER:-2.2.9}

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libxml2-dev \
        curl
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash
RUN apt-get -y install nodejs \
    git \
    unzip
#RUN npm --version
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install \
        soap \
        zip \
        bcmath \
        exif \
        gd \
        iconv \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        sockets

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | \
            php -- --install-dir /usr/local/bin --filename composer --version ${COMPOSER_VER}
#
#ARG PHP_EXEC_TIME
#ARG PHP_MEM_LIMIT
#ARG PHP_ERR_REPORT
#ARG UPLOAD_MAX_FILESIZE
ARG EXTERNAL_IP

COPY xdebug.ini $PHP_INI_DIR/conf.d/
RUN #echo "xdebug.client_host=${EXTERNAL_IP}" > $PHP_INI_DIR/conf.d/xdebug.ini
#RUN echo "max_execution_time = ${PHP_EXEC_TIME}" > $PHP_INI_DIR/conf.d/php_max_execution_time.ini
#RUN echo "error_reporting = ${PHP_ERR_REPORT}" > $PHP_INI_DIR/conf.d/php_error_reporting.ini
#RUN echo "upload_max_filesize=${UPLOAD_MAX_FILESIZE}" > $PHP_INI_DIR/conf.d/upload_max_filesize.ini
USER $user
FROM php:7.4-fpm

MAINTAINER Jakub Rusinowicz <rusinowiczjakub@gmail.com>

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libxml2-dev


#RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

# Type docker-php-ext-install to see available extensions

# run configure and install in the same RUN line, they extract and clean up the php source to save space
RUN docker-php-ext-install intl pdo pdo_pgsql zip intl xml json

# install xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo 'alias sf="php app/console"' >> ~/.bashrc \
&& echo 'alias sf3="php bin/console"' >> ~/.bashrc

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN apt-get install -y nodejs

RUN apt-get install nano

WORKDIR /usr/share/nginx/html

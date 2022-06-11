FROM php:8.0-fpm-bullseye
MAINTAINER SprintF

ENV TIMEZONE Europe/Moscow
ENV TZ $TIMEZONE
RUN apt-get update && apt-get install -y tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

RUN apt-get install -y curl zip unzip git libpq-dev libzip-dev libonig-dev libxml2-dev libpng-dev libc-client-dev libkrb5-dev
RUN docker-php-ext-install -j$(nproc) iconv mbstring pdo pdo_mysql zip gettext soap gd sysvsem
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN apt-get -y install wkhtmltopdf=0.12.6-1 xvfb

RUN apt-get clean && apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/ /usr/share/man/ /usr/share/locale/

RUN ln -s /usr/local/bin/php /bin/php

RUN echo 'www-data ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

ARG UID
ARG GID

RUN usermod -u ${UID} www-data
RUN groupmod -g ${GID} www-data
RUN mkdir /home/www-data && usermod --home /home/www-data www-data &&  chown -R www-data.www-data /home/www-data

RUN mkdir /var/www/.composer && chown -R www-data.www-data /var/www/.composer

USER www-data

COPY xdebug.ini /usr/local/etc/php/conf.d/
COPY php.ini /usr/local/etc/php/conf.d/
WORKDIR /app
CMD ["php-fpm","-R","-F"]

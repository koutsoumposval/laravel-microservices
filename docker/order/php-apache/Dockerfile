FROM php:7.1-apache

# Extensions PHP
RUN apt-get update && apt-get install -y \
        curl \
        git \
        libicu-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql intl

COPY php.ini /usr/local/etc/php/

# Conf apache
RUN a2enmod rewrite
COPY vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]

CMD ["apache2-foreground"]
FROM php:7.2.5-fpm
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git libpng-dev
RUN docker-php-ext-install zip && docker-php-ext-enable zip
RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client && docker-php-ext-install pdo pdo_mysql
RUN mkdir -p /var/www
COPY ./code/ /var/www/
RUN chmod +x /var/www/bin/console
EXPOSE 8080
CMD /var/www/bin/console server:run 0.0.0.0:8080
VOLUME /var/www/
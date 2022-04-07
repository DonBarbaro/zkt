FROM php:7.4-apache
RUN docker-php-ext-install mysqli
#RUN apt-get update && apt-get install -y libpq-dev
#RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
#RUN docker-php-ext-install pdo pdo_pgsql
WORKDIR /var/www/html

COPY ./src /var/www/html
EXPOSE 80

#CMD ["start-apache"]
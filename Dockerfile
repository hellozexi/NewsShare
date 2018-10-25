FROM php:5.6-apache
COPY public_html /var/www/html
RUN docker-php-ext-install mysqli

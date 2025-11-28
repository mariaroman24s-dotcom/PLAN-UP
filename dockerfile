FROM php:7.4-apache
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

COPY . .

EXPOSE 80
CMD ["apache2-foreground"]
FROM php:8.2-apache

RUN apt-get update -y && apt-get install -y \
    build-essential \
    openssl         \
    libpq-dev       \
    libzip-dev      \
    libpng-dev      \
    p7zip           \
    nginx           \
    git
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install \
    bcmath          \
    gd              \
    opcache         \
    pdo_pgsql       \
    pgsql           \
    zip

run a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 8080

RUN sed -i '/Listen 80/c\Listen 8080' /etc/apache2/ports.conf
RUN sed -i '/<VirtualHost \*:80>/c\<VirtualHost *:8080>' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

CMD ["apache2-foreground"]

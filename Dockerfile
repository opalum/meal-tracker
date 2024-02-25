# FROM php:8.2-fpm
# ARG user
# ARG uid
# RUN apt update && apt install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev
# RUN apt clean && rm -rf /var/lib/apt/lists/*
# RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user
# WORKDIR /var/www
# USER $user

FROM php:8.2

RUN apt-get update -y && apt-get install -y \
    build-essential \
    openssl         \
    libpq-dev       \
    libzip-dev      \
    libpng-dev      \
    p7zip           \
    git
RUN apt clean && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install \
    bcmath          \
    gd              \
    opcache         \
    pdo_pgsql       \
    pgsql           \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000

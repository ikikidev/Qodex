FROM php:8.2-fpm

# Instalamos dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    netcat-openbsd \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos el script de espera de la base de datos y le damos permisos
COPY wait-for-db.sh /usr/local/bin/wait-for-db.sh
RUN chmod +x /usr/local/bin/wait-for-db.sh

# Establecemos el directorio de trabajo
WORKDIR /var/www/html

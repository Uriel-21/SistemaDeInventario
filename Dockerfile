# Primero instalamos PHP
FROM php:8.4-fpm

# Usamos estas variable para poder darle permisos y no
# este dando lata con que necesita los permisos de sudo cada que editas algo
ARG user=usuario
ARG uid=1000

# Instalar las herramientas que necesita el sistema operativo
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Instalar extensiones de PHP que son necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Traer el Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crecion de usuario local en el contenedor
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user

# Creacion del entorno de ejecución
WORKDIR /var/www
USER $user

FROM php:8.2-apache

# 1. Definir el ID de usuario (el estándar en Linux suele ser 1000)
ARG USER_ID=1000
ARG GROUP_ID=1000

# 2. Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
       pdo \
       pdo_mysql \
       gd \
       intl \
       zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Forzar a que el usuario www-data use tu ID de Debian
RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

# 4. Cambiar el DocumentRoot de Apache a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Directorio de trabajo
WORKDIR /var/www/html

# Ajustar permisos de Laravel
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 6. Instalar Composer(si no lo tienes)
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin \
    --filename=composer

#si ya lo tienes y quieres reconstruir el contenedor
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Forzar a que los procesos de Apache usen el usuario sincronizado
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data

# Asegurar que las carpetas internas de Apache sean accesibles para el usuario 1000
RUN chown -R www-data:www-data /var/log/apache2 /var/lib/apache2 /var/run/apache2

# 5. Ajustar permisos de las carpetas críticas antes de terminar
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto 80 (Apache)
EXPOSE 80

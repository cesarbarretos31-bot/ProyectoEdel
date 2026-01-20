FROM php:8.2-cli

# Instalar dependencias del sistema para intl
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip unzip git \
    && docker-php-ext-install intl

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copiar proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Exponer puerto Railway
EXPOSE 8080

# Iniciar CodeIgniter desde public
CMD php -S 0.0.0.0:${PORT:-8080} -t public

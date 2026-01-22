FROM php:8.2-cli

# =========================
# DEPENDENCIAS DEL SISTEMA
# =========================
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl mysqli pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================
# COMPOSER
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# WORKDIR
# =========================
WORKDIR /app

# =========================
# COPIAR PROYECTO
# =========================
COPY . .

# =========================
# DEPENDENCIAS PHP
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# PUERTO PARA RAILWAY
# =========================
EXPOSE 8080

# =========================
# INICIAR CODEIGNITER
# =========================
CMD php -S 0.0.0.0:${PORT:-8080} -t public

# ==========================================
# Stage 1: Composer Dependencies
# ==========================================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
COPY app ./app

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

# ==========================================
# Stage 2: Production Runtime (PHP + Apache)
# ==========================================
FROM php:8.2-apache-bookworm

# Install ekstensi PostgreSQL (pdo_pgsql, pgsql) & OPcache, lalu bersihkan build deps
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpq5 \
        libpq-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_pgsql pgsql opcache \
    && apt-get purge -y --auto-remove libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Aktifkan module Apache yang dibutuhkan
RUN a2enmod rewrite headers expires remoteip

# Konfigurasi Apache & PHP Production
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/99-production.ini
COPY docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/html

# Copy kode aplikasi & vendor dari stage 1
COPY index.php .htaccess ./
COPY app ./app
COPY assets ./assets
COPY public ./public
COPY --from=vendor /app/vendor ./vendor

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]

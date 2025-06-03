FROM serversideup/php:8.2-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Copy source code dengan ownership yang benar
COPY --chown=www-data:www-data . .

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data

RUN npm ci && npm run build && rm -rf /app/.npm

USER root

EXPOSE 8000

# Jalankan hanya artisan serve saat container berjalan
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

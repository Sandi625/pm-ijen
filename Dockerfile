FROM serversideup/php:8.2-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Copy source code dengan ownership www-data
COPY --chown=www-data:www-data . .

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permission storage dan cache
RUN chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Switch user untuk npm install dan build assets
USER www-data

RUN npm ci && npm run build && rm -rf /app/.npm

# Kembali ke root user (optional)
USER root

EXPOSE 8000

# Jalankan artisan serve dan queue worker secara runtime (CMD)
CMD php artisan serve --host=0.0.0.0 --port=8000 & php artisan queue:work --tries=3

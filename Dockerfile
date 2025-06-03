FROM serversideup/php:8.2-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy application files with ownership set to www-data
COPY --chown=www-data:www-data . .

# Install Composer dependencies as root (required access to vendor folder)
RUN composer install --no-interaction --optimize-autoloader --no-dev --working-dir=/var/www/html \
    && composer clear-cache

# Switch to www-data user to install npm deps and build assets
USER www-data

RUN npm ci \
    && npm run build \
    && rm -rf /var/www/html/.npm

# Set back to root only if needed, or leave as www-data for runtime
# USER root


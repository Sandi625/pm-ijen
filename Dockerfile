FROM serversideup/php:8.2-fpm-nginx

ENV PHP_OPCACHE_ENABLE=1

USER root

# Install Node.js 20.x
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application files with ownership set to www-data
COPY --chown=www-data:www-data . .

# Switch to non-root user for security
USER www-data

# Install npm dependencies and build
RUN npm ci \
    && npm run build \
    && rm -rf /var/www/html/.npm

# Install PHP dependencies with composer (no dev, optimized)
USER root
RUN composer install --no-interaction --optimize-autoloader --no-dev --working-dir=/var/www/html

# Remove composer cache
RUN rm -rf /var/www/html/.composer/cache

# Switch back to www-data
USER www-data

#!/bin/bash
set -e

# Pastikan vendor sudah ada
if [ ! -d "vendor" ]; then
  echo "Vendor folder not found. Running composer install..."
  composer install --no-dev --optimize-autoloader
fi

php artisan serve --host=0.0.0.0 --port=${PORT} &
php artisan queue:work --tries=3

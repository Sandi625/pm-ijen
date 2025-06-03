#!/bin/bash

# Jalankan queue worker dan Vite dev server secara paralel
npx concurrently "php artisan queue:work --tries=3" "npm run serve"

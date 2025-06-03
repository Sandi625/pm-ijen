#!/bin/bash

# Start queue worker & frontend dev server concurrently
npx concurrently "php artisan queue:work --tries=3" "npm run serve"

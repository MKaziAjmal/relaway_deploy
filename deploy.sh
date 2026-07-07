#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
php artisan migrate --force

# Generate optimized caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
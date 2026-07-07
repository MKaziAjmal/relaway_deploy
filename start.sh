#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate app key if not exists
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

# Start the application
php artisan serve --host=0.0.0.0 --port=$PORT
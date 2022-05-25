#!/bin/bash
set -e

# Install Composer dependencies
composer install

# Clear all caches/routes/configs
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Migrate and freshly seed the database.
# Caution: this overwrites the whole database.
php artisan migrate:fresh --seed

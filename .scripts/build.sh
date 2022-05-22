#!/bin/bash
set -e

# Clear all caches/routes/configs
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Migrate and freshly seed the database.
# Caution: this overwrites the whole database.
php artisan migrate:fresh --seed

#!/bin/bash
set -e

echo "Build Process started ..."

# Pull the latest version
git pull origin main

# Connect to the Laravel docker container
docker exec -it api /bin/bash

# Clear all caches/routes/configs
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Migrate and freshly seed the database.
# Caution: this overwrites the whole database.
php artisan migrate:fresh --seed

# Leave the Docker container
exit

echo "Build Process finished!"

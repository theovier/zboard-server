#!/bin/bash
set -e

echo "Deploy Process started ..."

# Pull the latest version
git pull origin main

# Connect to the Laravel docker container
docker exec -i api bash < .scripts/build.sh

echo "Deploy Process finished!"

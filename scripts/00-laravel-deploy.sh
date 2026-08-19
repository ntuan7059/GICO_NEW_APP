#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

echo "Preparing Laravel storage"
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs
php artisan storage:link --force || true

echo "Running database migrations"
php artisan migrate --force

echo "Seeding production catalog"
php artisan db:seed --class=ProductionSeeder --force

echo "Caching production configuration and views"
php artisan optimize:clear
php artisan config:cache
php artisan view:cache

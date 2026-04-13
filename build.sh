#!/usr/bin/env bash
set -e

echo "=== [1/6] Installing PHP dependencies ==="
composer install --no-dev --optimize-autoloader --no-interaction

echo "=== [2/6] Installing Node dependencies ==="
npm ci

echo "=== [3/6] Building frontend assets ==="
npm run build

echo "=== [4/6] Setting up storage directory on persistent disk ==="
# Use persistent disk at /var/data for SQLite + uploads
STORAGE_DIR="${STORAGE_PATH:-/var/data/storage}"

mkdir -p "$STORAGE_DIR/app/public/events"
mkdir -p "$STORAGE_DIR/app/public/keuangan"
mkdir -p "$STORAGE_DIR/app/private"
mkdir -p "$STORAGE_DIR/framework/cache/data"
mkdir -p "$STORAGE_DIR/framework/sessions"
mkdir -p "$STORAGE_DIR/framework/views"
mkdir -p "$STORAGE_DIR/logs"

# Point Laravel storage to persistent disk
if [ -L storage ]; then rm storage; fi
if [ -d storage ] && [ ! -L storage ]; then
  cp -rn storage/. "$STORAGE_DIR" 2>/dev/null || true
  rm -rf storage
fi
ln -sfn "$STORAGE_DIR" storage

echo "=== [5/6] Running migrations & seeding ==="
DB_PATH="${DB_DATABASE:-/var/data/database.sqlite}"
touch "$DB_PATH"
php artisan migrate --force
php artisan db:seed --force

echo "=== [6/6] Caching config, routes, views ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link || true

echo "✅ Build complete!"

#!/usr/bin/env bash
# ═══════════════════════════════════════════════════════════════
#  deploy.sh — Script deploy untuk alwaysdata (jalankan via SSH)
# ═══════════════════════════════════════════════════════════════
set -e

APP_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$APP_DIR"

echo ""
echo "╔══════════════════════════════════════════╗"
echo "║   Deploy Masjid Al-Ikhlas (alwaysdata)   ║"
echo "╚══════════════════════════════════════════╝"
echo ""

# ── 1. Pull latest code ──────────────────────────────────────────
echo "[1/6] 📥 Pull kode terbaru dari Git..."
git pull origin master

# ── 2. Install PHP dependencies ──────────────────────────────────
echo "[2/6] 📦 Install PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# ── 3. Setup .env ─────────────────────────────────────────────────
echo "[3/6] ⚙️  Setup environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
    echo "⚠️  File .env dibuat. Edit dulu sebelum lanjut!"
    echo "   nano .env  (atau vi .env)"
    exit 1
fi

# ── 4. Migrate & Seed ────────────────────────────────────────────
echo "[4/6] 🗄️  Migrasi database..."
php artisan migrate --force
php artisan db:seed --force

# ── 5. Storage link ───────────────────────────────────────────────
echo "[5/6] 🔗 Storage link..."
php artisan storage:link 2>/dev/null || echo "   (sudah ada, skip)"

# ── 6. Cache optimization ─────────────────────────────────────────
echo "[6/6] ⚡ Cache config, routes, views..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ Deploy selesai!"
echo "   🌐 Website: https://USERNAME.alwaysdata.net"
echo "   🔐 Admin:   https://USERNAME.alwaysdata.net/login"
echo ""

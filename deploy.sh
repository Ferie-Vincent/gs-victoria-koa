#!/bin/bash
# Deploy GS Victoria-Koa → Hostinger via SSH
# Usage: ./deploy.sh

set -e

SSH_HOST="46.202.172.253"
SSH_PORT="65002"
SSH_USER="u928962285"
DEPLOY_PATH="/home/u928962285/domains/mediumaquamarine-chamois-708547.hostingersite.com/public_html"

echo "==> Build assets Vite..."
npm run build

echo "==> Sync assets compilés vers serveur..."
rsync -avz --progress \
  -e "ssh -p $SSH_PORT" \
  public/build/ \
  "$SSH_USER@$SSH_HOST:$DEPLOY_PATH/public/build/"

echo "==> Déploiement serveur..."
ssh -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" bash << EOF
  set -e
  cd "$DEPLOY_PATH"

  echo "  → git pull..."
  git pull origin main

  echo "  → composer install..."
  composer install --no-dev --optimize-autoloader --no-interaction

  echo "  → artisan optimize..."
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache

  echo "  → migrations..."
  php artisan migrate --force

  echo "  → permissions storage..."
  chmod -R 775 storage bootstrap/cache

  echo "  ✓ Déploiement terminé."
EOF

echo ""
echo "✓ Deploy complet → https://www.gsvictoriakoa.ci"

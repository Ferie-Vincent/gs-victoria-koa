# Suggested Commands

## Full dev stack (recommended)
```bash
composer dev
# Runs concurrently: php artisan serve + queue:listen + pail + npm run dev
```

## Individual dev commands
```bash
php artisan serve          # Laravel dev server → http://127.0.0.1:8000
npm run dev                # Vite watch (Tailwind live compile)
```

## Before FTP deployment
```bash
npm run build                                    # Generate public/build/
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Database
```bash
php artisan migrate        # Run pending migrations
php artisan migrate:fresh  # Drop + re-run (dev only)
php artisan tinker         # REPL
```

## Code quality
```bash
./vendor/bin/pint          # Laravel Pint formatter (PSR-12)
php artisan test           # PHPUnit test suite
```

## Setup (first install)
```bash
composer setup             # Full setup: install + key + migrate + npm build
```

## Key artisan utilities
```bash
php artisan key:generate --show   # For .env APP_KEY on production
php artisan storage:link          # Local only — do manually on FTP host
php artisan config:clear          # Clear cached config
```

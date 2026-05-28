# Task Completion Checklist

After any code change:

1. **Format** — `./vendor/bin/pint` (PHP files)
2. **CSS rebuild** (if Blade/CSS changed) — `npm run build`
3. **Tests** — `php artisan test` (if touching controllers/models/logic)
4. **Config clear** (if .env or config changed) — `php artisan config:clear`

Before FTP upload:
1. `npm run build`
2. `composer install --no-dev --optimize-autoloader`
3. `php artisan config:cache && php artisan route:cache && php artisan view:cache`
4. Upload all EXCEPT: `.env`, `node_modules/`, `.git/`
5. Verify `storage/` and `bootstrap/cache/` have chmod 775 on server

BMAD story completion:
- Mark story as `[x] Done` in `docs/stories/EPIC-XX-xxx.md`
- Update `docs/DESIGN_SYSTEM.md` if design tokens changed

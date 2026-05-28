# Core — GS Victoria-Koa

Groupe Scolaire VICTORIA-KOA — site web école maternelle/primaire, Abidjan CI.
Warm/familial tone. Parents target audience.

## Top-level source map

```
app/Http/Controllers/          Public controllers (HomeController…ContactController)
app/Http/Controllers/Admin/    Admin panel (AuthController, DashboardController, ActualiteController…)
app/Models/                    Eloquent models (see `mem:db_schema`)
resources/views/layouts/       app.blade.php (public), admin.blade.php (admin)
resources/views/components/    Reusable Blade components (navbar, footer, page-banner…)
resources/views/home/          Homepage section partials (hero, stats, values…)
resources/views/pages/         Full page views (home, about, classes, horaires…)
resources/views/admin/         Admin CRUD views
resources/css/app.css          Tailwind directives + CSS vars
resources/js/app.js            Alpine.js init + AOS.init + Swiper init
routes/web.php                 All routes (public + admin prefix)
public/documents/              Static PDFs (fournitures, inscriptions, calendrier)
public/images/                 Static images
docs/                          BMAD docs (prd.md, architecture.md, DESIGN_SYSTEM.md…)
```

## Critical constraints

- FTP-only deployment — no SSH, no remote artisan. All build/cache commands run locally.
- `npm run build` required before every FTP upload (generates `public/build/`).
- Do NOT commit `.env`, `node_modules/`, `.git/` to FTP.
- Storage symlink must be created manually via cPanel or PHP helper script.

## Admin panel

- Route prefix: `/admin`, named `admin.*`
- Protected by `auth` middleware (Laravel built-in)
- One-shot setup at `/setup` (creates first admin user; blocked once users exist)
- Login throttled: 6 req/min

## School info

- Address: Angré 9ème Tranche CNPS, Abidjan
- Tél: (+225) 07 67 48 55 94 / 01 43 23 84 82
- Email: direction@gsvictoriakoa.ci
- Levels: TPS, PS, MS, GS (maternelle) — CP1, CP2, CE1, CE2, CM1, CM2 (primaire)

## References

- Tech stack details: `mem:tech_stack`
- DB models: `mem:db_schema`
- Dev/build commands: `mem:suggested_commands`
- Code conventions: `mem:conventions`
- Task completion checklist: `mem:task_completion`

# Tech Stack

## Backend
- PHP ^8.3
- Laravel Framework ^13.8 (composer.json — CLAUDE.md says v12, ignore that)
- laravel/tinker ^3.0

## Frontend build
- Vite ^8.0 (ESM, `type: "module"` in package.json)
- Tailwind CSS ^3.4 (compiled locally, NOT via CDN)
- PostCSS + autoprefixer
- laravel-vite-plugin ^3.1

## Frontend runtime (all CDN, no npm install needed)
- Alpine.js v3
- AOS v2 (Animate On Scroll)
- Swiper.js v11
- GLightbox
- Google Fonts: Nunito + Baloo 2
- Heroicons (inline SVG)

## Dev dependencies (PHP)
- laravel/pint ^1.27 (code formatter)
- phpunit/phpunit ^12.5
- laravel/pail (log viewer)

## Database
- SQLite (local dev: `database/database.sqlite`)
- On shared hosting: MySQL (configured via `.env`)

## No TypeScript, no React, no Inertia.js — pure Blade + Alpine.js

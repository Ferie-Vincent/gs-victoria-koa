# Conventions

## Blade
- Every page: `@extends('layouts.app')` (public) or `@extends('layouts.admin')` (admin)
- Reusable components: `@include('components.xxx')` or `<x-xxx />`
- Home page sections: `@include('home.xxx')` partials
- View naming: **kebab-case** (`classes-preview.blade.php`)
- Pass data from controller: `return view('pages.home', compact('data'))`

## Alpine.js
- Inline in HTML: `x-data`, `x-show`, `x-bind`, `@event`
- Complex components: defined in `resources/js/app.js` via `Alpine.data('name', () => {...})`
- No build step needed for simple Alpine changes (CDN loaded)

## Tailwind CSS
- CSS vars in `resources/css/app.css`
- Must run `npm run build` before FTP upload
- Responsive breakpoints: `sm:` (640) `md:` (768) `lg:` (1024) `xl:` (1280)
- Minimum border radius: `rounded-2xl` everywhere
- Utility classes first, custom CSS only when necessary

## AOS animations
- Attributes: `data-aos="fade-up"`, `data-aos-delay="100"`, `data-aos-duration="600"`
- Variants: `fade-up`, `fade-right`, `fade-left`, `zoom-in`
- Init in `app.js`: `AOS.init({ once: true, offset: 100 })`

## PHP/Laravel
- PSR-12 (enforced by Pint)
- Controllers: thin — logic in model or service, view data via `compact()`
- Admin controllers in `App\Http\Controllers\Admin\` namespace
- No API routes — web only

## Design
- Colors from `docs/DESIGN_SYSTEM.md` — violet #7C3AED primary (see `mem:logo-identity` in project auto-memory)
- Tone: warm, colorful, familial — NOT institutional/cold
- No emojis in code/templates unless explicitly in content

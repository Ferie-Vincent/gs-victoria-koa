# EPIC-01 — Layout Global

> **Priorité :** 🔴 Critique (doit être fait en premier — tout le reste en dépend)
> **Agent :** Dev Frontend + Dev Backend

---

## Story 1.1 — Layout principal `layouts/app.blade.php`
**Statut :** `[x] Done`

**Description :** Créer le layout Blade qui wrappe toutes les pages.

**Critères d'acceptation :**
- [ ] `<head>` avec : meta charset/viewport, title dynamique (`@yield('title')`), meta description
- [ ] Google Fonts chargées (Nunito + Baloo 2)
- [ ] CDN AOS CSS chargé
- [ ] CDN Swiper CSS chargé
- [ ] CDN GLightbox CSS chargé
- [ ] `@vite('resources/css/app.css')` présent
- [ ] Alpine Intersect plugin chargé avant Alpine.js
- [ ] Alpine.js chargé en `defer`
- [ ] `@include('components.navbar')` présent
- [ ] `@yield('content')` présent
- [ ] `@include('components.footer')` présent
- [ ] `@include('components.phone-button')` présent
- [ ] CDNs JS (AOS, Swiper, GLightbox) chargés avant `@vite('resources/js/app.js')`
- [ ] `@stack('scripts')` à la fin du body
- [ ] Classe `page-transition` sur le `<body>` pour le fade-in de page

**Référence :** `docs/COMPONENTS.md` → section Layout principal

---

## Story 1.2 — Navbar `components/navbar.blade.php`
**Statut :** `[x] Done`

**Description :** Navigation sticky avec comportement scroll, dropdown "Vie Scolaire" et menu mobile.

**Critères d'acceptation :**

*Desktop :*
- [ ] `position: fixed`, `top: 0`, `z-50`
- [ ] Fond transparent par défaut
- [ ] Au scroll > 80px : fond blanc/blur + ombre violette douce (Alpine.js `@scroll.window`)
- [ ] Logo : image `public/images/logo.png` circulaire + texte "VICTORIA-KOA" (Baloo 2 bold)
- [ ] Liens : ACCUEIL, VIE SCOLAIRE ▾, INSCRIPTION, GALLERIES, ACTUALITÉS, À PROPOS
- [ ] Lien actif : souligné + couleur `text-primary` (via `request()->routeIs('xxx')`)
- [ ] Dropdown "Vie Scolaire" au hover : Les classes, Les horaires, Fournitures, Calendrier scolaire
- [ ] Dropdown : animation scale+fade depuis le haut (`x-transition`)
- [ ] Bouton "✉ Contact" outlined violet à droite (`rounded-full`)

*Mobile (< 768px) :*
- [ ] Hamburger visible (icône SVG Menu → X animé)
- [ ] Drawer slide depuis la droite (`x-show` + `x-transition:enter translate-x-full → translate-x-0`)
- [ ] Overlay sombre derrière (`bg-black/40`, click pour fermer)
- [ ] Tous les liens en vertical dans le drawer
- [ ] "Vie Scolaire" en accordéon dans le drawer

**Référence :** `docs/COMPONENTS.md` → Navbar + `docs/DESIGN_SYSTEM.md` → Navbar Alpine.js

---

## Story 1.3 — Footer `components/footer.blade.php`
**Statut :** `[x] Done`

**Description :** Pied de page 3 colonnes sur fond indigo.

**Critères d'acceptation :**
- [ ] Fond gradient `.bg-footer` (`#1E1B4B` → `#312E81`)
- [ ] 3 colonnes desktop / 1 colonne mobile
- [ ] Colonne 1 : logo blanc + texte descriptif + lien Facebook
- [ ] Colonne 2 : titre "Navigation" + 6 liens internes
- [ ] Colonne 3 : titre "Nous contacter" + 2 tels + 2 emails + adresse
- [ ] Bas : ligne de séparation + copyright `{{ date('Y') }}`
- [ ] Formes blob SVG décoratives en bas (optionnel, AOS `fade-up`)
- [ ] Tous les liens fonctionnels

**Référence :** `docs/COMPONENTS.md` → Footer

---

## Story 1.4 — Bouton téléphone `components/phone-button.blade.php`
**Statut :** `[x] Done`

**Description :** Bouton fixe en bas à droite, visible sur toutes les pages.

**Critères d'acceptation :**
- [ ] `position: fixed`, `bottom-6 right-6`, `z-50`
- [ ] Cercle violet 56px, fond `bg-primary`
- [ ] Icône téléphone SVG blanche
- [ ] Animation `animate-pulse-ring` (définie dans app.css)
- [ ] Hover : `scale(1.1)`
- [ ] `href="tel:+2250767485594"`
- [ ] `aria-label="Nous appeler"`
- [ ] Visible sur TOUTES les pages

**Référence :** `docs/COMPONENTS.md` → Bouton téléphone

---

## Story 1.5 — Composants utilitaires
**Statut :** `[x] Done`

**Description :** Créer les petits composants partagés.

**Critères d'acceptation :**
- [ ] `components/page-banner.blade.php` — paramètres `$title`, `$breadcrumb` (voir COMPONENTS.md)
- [ ] `components/section-title.blade.php` — paramètres `$title`, `$subtitle`, `$align`
- [ ] `components/blob-shape.blade.php` — paramètre `$fill`
- [ ] `components/floating-bubbles.blade.php` — 4 bulles colorées avec CSS animations

---

## Story 1.6 — CSS et JS de base
**Statut :** `[x] Done`

**Description :** Initialiser `resources/css/app.css` et `resources/js/app.js`.

**Critères d'acceptation :**
- [ ] `app.css` : directives Tailwind + toutes les variables CSS (`--color-primary`, etc.) + classes custom (`.bg-hero`, `.bg-footer`, `.shadow-violet`, etc.) + keyframes (`@keyframes float`, `pulse-ring`, `fadeIn`)
- [ ] `tailwind.config.js` : fontFamily `display` + `body`, couleurs étendues
- [ ] `app.js` : `AOS.init()` + init Swiper testimonials + init GLightbox
- [ ] `vite.config.js` : configuré pour Laravel + CSS + JS

**Référence :** `docs/DESIGN_SYSTEM.md` → section complète CSS

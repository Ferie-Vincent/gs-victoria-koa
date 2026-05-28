# Design System — Groupe Scolaire VICTORIA-KOA

> **Ton visuel :** Joyeux, coloré, chaleureux, rassurant. Une école qui ressemble à un foyer.
> **Jamais** froid, institutionnel ou corporate.

---

## 🖼️ Identité visuelle — Logo

**Fichier :** `public/images/logo.png`

| Élément | Description |
|---|---|
| **Forme** | Badge circulaire — lune croissante violette lumineuse |
| **Silhouettes** | Garçon + fille qui courent (cartables) → mouvement, joie, énergie |
| **Texte principal** | "VICTORIA-KOA" en lettres **multicolores arc-en-ciel** (rouge → orange → jaune → vert → bleu → violet) |
| **Texte circulaire** | "CENTRE MATERNEL ET PRIMAIRE" en blanc sur fond violet |
| **Ambiance** | Magique / onirique / vibrant / familial |
| **Couleur dominante** | Violet profond `#5B1A8A` → `#7C3AED` avec glow `#A855F7` |

### Règles d'utilisation du logo
- Toujours sur fond clair (blanc/crème) ou fond violet foncé
- Jamais de fond gris neutre — tue la magie
- Taille minimale : 48px × 48px
- Dans la navbar : version circulaire + texte "VICTORIA-KOA" à côté (Baloo 2 bold)
- Ne jamais recréer le logo en SVG — utiliser le PNG fourni

### Couleurs arc-en-ciel du nom (pour titres décoratifs)
```css
/* "VICTORIA-KOA" multicolore — pour hero/titres d'exception */
.text-rainbow {
  background: linear-gradient(90deg,
    #EF4444 0%,    /* V - rouge */
    #F97316 14%,   /* I - orange */
    #EAB308 28%,   /* C - jaune */
    #22C55E 42%,   /* T - vert */
    #3B82F6 57%,   /* O - bleu */
    #8B5CF6 71%,   /* R - violet */
    #EC4899 85%,   /* I - rose */
    #EF4444 100%   /* A - rouge */
  );
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
```

### Glow violet signature (optionnel sur hero/CTA)
```css
.glow-violet {
  box-shadow: 0 0 40px rgba(124, 58, 237, 0.5),
              0 0 80px rgba(168, 85, 247, 0.2);
}
```

---

## 🎨 Palette de couleurs

Définir dans `resources/css/app.css` :

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

:root {
  --color-primary:        #7C3AED;   /* Violet profond */
  --color-primary-light:  #A78BFA;   /* Violet clair */
  --color-secondary:      #F59E0B;   /* Jaune soleil */
  --color-accent-pink:    #EC4899;   /* Rose vif */
  --color-accent-teal:    #14B8A6;   /* Turquoise */
  --color-accent-orange:  #F97316;   /* Orange */
  --color-accent-green:   #22C55E;   /* Vert */

  --color-bg-main:        #FEFCE8;   /* Crème très doux */
  --color-bg-section:     #F5F3FF;   /* Lavande légère */
  --color-bg-dark:        #1E1B4B;   /* Indigo nuit */
  --color-logo-glow:      #A855F7;   /* Violet glow du logo */
  --color-logo-deep:      #5B1A8A;   /* Violet profond du logo */

  --color-text-dark:      #1E1B4B;
  --color-text-gray:      #6B7280;
  --color-text-light:     #F9FAFB;
}

/* Ombres colorées signature */
.shadow-violet { box-shadow: 0 10px 40px rgba(124, 58, 237, 0.2); }
.shadow-yellow  { box-shadow: 0 10px 40px rgba(245, 158, 11, 0.2); }
.shadow-pink    { box-shadow: 0 10px 40px rgba(236, 72, 153, 0.2); }
.shadow-teal    { box-shadow: 0 10px 40px rgba(20, 184, 166, 0.2); }

/* Float animation (bulles de fond) */
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50%       { transform: translateY(-20px); }
}
.animate-float-1 { animation: float 3s ease-in-out infinite; }
.animate-float-2 { animation: float 3.5s ease-in-out infinite 0.5s; }
.animate-float-3 { animation: float 4s ease-in-out infinite 1s; }
.animate-float-4 { animation: float 3.2s ease-in-out infinite 1.5s; }

/* Pulse téléphone */
@keyframes pulse-ring {
  0%   { transform: scale(1); opacity: 1; }
  100% { transform: scale(1.4); opacity: 0; }
}
.animate-pulse-ring::after {
  content: '';
  position: absolute;
  inset: -4px;
  border-radius: 50%;
  background: rgba(124,58,237,0.4);
  animation: pulse-ring 1.5s ease-out infinite;
}

/* Gradient backgrounds */
.bg-hero    { background: linear-gradient(135deg, #7C3AED 0%, #EC4899 100%); }
.bg-footer  { background: linear-gradient(135deg, #1E1B4B 0%, #312E81 100%); }

/* Transition page douce */
.page-transition { animation: fadeIn 0.4s ease-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
```

### Tailwind config (`tailwind.config.js`)

```js
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ['"Baloo 2"', 'cursive'],
        body:    ['Nunito', 'sans-serif'],
      },
      colors: {
        primary:   '#7C3AED',
        secondary: '#F59E0B',
        pink:      '#EC4899',
        teal:      '#14B8A6',
      },
    },
  },
};
```

---

## 🔤 Typographies

```html
<!-- Dans layouts/app.blade.php <head> -->
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
```

| Usage | Police | Classe Tailwind |
|---|---|---|
| Titres H1/H2 (hero, sections) | Baloo 2 800 | `font-display font-extrabold` |
| Titres H3/H4 (cards) | Baloo 2 700 | `font-display font-bold` |
| Corps texte | Nunito 400 | `font-body` |
| Labels, nav | Nunito 600 | `font-body font-semibold` |
| Chiffres stats | Baloo 2 800 | `font-display font-extrabold text-5xl` |

---

## 📐 Règles de forme

| Règle | Valeur |
|---|---|
| Border-radius minimum | `rounded-2xl` (16px) |
| Border-radius cards | `rounded-3xl` (24px) |
| Border-radius boutons | `rounded-full` ou `rounded-2xl` |
| Ombres | Colorées uniquement (pas de shadow grise pure) |
| Hover cards | `translateY(-8px)` + ombre renforcée |
| Transition par défaut | `transition-all duration-300 ease-out` |

---

## 🎬 Animations — Référence complète

> **AOS (Animate On Scroll)** remplace Framer Motion. Chargé via CDN.

### Setup AOS (dans `resources/js/app.js`)

```js
import AOS from 'https://unpkg.com/aos@2.3.4/dist/aos.js';

document.addEventListener('DOMContentLoaded', () => {
  AOS.init({
    once:     true,      // Anime une seule fois
    offset:   100,       // Déclenche 100px avant l'élément
    duration: 600,       // Durée par défaut (ms)
    easing:   'ease-out-cubic',
  });
});
```

CDN dans le layout :
```html
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
```

### Attributs AOS par type d'élément

| Élément | Attributs AOS |
|---|---|
| Titre de section | `data-aos="fade-up" data-aos-duration="600"` |
| Sous-titre | `data-aos="fade-up" data-aos-delay="100"` |
| Card 1 d'une rangée | `data-aos="fade-up" data-aos-delay="0"` |
| Card 2 d'une rangée | `data-aos="fade-up" data-aos-delay="100"` |
| Card 3 d'une rangée | `data-aos="fade-up" data-aos-delay="200"` |
| Image latérale | `data-aos="fade-right"` ou `data-aos="fade-left"` |
| CTA bouton | `data-aos="zoom-in" data-aos-delay="300"` |
| Timeline étape | `data-aos="fade-up" data-aos-delay="100"` (incrémenté) |

---

## 🏔️ Navbar — Alpine.js (comportement scroll + dropdown)

```html
<nav
  x-data="{
    scrolled: false,
    mobileOpen: false,
    dropdown: false,
    init() {
      window.addEventListener('scroll', () => {
        this.scrolled = window.scrollY > 80;
      });
    }
  }"
  :class="scrolled
    ? 'bg-white/95 backdrop-blur-md shadow-lg shadow-purple-100/50'
    : 'bg-transparent'"
  class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
  <!-- Dropdown Vie Scolaire -->
  <div
    x-data
    @mouseenter="dropdown = true"
    @mouseleave="dropdown = false"
    class="relative"
  >
    <button class="...">Vie Scolaire ▾</button>
    <div
      x-show="dropdown"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
      x-transition:enter-end="opacity-100 scale-100 translate-y-0"
      class="absolute top-full left-0 bg-white rounded-2xl shadow-xl shadow-purple-100 p-2 min-w-52"
    >
      <!-- Items dropdown -->
    </div>
  </div>

  <!-- Mobile drawer -->
  <div
    x-show="mobileOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    class="fixed inset-y-0 right-0 w-80 bg-white shadow-2xl z-50"
  >
    <!-- Menu mobile -->
  </div>

  <!-- Overlay mobile -->
  <div
    x-show="mobileOpen"
    @click="mobileOpen = false"
    class="fixed inset-0 bg-black/40 z-40"
  ></div>
</nav>
```

---

## 🔢 Compteur animé — Alpine.js

```html
<div
  x-data="{
    value: 0,
    target: 350,
    suffix: '+',
    started: false,
    start() {
      if (this.started) return;
      this.started = true;
      const step = this.target / 60;
      const interval = setInterval(() => {
        this.value = Math.min(this.value + step, this.target);
        if (this.value >= this.target) clearInterval(interval);
      }, 30);
    }
  }"
  x-intersect:enter="start()"
>
  <span class="font-display font-extrabold text-5xl text-primary"
        x-text="Math.round(value) + suffix">0</span>
</div>
```

> `x-intersect` nécessite le plugin Alpine Intersect :
```html
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
```

---

## 🎠 Swiper.js — Configuration témoignages

```js
// Dans app.js
import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

const testimonialSwiper = new Swiper('.swiper-testimonials', {
  loop:      true,
  autoplay:  { delay: 4000, disableOnInteraction: false },
  pagination:{ el: '.swiper-pagination', clickable: true },
  slidesPerView: 1,
  spaceBetween: 32,
  breakpoints: {
    768:  { slidesPerView: 2 },
    1024: { slidesPerView: 3 },
  },
});
```

---

## 🖼️ GLightbox — Galerie photos

```js
import GLightbox from 'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js';

const lightbox = GLightbox({ selector: '.glightbox' });
```

```html
<!-- Chaque photo dans la grille -->
<a href="/images/gallery/photo.jpg" class="glightbox" data-gallery="gallery1">
  <img src="/images/gallery/photo-thumb.jpg" alt="..." class="rounded-2xl hover:scale-105 transition-transform duration-300" />
</a>
```

---

## 🌊 Séparateurs SVG (BlobShape)

```html
<!-- Inclure via @include('components.blob-shape', ['fill' => '#F5F3FF', 'flip' => false]) -->
<div aria-hidden="true" class="overflow-hidden leading-none">
  <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
    <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="{{ $fill }}" />
  </svg>
</div>
```

---

## 🫧 Bulles flottantes (décoratives)

```html
<!-- Inclure dans les sections hero/CTA, position: relative overflow-hidden sur le parent -->
<div aria-hidden="true" class="absolute inset-0 pointer-events-none overflow-hidden">
  <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-yellow-300/30 animate-float-1"></div>
  <div class="absolute top-1/3 right-16 w-14 h-14 rounded-full bg-pink-300/30 animate-float-2"></div>
  <div class="absolute bottom-20 left-1/4 w-10 h-10 rounded-full bg-teal-300/30 animate-float-3"></div>
  <div class="absolute bottom-10 right-1/3 w-16 h-16 rounded-full bg-purple-300/30 animate-float-4"></div>
</div>
```

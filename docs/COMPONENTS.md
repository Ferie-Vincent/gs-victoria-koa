# Composants Blade — Groupe Scolaire VICTORIA-KOA

> Tous les composants sont des vues Blade dans `resources/views/components/` ou `resources/views/home/`.
> L'interactivité est assurée par Alpine.js. Les animations par AOS.

---

## 🏗️ Layout principal — `layouts/app.blade.php`

```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Groupe Scolaire VICTORIA-KOA') — École Maternelle & Primaire à Abidjan</title>
  <meta name="description" content="@yield('description', 'Groupe Scolaire VICTORIA-KOA : école maternelle et primaire à Angré, Abidjan. Inscriptions ouvertes.')">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- AOS -->
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

  <!-- Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <!-- GLightbox -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css" />

  <!-- Tailwind compilé -->
  @vite('resources/css/app.css')

  <!-- Alpine.js plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-body bg-white text-[--color-text-dark] page-transition">

  @include('components.navbar')

  <main>
    @yield('content')
  </main>

  @include('components.footer')
  @include('components.phone-button')

  <!-- Scripts CDN -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>

  @vite('resources/js/app.js')
  @stack('scripts')
</body>
</html>
```

---

## 🧭 Navbar — `components/navbar.blade.php`

**Comportement :**
- Sticky `fixed top-0`, `z-50`
- Fond transparent → blanc/blur après 80px scroll (Alpine.js + `@scroll.window`)
- Lien actif détecté via `request()->routeIs('xxx')`
- Dropdown "Vie Scolaire" au hover sur desktop
- Hamburger → drawer slide depuis la droite sur mobile

**Structure HTML :**
```
[Logo]   [ACCUEIL] [VIE SCOLAIRE ▾] [INSCRIPTION] [GALLERIES] [ACTUALITÉS] [À PROPOS]   [✉ Contact]
```

**Lien actif :** `{{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary' : 'text-gray-700 hover:text-primary' }}`

**Dropdown items :**
| Label | Route |
|---|---|
| 📚 Les classes | `route('classes')` |
| ⏰ Les horaires | `route('horaires')` |
| 📦 Liste des fournitures | `route('fournitures')` |
| 📅 Calendrier scolaire | `route('calendrier')` |

**Voir le pattern Alpine.js complet dans `docs/DESIGN_SYSTEM.md`.**

---

## 🦶 Footer — `components/footer.blade.php`

**Fond :** `.bg-footer` (gradient indigo `#1E1B4B` → `#312E81`)

**Structure 3 colonnes :**

**Col 1 — Identité :**
- Logo blanc `<img src="{{ asset('images/logo.png') }}" alt="Logo VICTORIA-KOA" class="h-16 brightness-0 invert">`
- Description : *"Le Groupe Scolaire Victoria-Koa, situé à Cocody-Bonoumin, est un établissement scolaire reconnu pour son engagement. Il accueille des élèves dans un cadre structuré et de qualité, faisant l'objet de la confiance de nombreux parents."*
- Lien Facebook : `https://facebook.com/CM.VICTORIA.KOA/`

**Col 2 — Navigation :**
- Titre avec underline coloré
- Liens : Accueil, À propos, Nos classes, Inscription, Actualités, Contact

**Col 3 — Contact :**
- 📞 (+225) 07 67 48 55 94
- 📞 (+225) 01 43 23 84 82
- ✉️ direction@gsvictoriakoa.ci
- ✉️ victoria-koa1965@gemail.com
- 📍 Angré 9ème Tranche, Abidjan

**Bas :** `© Copyright {{ date('Y') }} – Groupe Scolaire VICTORIA-KOA. Tous droits réservés`

---

## 📞 Bouton téléphone — `components/phone-button.blade.php`

```html
<a
  href="tel:+2250767485594"
  class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-primary
         flex items-center justify-center shadow-violet animate-pulse-ring
         relative hover:scale-110 transition-transform duration-200"
  aria-label="Nous appeler"
>
  <!-- Heroicon phone -->
  <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
  </svg>
</a>
```

---

## 🏷️ Bannière page — `components/page-banner.blade.php`

Utilisée en haut de chaque page secondaire.

```html
<!-- Appel : @include('components.page-banner', ['title' => 'Les classes', 'breadcrumb' => 'Accueil / Les classes']) -->
<section class="bg-hero relative overflow-hidden" style="height: 280px">
  <!-- Bulles décoratives -->
  @include('components.floating-bubbles')

  <!-- Formes géométriques coins -->
  <div aria-hidden="true" class="absolute top-6 right-10 w-16 h-16 rounded-full bg-white/10"></div>
  <div aria-hidden="true" class="absolute bottom-6 left-10 w-10 h-10 rounded-2xl bg-yellow-300/20 rotate-12"></div>

  <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4">
    <p class="text-white/70 text-sm font-body mb-2">{{ $breadcrumb ?? 'Accueil / ' . $title }}</p>
    <h1 class="font-display font-extrabold text-4xl md:text-5xl text-white" data-aos="fade-up">
      {{ $title }}
    </h1>
  </div>
</section>
```

---

## 🔡 Titre de section — `components/section-title.blade.php`

```html
<!-- Appel : @include('components.section-title', ['title' => 'Nos Valeurs', 'subtitle' => '...', 'align' => 'center']) -->
<div class="{{ ($align ?? 'center') === 'center' ? 'text-center' : 'text-left' }} mb-12" data-aos="fade-up">
  <h2 class="font-display font-extrabold text-3xl md:text-4xl text-[--color-text-dark] mb-3">
    {{ $title }}
  </h2>
  <div class="h-1 w-16 rounded-full bg-primary {{ ($align ?? 'center') === 'center' ? 'mx-auto' : '' }} mb-4"></div>
  @if(isset($subtitle))
    <p class="text-[--color-text-gray] text-lg max-w-2xl {{ ($align ?? 'center') === 'center' ? 'mx-auto' : '' }}">
      {{ $subtitle }}
    </p>
  @endif
</div>
```

---

## 📄 Page Home — `pages/home.blade.php`

```php
@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
  @include('home.hero')
  @include('home.welcome')
  @include('home.values')
  @include('home.activities')
  @include('home.enrollment-cta')
  @include('home.stats')
  @include('home.classes-preview')
  @include('home.how-to-enroll')
  @include('home.testimonials')
  @include('home.recent-news')
  @include('home.contact-form')
@endsection
```

---

## 🏠 Composants Home

### `home/hero.blade.php`

- Section `min-h-screen` avec `.bg-hero` + overlay pointillés
- Layout 2 colonnes (`lg:grid-cols-2`)
- Bulles flottantes (`@include('components.floating-bubbles')`)
- Titre + typewriter simulé avec CSS animation `@keyframes blink`

**Contenu textuel complet → voir `docs/pages/HOME.md` Section 1**

### `home/stats.blade.php`

- Fond `#FEF9C3`, 4 colonnes
- Utilise le compteur Alpine.js (voir DESIGN_SYSTEM.md)
- `x-intersect:enter` pour déclencher le compteur

```php
@php
$stats = [
  ['value' => 10,  'suffix' => '+', 'label' => "ans d'Expériences", 'icon' => '🏫', 'color' => 'violet'],
  ['value' => 12,  'suffix' => '',  'label' => 'Classes',            'icon' => '📚', 'color' => 'yellow'],
  ['value' => 350, 'suffix' => '+', 'label' => 'Élèves',             'icon' => '👧', 'color' => 'pink'],
  ['value' => 25,  'suffix' => '',  'label' => 'Enseignants',        'icon' => '👩‍🏫', 'color' => 'teal'],
];
@endphp
```

### `home/classes-preview.blade.php`

```php
@php
$classes = [
  // Maternelle
  ['code' => 'TPS', 'name' => 'Toute Petite Section', 'cycle' => 'maternelle', 'pdf' => 'fournitures/TPS-2025-2026.pdf'],
  ['code' => 'PS',  'name' => 'Petite Section',        'cycle' => 'maternelle', 'pdf' => 'fournitures/PS-2025-2026.pdf'],
  ['code' => 'MS',  'name' => 'Moyenne Section',       'cycle' => 'maternelle', 'pdf' => 'fournitures/MS-2025-2026.pdf'],
  ['code' => 'GS',  'name' => 'Grande Section',        'cycle' => 'maternelle', 'pdf' => 'fournitures/GS-2025-2026.pdf'],
  // Primaire
  ['code' => 'CP1', 'name' => 'Cours Préparatoire 1',  'cycle' => 'primaire',   'pdf' => 'fournitures/CP-2025-2026.pdf'],
  ['code' => 'CP2', 'name' => 'Cours Préparatoire 2',  'cycle' => 'primaire',   'pdf' => 'fournitures/CP-2025-2026.pdf'],
  ['code' => 'CE1', 'name' => 'Cours Élémentaire 1',   'cycle' => 'primaire',   'pdf' => 'fournitures/CE1-2025-2026.pdf'],
  ['code' => 'CE2', 'name' => 'Cours Élémentaire 2',   'cycle' => 'primaire',   'pdf' => 'fournitures/CE2-2025-2026.pdf'],
  ['code' => 'CM1', 'name' => 'Cours Moyen 1',         'cycle' => 'primaire',   'pdf' => 'fournitures/CM1-2025-2026.pdf'],
  ['code' => 'CM2', 'name' => 'Cours Moyen 2',         'cycle' => 'primaire',   'pdf' => 'fournitures/CM2-2025-2026.pdf'],
];
@endphp
```

Couleurs cycles :
- `maternelle` → `bg-purple-100 text-purple-700`
- `primaire` → `bg-orange-100 text-orange-700`

### `home/testimonials.blade.php`

```php
@php
$testimonials = [
  [
    'quote'   => "Mon fils est épanoui depuis qu'il est à Victoria-Koa. Les enseignants sont attentionnés et l'ambiance est vraiment familiale. Je recommande cette école à tous les parents !",
    'author'  => 'Mme Koné Adjoua',
    'role'    => "maman d'Ange, CP1",
    'initials'=> 'KA',
    'color'   => 'bg-purple-500',
  ],
  [
    'quote'   => "Nous avons choisi Victoria-Koa pour la qualité de l'enseignement et nous n'avons pas été déçus. Ma fille a fait d'énormes progrès en lecture et en mathématiques.",
    'author'  => 'M. Traoré Seydou',
    'role'    => 'papa de Fatoumata, CE1',
    'initials'=> 'TS',
    'color'   => 'bg-yellow-500',
  ],
  [
    'quote'   => "L'équipe pédagogique est vraiment dévouée. Le suivi individualisé de chaque enfant est remarquable. On se sent vraiment écouté en tant que parent.",
    'author'  => 'Mme Bamba Aminata',
    'role'    => 'maman de Junior, MS',
    'initials'=> 'BA',
    'color'   => 'bg-pink-500',
  ],
  [
    'quote'   => "Victoria-Koa c'est bien plus qu'une école, c'est une famille. Mon enfant pleure quand il ne peut pas y aller ! Les activités périscolaires sont fantastiques.",
    'author'  => 'M. Coulibaly Ibrahim',
    'role'    => 'papa de Youssouf, GS',
    'initials'=> 'CI',
    'color'   => 'bg-teal-500',
  ],
];
@endphp

<div class="swiper swiper-testimonials">
  <div class="swiper-wrapper">
    @foreach($testimonials as $t)
    <div class="swiper-slide">
      <!-- Card témoignage -->
    </div>
    @endforeach
  </div>
  <div class="swiper-pagination"></div>
</div>
```

### `home/contact-form.blade.php`

```html
<form method="POST" action="{{ route('contact.send') }}">
  @csrf
  <!-- Champs : name, email, phone -->
  <!-- Message flash depuis session('success') -->
  @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-green-700">
      ✅ {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <!-- Erreurs de validation -->
  @endif
</form>
```

---

## 🖼️ Galerie — `components/photo-grid.blade.php`

```html
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
  @foreach($photos as $i => $photo)
  <a
    href="{{ $photo['src'] }}"
    class="glightbox block overflow-hidden rounded-2xl aspect-square group"
    data-gallery="gallery-main"
    data-aos="zoom-in"
    data-aos-delay="{{ ($i % 4) * 50 }}"
  >
    <img
      src="{{ $photo['thumb'] ?? $photo['src'] }}"
      alt="{{ $photo['alt'] }}"
      class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
      loading="lazy"
    />
  </a>
  @endforeach
</div>
```

---

## 📋 Formulaire de contact — `ContactController`

```php
public function send(Request $request)
{
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:20',
        'message' => 'required|string|min:10|max:2000',
    ]);

    Mail::to('direction@gsvictoriakoa.ci')
        ->send(new ContactFormMail($data));

    return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondons rapidement !');
}
```

<!DOCTYPE html>
<html lang="fr" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $defaultOgImage = asset('images/hero/20260128_113736-1-scaled-e1771086502923-995x1024.jpg');
        $anneeEnCours   = \App\Models\Setting::schoolYear();
    @endphp

    @hasSection('seo_title')
        <title>@yield('seo_title')</title>
    @else
        <title>@yield('title', 'Groupe Scolaire VICTORIA-KOA') | GS VICTORIA-KOA</title>
    @endif

    {{-- ── SEO Google ──────────────────────────────────── --}}
    <meta name="description"  content="@yield('meta_description', 'Groupe Scolaire VICTORIA-KOA — École maternelle et primaire à Angré 9ème Tranche, Abidjan. Niveaux TPS à CM2. Inscriptions ouvertes 2025-2026.')">
    <meta name="robots"       content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="author"       content="Groupe Scolaire VICTORIA-KOA">
    <meta name="keywords"     content="@yield('meta_keywords', 'école maternelle Abidjan, école primaire Angré, VICTORIA-KOA, inscription scolaire, Côte d\'Ivoire, TPS PS MS GS CP CE CM')">
    <meta name="geo.region"   content="CI">
    <meta name="geo.placename" content="Abidjan, Côte d'Ivoire">
    <meta name="language"     content="French">
    <link rel="canonical"     href="@yield('canonical', url()->current())">

    {{-- ── Open Graph (Facebook · LinkedIn · WhatsApp) ─── --}}
    <meta property="og:type"        content="@yield('meta_og_type', 'website')">
    <meta property="og:site_name"   content="Groupe Scolaire VICTORIA-KOA">
    <meta property="og:locale"      content="fr_FR">
    @hasSection('seo_title')
    <meta property="og:title"       content="@yield('seo_title')">
    @else
    <meta property="og:title"       content="@yield('title', 'Groupe Scolaire VICTORIA-KOA') | GS VICTORIA-KOA">
    @endif
    <meta property="og:description" content="@yield('meta_description', 'École maternelle et primaire à Angré, Abidjan. Inscriptions 2025-2026 ouvertes.')">
    <meta property="og:url"         content="@yield('canonical', url()->current())">
    <meta property="og:image"       content="@yield('meta_image', $defaultOgImage)">
    <meta property="og:image:alt"   content="Groupe Scolaire VICTORIA-KOA — Angré, Abidjan">
    <meta property="og:image:width" content="995">
    <meta property="og:image:height" content="1024">
    @stack('og_extra')

    {{-- ── Twitter Card (X · partage mobile) ─────────────── --}}
    <meta name="twitter:card"        content="summary_large_image">
    @hasSection('seo_title')
    <meta name="twitter:title"       content="@yield('seo_title')">
    @else
    <meta name="twitter:title"       content="@yield('title', 'Groupe Scolaire VICTORIA-KOA') | GS VICTORIA-KOA">
    @endif
    <meta name="twitter:description" content="@yield('meta_description', 'École maternelle et primaire à Angré, Abidjan. Inscriptions 2025-2026 ouvertes.')">
    <meta name="twitter:image"       content="@yield('meta_image', $defaultOgImage)">
    <meta name="twitter:image:alt"   content="Groupe Scolaire VICTORIA-KOA">

    {{-- ── JSON-LD — Schema.org EducationalOrganization ─── --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Groupe Scolaire VICTORIA-KOA",
        "alternateName": "GS VICTORIA-KOA",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo/logo-2-2.png') }}",
        "image": "{{ asset('images/hero/20260128_113736-1-scaled-e1771086502923-995x1024.jpg') }}",
        "description": "École maternelle et primaire à Angré 9ème Tranche, Abidjan (Côte d'Ivoire). Niveaux TPS, PS, MS, GS, CP1, CP2, CE1, CE2, CM1, CM2.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Angré 9ème Tranche CNPS en haut, face Pâtisserie MARY'S",
            "addressLocality": "Abidjan",
            "addressCountry": "CI"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "5.3779",
            "longitude": "-3.9683"
        },
        "telephone": ["+2250767485594", "+2250143238482"],
        "email": "direction@gsvictoriakoa.ci",
        "sameAs": ["https://www.facebook.com/CM.VICTORIA.KOA/"],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Niveaux scolaires",
            "itemListElement": [
                {"@type": "Offer", "itemOffered": {"@type": "Course", "name": "Maternelle (TPS, PS, MS, GS)"}},
                {"@type": "Offer", "itemOffered": {"@type": "Course", "name": "Primaire (CP1, CP2, CE1, CE2, CM1, CM2)"}}
            ]
        },
        "openingHoursSpecification": [
            {"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"], "opens": "07:30", "closes": "18:00"}
        ]
    }
    </script>
    @stack('structured_data')

    {{-- Favicon --}}
    <link rel="icon"             type="image/png" href="{{ asset('images/logo/logo-2-2.png') }}">
    <link rel="apple-touch-icon"                  href="{{ asset('images/logo/logo-2-2.png') }}">

    {{-- Google Fonts : Baloo 2 + Nunito --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;700;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- AOS CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- GLightbox CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">

    {{-- Flaticon Uicons --}}
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">

    {{-- Tailwind compilé --}}
    @vite('resources/css/app.css')

    @stack('head')

    {{-- Preloader styles (inline = visible avant tout CDN/Vite) --}}
    <style>
        #preloader {
            position: fixed; inset: 0; z-index: 9999;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 20px;
            background: linear-gradient(135deg, #7C3AED 0%, #5B1A8A 50%, #1E1B4B 100%);
            transition: opacity 0.55s ease, visibility 0.55s ease;
        }
        #preloader.hidden { opacity: 0; visibility: hidden; }

        .pre-logo-wrap {
            position: relative; width: 96px; height: 96px;
            display: flex; align-items: center; justify-content: center;
        }
        .pre-logo-wrap img {
            width: 64px; height: 64px; object-fit: contain;
            border-radius: 16px; position: relative; z-index: 1;
        }
        .pre-ring {
            position: absolute; inset: 0;
            border-radius: 50%;
            border: 2.5px dashed rgba(255,255,255,0.5);
            animation: pre-spin 2.5s linear infinite;
        }
        .pre-ring-inner {
            position: absolute; inset: 10px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            animation: pre-spin-rev 4s linear infinite;
        }
        @@keyframes pre-spin     { to { transform: rotate(360deg);  } }
        @@keyframes pre-spin-rev { to { transform: rotate(-360deg); } }

        .pre-dots {
            display: flex; gap: 7px; align-items: center;
        }
        .pre-dots span {
            width: 7px; height: 7px; border-radius: 50%;
            background: rgba(255,255,255,0.7);
            animation: pre-bounce 1.2s ease-in-out infinite;
        }
        .pre-dots span:nth-child(1) { animation-delay: 0s;    }
        .pre-dots span:nth-child(2) { animation-delay: 0.2s;  }
        .pre-dots span:nth-child(3) { animation-delay: 0.4s;  }
        @@keyframes pre-bounce {
            0%, 80%, 100% { transform: scale(0.7); opacity: 0.4; }
            40%            { transform: scale(1.2); opacity: 1;   }
        }

        .pre-name {
            font-family: 'Baloo 2', sans-serif;
            font-weight: 700; font-size: 13px;
            letter-spacing: 0.18em; text-transform: uppercase;
            color: rgba(255,255,255,0.75);
        }
    </style>
</head>
<body class="page-transition font-body bg-white text-dark antialiased flex flex-col min-h-screen">

    {{-- Preloader --}}
    <div id="preloader" role="status" aria-label="Chargement en cours">
        <div class="pre-logo-wrap">
            <div class="pre-ring"></div>
            <div class="pre-ring-inner"></div>
            <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="GS Victoria-Koa">
        </div>
        <p class="pre-name">GS Victoria-Koa</p>
        <div class="pre-dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>
    </div>

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Contenu principal --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Effets saisonniers --}}
    @include('components.seasonal-effects')

    {{-- Éléments décoratifs flottants --}}
    @include('components.sticky-elements')

    {{-- Bouton téléphone flottant --}}
    @include('components.phone-button')

    {{-- Bouton retour en haut --}}
    @include('components.scroll-top')

    {{-- Alpine Intersect (avant Alpine.js) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- GLightbox JS --}}
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>

    {{-- App JS --}}
    @vite('resources/js/app.js')

    @stack('scripts')

    <script>
        (function () {
            var el = document.getElementById('preloader');
            function hide() { el.classList.add('hidden'); }
            if (document.readyState === 'complete') {
                setTimeout(hide, 200);
            } else {
                window.addEventListener('load', function () { setTimeout(hide, 200); });
            }
        })();
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — GS Victoria-Koa</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-2-2.png') }}">

    {{-- Flaticon Uicons --}}
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">

    @vite('resources/css/app.css')
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"
            integrity="sha384-9Ax3MmS9AClxJyd5/zafcXXjxmwFhZCdsT6HJoJjarvCaAkJlk5QDzjLJm+Wdx5F"
            crossorigin="anonymous"></script>
    <style>
        /* ── Admin base ── */
        body { background: #E4E6ED; }
        [x-cloak] { display: none !important; }

        /* ── Sidebar scrollbar invisible ── */
        .sidebar-nav { scrollbar-width: none; }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        /* ── Input reset ── */
        .field-input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 0.875rem;
            color: #1E1B4B;
            font-weight: 500;
        }
        .field-input::placeholder { color: #D1D5DB; font-weight: 400; }
        .field-input:focus { color: #1E1B4B; }

        /* ── Flash fade in ── */
        .flash-msg { animation: fadeSlideIn 0.35s ease-out; }
        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Active sidebar link ── */
        .nav-link-active {
            background: rgba(124, 58, 237, 0.15) !important;
            color: #A78BFA !important;
        }
        .nav-link-active .nav-icon {
            background: rgba(124, 58, 237, 0.2) !important;
            color: #C4B5FD !important;
        }

        /* ══ Tooltips — fond blanc, texte sombre, positionnement contextuel ══ */
        [data-tooltip] { position: relative; }

        /* Bubble commune */
        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            background: #ffffff;
            color: #111827;
            font-size: 11.5px;
            font-weight: 500;
            line-height: 1.4;
            padding: 5px 10px;
            border-radius: 8px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            z-index: 9999;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12), 0 0 0 1px rgba(0,0,0,0.07);
            transition: opacity 0.18s ease, transform 0.18s ease;
        }
        /* Flèche commune */
        [data-tooltip]::before {
            content: '';
            position: absolute;
            pointer-events: none;
            opacity: 0;
            z-index: 9999;
            border: 5px solid transparent;
            transition: opacity 0.18s ease;
        }
        [data-tooltip]:hover::after,
        [data-tooltip]:hover::before { opacity: 1; }

        /* ── Au-dessus (défaut — boutons d'action, formulaires) ── */
        [data-tooltip]::after {
            bottom: calc(100% + 9px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
        }
        [data-tooltip]::before {
            bottom: calc(100% + 0px);
            left: 50%;
            transform: translateX(-50%);
            border-top-color: #ffffff;
        }
        [data-tooltip]:hover::after {
            transform: translateX(-50%) translateY(0);
        }

        /* ── À droite (sidebar — évite de couvrir les liens) ── */
        aside [data-tooltip]::after {
            top: 50%;
            left: calc(100% + 13px);
            bottom: auto;
            transform: translateY(-50%) translateX(-4px);
        }
        aside [data-tooltip]::before {
            top: 50%;
            left: calc(100% + 4px);
            bottom: auto;
            transform: translateY(-50%);
            border-top-color: transparent;
            border-right-color: #ffffff;
        }
        aside [data-tooltip]:hover::after {
            transform: translateY(-50%) translateX(0);
        }

        /* ── En-dessous (topbar — évite de sortir du viewport en haut) ── */
        [data-tooltip-bottom]::after {
            top: calc(100% + 9px);
            left: 50%;
            bottom: auto;
            transform: translateX(-50%) translateY(-4px);
        }
        [data-tooltip-bottom]::before {
            top: calc(100% + 0px);
            left: 50%;
            bottom: auto;
            transform: translateX(-50%);
            border-top-color: transparent;
            border-bottom-color: #ffffff;
        }
        [data-tooltip-bottom]:hover::after {
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>
{{-- h-screen + overflow-hidden = le viewport est le scroll boundary --}}
<body class="antialiased h-screen overflow-hidden flex">

{{-- ══ Sidebar — hauteur fixe, scroll interne si nav déborde ══════════════ --}}
<aside class="w-60 h-full flex flex-col flex-shrink-0 relative"
       style="background: #1E1B4B;">

    {{-- Motif points subtil --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none"
         style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>

    {{-- Logo --}}
    <div class="relative flex items-center gap-3 px-5 py-5 flex-shrink-0" style="border-bottom: 1px solid rgba(255,255,255,0.07);">
        <div class="w-9 h-9 rounded-xl overflow-hidden bg-white/10 flex-shrink-0 ring-2 ring-white/10">
            <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo" class="w-full h-full object-contain p-0.5">
        </div>
        <div>
            <p class="text-white font-bold text-sm leading-tight tracking-tight">Victoria-Koa</p>
            <p class="text-purple-400 text-xs leading-none mt-0.5">Administration</p>
        </div>
    </div>

    {{-- Nav — flex-1 + overflow-y-auto pour scroller si besoin --}}
    <nav class="sidebar-nav relative flex-1 px-3 py-5 space-y-0.5 overflow-y-auto min-h-0">
        @php
        $links = [
            ['route' => 'admin.dashboard',          'icon' => 'fi-sr-home',          'label' => 'Tableau de bord',   'tip' => 'Vue d\'ensemble du site'],
            ['route' => 'admin.actualites.index',   'icon' => 'fi-sr-newspaper',     'label' => 'Actualités',        'tip' => 'Gérer les articles publiés'],
            ['route' => 'admin.temoignages.index',  'icon' => 'fi-sr-comment-alt',   'label' => 'Témoignages',       'tip' => 'Modérer les avis de parents'],
            ['route' => 'admin.messages.index',     'icon' => 'fi-sr-envelope',      'label' => 'Messages',          'tip' => 'Messages du formulaire de contact'],
            ['route' => 'admin.utilisateurs.index', 'icon' => 'fi-sr-users',         'label' => 'Utilisateurs',      'tip' => 'Gérer les comptes administrateurs'],
            ['route' => 'admin.calendrier.index',   'icon' => 'fi-sr-calendar',      'label' => 'Calendrier',        'tip' => 'Gérer les dates de vacances et jours fériés'],
            ['route' => 'admin.documents.index',    'icon' => 'fi-sr-file-pdf',      'label' => 'Documents PDF',     'tip' => 'Uploader les PDF fournitures, inscriptions…'],
            ['route' => 'admin.settings.index',     'icon' => 'fi-sr-settings',      'label' => 'Paramètres',        'tip' => 'Horaires, contacts, année scolaire…'],
        ];
        @endphp

        @foreach($links as $link)
            @php
                $active = request()->routeIs($link['route'].'*');
                $routeExists = \Illuminate\Support\Facades\Route::has($link['route']);
            @endphp
            @if($routeExists)
            <a href="{{ route($link['route']) }}"
               data-tooltip="{{ $link['tip'] }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                      {{ $active ? 'nav-link-active' : 'text-purple-200/70 hover:bg-white/5 hover:text-white' }}">
                <span class="nav-icon w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 transition-all
                             {{ $active ? 'bg-purple-500/20' : 'bg-white/5' }}">
                    <i class="fi {{ $link['icon'] }} text-sm {{ $active ? 'text-purple-300' : '' }}"></i>
                </span>
                <span class="truncate">{{ $link['label'] }}</span>
                @if($link['route'] === 'admin.messages.index' && ($nbNonLus ?? 0) > 0)
                    <span class="ml-auto flex-shrink-0 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                        {{ $nbNonLus > 9 ? '9+' : $nbNonLus }}
                    </span>
                @endif
            </a>
            @endif
        @endforeach
    </nav>

    {{-- Footer sidebar --}}
    <div class="relative flex-shrink-0 px-3 pb-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.07);">
        <a href="{{ route('home') }}" target="_blank"
           data-tooltip="Ouvre le site public dans un nouvel onglet"
           class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-purple-300/60 hover:text-white hover:bg-white/5 text-xs font-medium transition-all mb-1">
            <i class="fi fi-rr-arrow-up-right-from-square text-xs"></i>
            Voir le site public
        </a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    data-tooltip="Fermer la session administrateur"
                    class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-purple-300/60 hover:text-red-400 hover:bg-red-500/5 text-xs font-medium transition-all">
                <i class="fi fi-rr-sign-out-alt text-xs"></i>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- ══ Main — flex-col, seul <main> scrolle ══════════════════════════════ --}}
<div class="flex-1 flex flex-col h-full overflow-hidden">

    {{-- Topbar — toujours visible en haut, ne scrolle jamais --}}
    <header class="bg-white border-b border-gray-100 px-7 py-3.5 flex items-center justify-between flex-shrink-0 z-30">
        <div class="flex items-center gap-3">
            <span class="text-gray-300 text-sm">GS Victoria-Koa</span>
            <span class="text-gray-200">/</span>
            <h1 class="text-sm font-bold text-gray-700">@yield('page-title', 'Administration')</h1>
        </div>
        <div class="flex items-center gap-4">
            {{-- Notifications --}}
            @if(($nbNonLus ?? 0) > 0)
            <a href="{{ route('admin.messages.index') }}"
               data-tooltip-bottom data-tooltip="{{ $nbNonLus }} message(s) non lu(s)"
               class="relative w-8 h-8 rounded-xl bg-gray-100 hover:bg-violet-50 flex items-center justify-center transition-colors">
                <i class="fi fi-sr-bell text-sm text-gray-500"></i>
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center">
                    {{ $nbNonLus }}
                </span>
            </a>
            @endif
            {{-- User --}}
            <a href="{{ route('admin.utilisateurs.index') }}"
               data-tooltip-bottom data-tooltip="Gérer les utilisateurs"
               class="flex items-center gap-2.5 hover:opacity-80 transition-opacity">
                <div class="w-8 h-8 rounded-xl bg-violet-600 flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="hidden sm:block">
                    <p class="text-xs font-semibold text-gray-700 leading-tight">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-gray-400 leading-tight">Administrateur</p>
                </div>
            </a>
        </div>
    </header>

    {{-- Flash messages — sous le topbar, pas dans le scroll --}}
    @if(session('success') || session('error'))
    <div class="px-7 pt-4 flex-shrink-0">
        @if(session('success'))
        <div class="flash-msg flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
            <i class="fi fi-sr-check-circle text-emerald-500 text-base flex-shrink-0"></i>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash-msg flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 text-sm">
            <i class="fi fi-sr-exclamation text-red-500 text-base flex-shrink-0"></i>
            {{ session('error') }}
        </div>
        @endif
    </div>
    @endif

    {{-- Content — seule zone qui scrolle --}}
    <main class="flex-1 overflow-y-auto p-7 min-h-0">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>

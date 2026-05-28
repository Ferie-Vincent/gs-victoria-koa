<nav
    x-data="{
        scrolled: false,
        mobileOpen: false,
        vieScolaireOpen: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 80;
            });
        }
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    :style="scrolled
        ? 'background: rgba(88, 28, 135, 0.45); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); box-shadow: 0 4px 30px rgba(88, 28, 135, 0.25);'
        : 'background: transparent;'"
    role="navigation"
    aria-label="Navigation principale"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4 min-h-[80px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="Accueil VICTORIA-KOA">
                <img
                    src="{{ asset('images/logo/logo-2-2.png') }}"
                    alt="Logo GS VICTORIA-KOA"
                    class="w-14 h-14 rounded-full object-cover shadow-violet group-hover:scale-105 transition-transform duration-300"
                    loading="eager"
                >
                <div class="hidden sm:block">
                    <span class="font-display font-extrabold text-xl leading-tight text-white drop-shadow-sm">
                        VICTORIA-KOA
                    </span>
                    <p class="text-sm leading-none text-white/80">
                        Centre Maternel &amp; Primaire
                    </p>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-1">

                {{-- Accueil --}}
                <a href="{{ route('home') }}"
                   class="relative px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                   :class="'text-white hover:text-yellow-300'">
                    Accueil
                    @if(request()->routeIs('home'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>

                {{-- Vie Scolaire dropdown --}}
                <div class="relative"
                     @mouseenter="vieScolaireOpen = true"
                     @mouseleave="vieScolaireOpen = false">
                    <button class="relative flex items-center gap-1 px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                            :class="'text-white hover:text-yellow-300'"
                            aria-haspopup="true"
                            :aria-expanded="vieScolaireOpen">
                        Vie Scolaire
                        <svg class="w-4 h-4 transition-transform duration-200" :class="vieScolaireOpen ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        @if(request()->routeIs('classes','horaires','fournitures','calendrier'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                        @endif
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="vieScolaireOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         class="absolute top-full left-0 mt-2 bg-white rounded-2xl shadow-xl shadow-purple-100 p-2 min-w-52 z-10"
                         role="menu">
                        @foreach([
                            ['route' => 'classes',     'icon' => 'fi-sr-book',          'label' => 'Les classes'],
                            ['route' => 'horaires',    'icon' => 'fi-sr-clock',          'label' => 'Les horaires'],
                            ['route' => 'fournitures', 'icon' => 'fi-sr-ruler-triangle', 'label' => 'Fournitures scolaires'],
                            ['route' => 'calendrier',  'icon' => 'fi-sr-calendar',       'label' => 'Calendrier scolaire'],
                        ] as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-body font-semibold text-dark hover:bg-purple-50 hover:text-primary transition-colors duration-200
                                  {{ request()->routeIs($item['route']) ? 'bg-purple-50 text-primary' : '' }}"
                           role="menuitem">
                            <i class="fi {{ $item['icon'] }} w-4 text-center"></i>
                            {{ $item['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Inscription --}}
                <a href="{{ route('inscription') }}"
                   class="relative px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                   :class="'text-white hover:text-yellow-300'">
                    Inscription
                    @if(request()->routeIs('inscription'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>

                {{-- Galleries --}}
                <a href="{{ route('galleries') }}"
                   class="relative px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                   :class="'text-white hover:text-yellow-300'">
                    Galeries
                    @if(request()->routeIs('galleries'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>

                {{-- Actualités --}}
                <a href="{{ route('actualites') }}"
                   class="relative px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                   :class="'text-white hover:text-yellow-300'">
                    Actualités
                    @if(request()->routeIs('actualites'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>

                {{-- À Propos --}}
                <a href="{{ route('about') }}"
                   class="relative px-4 py-2.5 rounded-xl font-body font-semibold text-base transition-colors duration-200"
                   :class="'text-white hover:text-yellow-300'">
                    À Propos
                    @if(request()->routeIs('about'))
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>

                {{-- Bouton Contact --}}
                <a href="{{ route('contact') }}"
                   class="relative ml-2 flex items-center gap-2 px-5 py-2.5 rounded-full font-body font-semibold text-base border-2 transition-all duration-300 hover:scale-105"
                   :class="'border-white text-white hover:bg-white/20'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contact
                    @if(request()->routeIs('contact'))
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-secondary"></span>
                    @endif
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button
                @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2 rounded-xl transition-colors duration-200"
                :class="'text-white hover:bg-white/20'"
                aria-label="Ouvrir le menu"
                :aria-expanded="mobileOpen">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Overlay mobile --}}
    <div x-show="mobileOpen"
         @click="mobileOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/40 z-40 lg:hidden"
         aria-hidden="true">
    </div>

    {{-- Mobile Drawer --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-250"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 w-80 bg-white shadow-2xl z-50 lg:hidden overflow-y-auto"
         role="dialog"
         aria-modal="true"
         aria-label="Menu mobile">

        {{-- Header drawer --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-purple-100">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
                <span class="font-display font-extrabold text-dark">VICTORIA-KOA</span>
            </div>
            <button @click="mobileOpen = false" class="p-2 rounded-xl text-gray-400 hover:text-primary hover:bg-purple-50" aria-label="Fermer le menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Liens mobile --}}
        <nav class="px-4 py-6 space-y-1">
            <a href="{{ route('home') }}" @click="mobileOpen = false"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl font-body font-semibold text-dark hover:bg-purple-50 hover:text-primary transition-colors
                      {{ request()->routeIs('home') ? 'bg-purple-50 text-primary' : '' }}">
                <i class="fi fi-sr-home w-4 text-center text-primary"></i> Accueil
                @if(request()->routeIs('home'))
                <span class="ml-auto w-2 h-2 rounded-full bg-secondary"></span>
                @endif
            </a>

            {{-- Vie Scolaire accordéon --}}
            <div x-data="{ open: false }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-2xl font-body font-semibold text-dark hover:bg-purple-50 hover:text-primary transition-colors
                               {{ request()->routeIs('classes','horaires','fournitures','calendrier') ? 'bg-purple-50 text-primary' : '' }}">
                    <span><i class="fi fi-sr-graduation-cap w-4 text-center text-primary mr-1"></i> Vie Scolaire</span>
                    <div class="flex items-center gap-2">
                        @if(request()->routeIs('classes','horaires','fournitures','calendrier'))
                        <span class="w-2 h-2 rounded-full bg-secondary"></span>
                        @endif
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>
                <div x-show="open" x-transition class="ml-4 mt-1 space-y-1">
                    @foreach([
                        ['route' => 'classes',     'icon' => 'fi-sr-book',          'label' => 'Les classes'],
                        ['route' => 'horaires',    'icon' => 'fi-sr-clock',          'label' => 'Les horaires'],
                        ['route' => 'fournitures', 'icon' => 'fi-sr-ruler-triangle', 'label' => 'Fournitures'],
                        ['route' => 'calendrier',  'icon' => 'fi-sr-calendar',       'label' => 'Calendrier'],
                    ] as $item)
                    <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-body text-gray-600 hover:bg-purple-50 hover:text-primary transition-colors
                              {{ request()->routeIs($item['route']) ? 'text-primary font-semibold' : '' }}">
                        <i class="fi {{ $item['icon'] }} w-4 text-center"></i>
                        {{ $item['label'] }}
                        @if(request()->routeIs($item['route']))
                        <span class="ml-auto w-2 h-2 rounded-full bg-secondary"></span>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            @foreach([
                ['route' => 'inscription', 'icon' => 'fi-sr-pen-nib',   'label' => 'Inscription'],
                ['route' => 'galleries',   'icon' => 'fi-sr-camera',    'label' => 'Galeries'],
                ['route' => 'actualites',  'icon' => 'fi-sr-newspaper', 'label' => 'Actualités'],
                ['route' => 'about',       'icon' => 'fi-sr-school',    'label' => 'À Propos'],
            ] as $item)
            <a href="{{ route($item['route']) }}" @click="mobileOpen = false"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl font-body font-semibold text-dark hover:bg-purple-50 hover:text-primary transition-colors
                      {{ request()->routeIs($item['route']) ? 'bg-purple-50 text-primary' : '' }}">
                <i class="fi {{ $item['icon'] }} w-4 text-center text-primary"></i>
                {{ $item['label'] }}
                @if(request()->routeIs($item['route']))
                <span class="ml-auto w-2 h-2 rounded-full bg-secondary"></span>
                @endif
            </a>
            @endforeach

            <div class="pt-4">
                <a href="{{ route('contact') }}" @click="mobileOpen = false"
                   class="flex items-center justify-center gap-2 w-full py-3 px-6 rounded-full bg-primary text-white font-body font-semibold hover:bg-purple-700 transition-colors
                          {{ request()->routeIs('contact') ? 'ring-2 ring-secondary ring-offset-2' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Nous contacter
                </a>
            </div>
        </nav>

        {{-- Contact rapide --}}
        <div class="px-6 py-4 border-t border-purple-100 space-y-2">
            <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_1']) }}"
               class="flex items-center gap-2 text-sm text-gray-600 hover:text-primary">
                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $site['telephone_1'] }}
            </a>
        </div>
    </div>
</nav>

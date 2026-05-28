<footer class="bg-footer text-white relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- Colonne 1 — École --}}
            <div data-aos="fade-up" data-aos-delay="0">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo VICTORIA-KOA"
                         class="w-14 h-14 rounded-full object-cover border-2 border-white/20">
                    <div>
                        <h3 class="font-display font-extrabold text-lg leading-tight">VICTORIA-KOA</h3>
                        <p class="text-xs text-white/70">Centre Maternel &amp; Primaire</p>
                    </div>
                </div>
                <p class="text-white/80 text-sm leading-relaxed font-body mb-6">
                    École maternelle et primaire à Angré 9ème Tranche, Abidjan.
                    Un cadre chaleureux où chaque enfant s'épanouit dans la joie et l'apprentissage.
                </p>
                <a href="{{ $site['facebook_url'] }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors text-sm font-body font-semibold"
                   aria-label="Page Facebook VICTORIA-KOA">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Suivez-nous
                </a>
            </div>

            {{-- Colonne 2 — Navigation --}}
            <div data-aos="fade-up" data-aos-delay="100">
                <h4 class="font-display font-bold text-base mb-6 text-white/90 uppercase tracking-wide">Navigation</h4>
                <ul class="space-y-3 font-body text-sm">
                    @foreach([
                        ['route' => 'home',        'label' => 'Accueil'],
                        ['route' => 'about',        'label' => 'À propos'],
                        ['route' => 'classes',     'label' => 'Les classes'],
                        ['route' => 'inscription', 'label' => 'Inscription'],
                        ['route' => 'galleries',   'label' => 'Galeries'],
                        ['route' => 'contact',     'label' => 'Contact'],
                    ] as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="text-white/75 hover:text-white hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent-pink/60 flex-shrink-0"></span>
                            {{ $item['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Colonne 3 — Contact (from Settings) --}}
            <div data-aos="fade-up" data-aos-delay="200">
                <h4 class="font-display font-bold text-base mb-6 text-white/90 uppercase tracking-wide">Nous contacter</h4>
                <ul class="space-y-4 font-body text-sm">
                    <li>
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_1']) }}"
                           class="flex items-start gap-3 text-white/75 hover:text-white transition-colors">
                            <svg class="w-4 h-4 mt-0.5 text-accent-pink flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $site['telephone_1'] }}
                        </a>
                    </li>
                    @if($site['telephone_2'])
                    <li>
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_2']) }}"
                           class="flex items-start gap-3 text-white/75 hover:text-white transition-colors">
                            <svg class="w-4 h-4 mt-0.5 text-accent-pink flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $site['telephone_2'] }}
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="mailto:{{ $site['email_direction'] }}"
                           class="flex items-start gap-3 text-white/75 hover:text-white transition-colors">
                            <svg class="w-4 h-4 mt-0.5 text-secondary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $site['email_direction'] }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-start gap-3 text-white/75">
                            <svg class="w-4 h-4 mt-0.5 text-accent-teal flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $site['adresse'] }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Séparateur --}}
        <div class="mt-12 pt-6 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-white/60 text-sm font-body text-center">
                &copy; {{ date('Y') }} &mdash; Groupe Scolaire VICTORIA-KOA. Tous droits réservés.
            </p>
            <p class="text-white/40 text-xs font-body">
                Angré 9ème Tranche, Abidjan, Côte d'Ivoire
            </p>
        </div>
    </div>
</footer>

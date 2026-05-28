<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-14">
            <div data-aos="fade-right">
                <x-section-title title="Nos Classes" align="left" />
            </div>
            <a href="{{ route('classes') }}"
               class="hidden md:inline-flex items-center gap-2 font-body font-semibold text-primary hover:text-purple-700 transition-colors"
               data-aos="fade-left">
                Voir toutes les classes
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @php
        /*
         * cardBg    → fond pastel de la carte
         * blobColor → couleur des blobs déco (légèrement plus foncée que cardBg)
         * iconBg    → fond du cercle icône
         * iconColor → couleur de l'icône Uicons
         * ctaColor  → couleur du lien CTA bas de carte
         */
        $annee   = $site['annee_scolaire'];
        $classes = [
            // ── Maternelle ─────────────────────────────────────────────────────
            ['code' => 'TPS', 'name' => 'Toute Petite Section', 'age' => '2 – 3 ans', 'cycle' => 'maternelle',
             'icon' => 'fi-sr-child',
             'desc' => "Les tout-petits font leurs premiers pas à l'école dans un cadre chaleureux et sécurisant.",
             'cardBg'    => '#EDE9FE',
             'blobColor' => '#DDD6FE',
             'iconBg'    => '#F5F3FF',
             'iconColor' => '#7C3AED',
             'ctaColor'  => '#7C3AED',
             'pdf' => "TPS-${annee}.pdf"],

            ['code' => 'PS',  'name' => 'Petite Section', 'age' => '3 – 4 ans', 'cycle' => 'maternelle',
             'icon' => 'fi-sr-user',
             'desc' => "Éveil et socialisation au cœur d'activités ludiques et créatives adaptées à l'âge.",
             'cardBg'    => '#FCE7F3',
             'blobColor' => '#FBCFE8',
             'iconBg'    => '#FDF2F8',
             'iconColor' => '#DB2777',
             'ctaColor'  => '#DB2777',
             'pdf' => "PS-${annee}.pdf"],

            ['code' => 'MS',  'name' => 'Moyenne Section', 'age' => '4 – 5 ans', 'cycle' => 'maternelle',
             'icon' => 'fi-sr-users',
             'desc' => "Développement du langage, de la motricité et des premières notions de mathématiques.",
             'cardBg'    => '#CCFBF1',
             'blobColor' => '#99F6E4',
             'iconBg'    => '#F0FDFA',
             'iconColor' => '#0F766E',
             'ctaColor'  => '#0F766E',
             'pdf' => "MS-${annee}.pdf"],

            ['code' => 'GS',  'name' => 'Grande Section', 'age' => '5 – 6 ans', 'cycle' => 'maternelle',
             'icon' => 'fi-sr-graduation-cap',
             'desc' => "Préparation active à la lecture, l'écriture et le calcul avant l'entrée au primaire.",
             'cardBg'    => '#FEF9C3',
             'blobColor' => '#FEF08A',
             'iconBg'    => '#FEFCE8',
             'iconColor' => '#D97706',
             'ctaColor'  => '#D97706',
             'pdf' => "GS-${annee}.pdf"],

            // ── Primaire ───────────────────────────────────────────────────────
            ['code' => 'CP1', 'name' => 'Cours Préparatoire 1', 'age' => '6 – 7 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-book',
             'desc' => "Acquisition de la lecture et de l'écriture — les fondations de tout apprentissage.",
             'cardBg'    => '#DBEAFE',
             'blobColor' => '#BFDBFE',
             'iconBg'    => '#EFF6FF',
             'iconColor' => '#1D4ED8',
             'ctaColor'  => '#1D4ED8',
             'pdf' => "CP-${annee}.pdf"],

            ['code' => 'CP2', 'name' => 'Cours Préparatoire 2', 'age' => '7 – 8 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-book',
             'desc' => "Consolidation des acquis en lecture, calcul et découverte du monde qui nous entoure.",
             'cardBg'    => '#DCFCE7',
             'blobColor' => '#BBF7D0',
             'iconBg'    => '#F0FDF4',
             'iconColor' => '#16A34A',
             'ctaColor'  => '#16A34A',
             'pdf' => "CP-${annee}.pdf"],

            ['code' => 'CE1', 'name' => 'Cours Élémentaire 1', 'age' => '8 – 9 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-pencil',
             'desc' => "Approfondissement du français et des mathématiques avec des projets interdisciplinaires.",
             'cardBg'    => '#FFEDD5',
             'blobColor' => '#FED7AA',
             'iconBg'    => '#FFF7ED',
             'iconColor' => '#EA580C',
             'ctaColor'  => '#EA580C',
             'pdf' => "CE1-${annee}.pdf"],

            ['code' => 'CE2', 'name' => 'Cours Élémentaire 2', 'age' => '9 – 10 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-pencil',
             'desc' => "Sciences, géographie et histoire s'ajoutent pour élargir l'horizon des élèves.",
             'cardBg'    => '#F3E8FF',
             'blobColor' => '#E9D5FF',
             'iconBg'    => '#FAF5FF',
             'iconColor' => '#9333EA',
             'ctaColor'  => '#9333EA',
             'pdf' => "CE2-${annee}.pdf"],

            ['code' => 'CM1', 'name' => 'Cours Moyen 1', 'age' => '10 – 11 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-star',
             'desc' => "Préparation au CM2 avec un programme complet en français, maths et sciences.",
             'cardBg'    => '#FEE2E2',
             'blobColor' => '#FECACA',
             'iconBg'    => '#FEF2F2',
             'iconColor' => '#DC2626',
             'ctaColor'  => '#DC2626',
             'pdf' => "CM1-${annee}.pdf"],

            ['code' => 'CM2', 'name' => 'Cours Moyen 2', 'age' => '11 – 12 ans', 'cycle' => 'primaire',
             'icon' => 'fi-sr-star',
             'desc' => "Dernière année de primaire — préparation à l'entrée au collège avec sérieux et confiance.",
             'cardBg'    => '#E0F2FE',
             'blobColor' => '#BAE6FD',
             'iconBg'    => '#F0F9FF',
             'iconColor' => '#0369A1',
             'ctaColor'  => '#0369A1',
             'pdf' => "CM2-${annee}.pdf"],
        ];

        $maternelle = array_filter($classes, fn($c) => $c['cycle'] === 'maternelle');
        $primaire   = array_filter($classes, fn($c) => $c['cycle'] === 'primaire');
        @endphp

        {{-- ── MATERNELLE ── --}}
        <div class="mb-14">

            <div class="flex items-center gap-3 mb-8" data-aos="fade-up">
                <span class="px-5 py-2 bg-violet-100 text-violet-700 rounded-full font-body font-bold text-sm flex items-center gap-2">
                    <i class="fi fi-sr-child"></i> Maternelle
                </span>
                <div class="flex-1 h-px bg-violet-100"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($maternelle as $i => $class)
                <div class="float-card-wrap" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="group relative overflow-hidden text-center px-10 py-12 cursor-default float-card-simple"
                     style="background-color: {{ $class['cardBg'] }}; border-radius: 40px; animation-delay: {{ $i * 1 }}s;">

                    {{-- Blob déco coin haut-gauche --}}
                    <div class="absolute -top-8 -left-8 w-28 h-28 rounded-full pointer-events-none"
                         style="background-color: {{ $class['blobColor'] }}; opacity: 0.6;"></div>

                    {{-- Blob déco coin bas-droite --}}
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 rounded-full pointer-events-none"
                         style="background-color: {{ $class['blobColor'] }}; opacity: 0.4;"></div>

                    {{-- Effet cousu — bordure colorée interne en pointillés --}}
                    <div class="absolute inset-3 pointer-events-none z-[1]"
                         style="border: 2px dashed {{ $class['iconColor'] }}80; border-radius: 30px;"></div>

                    {{-- Cercle icône flottant --}}
                    <div class="relative z-10 flex justify-center mb-8">
                        <div class="w-32 h-32 rounded-full flex items-center justify-center shadow-md"
                             style="background-color: {{ $class['iconBg'] }};">
                            <i class="fi {{ $class['icon'] }} text-6xl"
                               style="color: {{ $class['iconColor'] }};"></i>
                        </div>
                    </div>

                    {{-- Code classe --}}
                    <h3 class="relative z-10 font-display font-extrabold text-3xl text-dark mb-3">
                        {{ $class['code'] }}
                    </h3>

                    {{-- Nom --}}
                    <p class="relative z-10 font-body text-gray-500 text-sm mb-2">
                        ({{ $class['name'] }})
                    </p>

                    {{-- Âge --}}
                    <p class="relative z-10 font-body text-gray-400 text-xs mb-6">
                        {{ $class['age'] }}
                    </p>

                    {{-- Description --}}
                    <p class="relative z-10 font-body text-gray-600 text-sm leading-relaxed mb-8">
                        {{ $class['desc'] }}
                    </p>

                    {{-- CTA download --}}
                    <a href="/documents/fournitures/{{ $class['pdf'] }}"
                       download
                       class="relative z-10 inline-flex items-center gap-2 font-body font-bold text-sm
                              hover:gap-3 transition-all duration-300"
                       style="color: {{ $class['ctaColor'] }};">
                        Fournitures
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── PRIMAIRE ── --}}
        <div>

            <div class="flex items-center gap-3 mb-8" data-aos="fade-up">
                <span class="px-5 py-2 bg-orange-100 text-orange-700 rounded-full font-body font-bold text-sm flex items-center gap-2">
                    <i class="fi fi-sr-graduation-cap"></i> Primaire
                </span>
                <div class="flex-1 h-px bg-orange-100"></div>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach($primaire as $i => $class)
                <div class="float-card-wrap w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)]"
                     data-aos="fade-up" data-aos-delay="{{ $i * 70 }}">
                <div class="group relative overflow-hidden text-center px-10 py-12 cursor-default float-card-simple"
                     style="background-color: {{ $class['cardBg'] }}; border-radius: 40px; animation-delay: {{ $i * 0.8 }}s;">

                    {{-- Blobs déco --}}
                    <div class="absolute -top-8 -left-8 w-28 h-28 rounded-full pointer-events-none"
                         style="background-color: {{ $class['blobColor'] }}; opacity: 0.6;"></div>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 rounded-full pointer-events-none"
                         style="background-color: {{ $class['blobColor'] }}; opacity: 0.4;"></div>

                    {{-- Effet cousu — bordure colorée interne en pointillés --}}
                    <div class="absolute inset-3 pointer-events-none z-[1]"
                         style="border: 2px dashed {{ $class['iconColor'] }}80; border-radius: 30px;"></div>

                    {{-- Cercle icône --}}
                    <div class="relative z-10 flex justify-center mb-8">
                        <div class="w-32 h-32 rounded-full flex items-center justify-center shadow-md"
                             style="background-color: {{ $class['iconBg'] }};">
                            <i class="fi {{ $class['icon'] }} text-6xl"
                               style="color: {{ $class['iconColor'] }};"></i>
                        </div>
                    </div>

                    {{-- Code --}}
                    <h3 class="relative z-10 font-display font-extrabold text-3xl text-dark mb-3">
                        {{ $class['code'] }}
                    </h3>

                    {{-- Nom --}}
                    <p class="relative z-10 font-body text-gray-500 text-sm mb-2">
                        ({{ $class['name'] }})
                    </p>

                    {{-- Âge --}}
                    <p class="relative z-10 font-body text-gray-400 text-xs mb-6">
                        {{ $class['age'] }}
                    </p>

                    {{-- Description --}}
                    <p class="relative z-10 font-body text-gray-600 text-sm leading-relaxed mb-8">
                        {{ $class['desc'] }}
                    </p>

                    {{-- CTA --}}
                    <a href="/documents/fournitures/{{ $class['pdf'] }}"
                       download
                       class="relative z-10 inline-flex items-center gap-2 font-body font-bold text-sm
                              hover:gap-3 transition-all duration-300"
                       style="color: {{ $class['ctaColor'] }};">
                        Fournitures
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA mobile --}}
        <div class="text-center mt-12 md:hidden" data-aos="fade-up">
            <a href="{{ route('classes') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-primary text-primary font-body font-semibold hover:bg-primary hover:text-white transition-all duration-300">
                Voir toutes les classes
                <i class="fi fi-sr-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

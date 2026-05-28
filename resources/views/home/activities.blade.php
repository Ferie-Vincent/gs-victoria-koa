<section class="py-20 bg-white relative overflow-hidden">

    {{-- Blob violet décoratif --}}
    <div aria-hidden="true" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-5 pointer-events-none"
         style="background: radial-gradient(circle, #7C3AED, transparent)">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="text-center mb-14" data-aos="fade-up">
            <x-section-title
                title="Nos Activités"
                subtitle="Victoria-Koa propose à vos enfants une variété d'activités périscolaires pour enrichir leur expérience et favoriser leur épanouissement."
            />
        </div>

        {{-- Grille activités --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-12">
            @php
            $activities = [
                [
                    'icon'  => 'fi-sr-running',
                    'label' => 'Danse',
                    'desc'  => 'Expression corporelle, rythme et créativité pour s\'épanouir.',
                    'bg'    => '#FCE7F3',
                    'blob'  => '#FBCFE8',
                    'text'  => '#9D174D',
                    'delay' => '0',
                ],
                [
                    'icon'  => 'fi-sr-shield',
                    'label' => 'Karaté',
                    'desc'  => 'Discipline, respect et confiance en soi dès le plus jeune âge.',
                    'bg'    => '#FFEDD5',
                    'blob'  => '#FED7AA',
                    'text'  => '#9A3412',
                    'delay' => '80',
                ],
                [
                    'icon'  => 'fi-sr-music',
                    'label' => 'Piano',
                    'desc'  => 'Éveil musical et apprentissage du solfège pour tous les niveaux.',
                    'bg'    => '#EDE9FE',
                    'blob'  => '#DDD6FE',
                    'text'  => '#5B21B6',
                    'delay' => '160',
                ],
                [
                    'icon'  => 'fi-sr-swimmer',
                    'label' => 'Natation',
                    'desc'  => 'Sécurité aquatique et sport collectif dans la bonne humeur.',
                    'bg'    => '#CCFBF1',
                    'blob'  => '#99F6E4',
                    'text'  => '#0F766E',
                    'delay' => '240',
                ],
                [
                    'icon'  => 'fi-sr-theater-masks',
                    'label' => 'Théâtre',
                    'desc'  => 'Prise de parole, confiance et imagination sur les planches.',
                    'bg'    => '#FEF9C3',
                    'blob'  => '#FEF08A',
                    'text'  => '#854D0E',
                    'delay' => '320',
                ],
            ];
            @endphp

            @foreach($activities as $act)
            <div class="relative rounded-3xl p-6 overflow-hidden group hover:-translate-y-2 hover:shadow-xl transition-all duration-300 cursor-default"
                 style="background-color: {{ $act['bg'] }};"
                 data-aos="fade-up" data-aos-delay="{{ $act['delay'] }}">

                {{-- Blob déco --}}
                <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full pointer-events-none"
                     style="background-color: {{ $act['blob'] }}; opacity: 0.7;"></div>

                {{-- Effet cousu --}}
                <div class="absolute inset-2 pointer-events-none rounded-2xl"
                     style="border: 2px dashed {{ $act['text'] }}30;"></div>

                <div class="relative z-10 text-center">
                    {{-- Icône --}}
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm"
                         style="background-color: {{ $act['text'] }}18;">
                        <i class="fi {{ $act['icon'] }} text-3xl" style="color: {{ $act['text'] }};"></i>
                    </div>

                    {{-- Nom --}}
                    <h3 class="font-display font-extrabold text-xl mb-2" style="color: {{ $act['text'] }};">
                        {{ $act['label'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="font-body text-gray-600 text-sm leading-relaxed">
                        {{ $act['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center" data-aos="fade-up" data-aos-delay="400">
            <p class="font-body text-gray-500 mb-5 text-sm">Découvrez la liste des tarifs et le planning des cours</p>
            <a href="{{ route('inscription') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary text-white font-body font-bold hover:bg-purple-700 hover:scale-105 transition-all duration-300 shadow-violet">
                En savoir plus
                <i class="fi fi-sr-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

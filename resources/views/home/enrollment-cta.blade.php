<section class="py-20 bg-hero relative overflow-hidden">

    @include('components.floating-bubbles')

    {{-- Shapes géométriques décoratifs --}}
    <div aria-hidden="true" class="absolute top-8 right-8 w-16 h-16 border-2 border-white/20 rounded-2xl rotate-12"></div>
    <div aria-hidden="true" class="absolute bottom-8 left-8 w-12 h-12 border-2 border-white/20 rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Titre + badge statut inscriptions --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="flex items-center justify-center gap-3 mb-4">
                <h2 class="font-display font-extrabold text-3xl md:text-4xl text-white">
                    S'inscrire au Groupe Scolaire VICTORIA-KOA
                </h2>
            </div>
            @if($site['inscription_ouverte'])
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-400/30 text-emerald-100 text-xs font-bold mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-pulse"></span>
                Inscriptions {{ $site['annee_scolaire'] }} ouvertes
            </span>
            @else
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400/30 text-amber-100 text-xs font-bold mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-300"></span>
                Inscriptions fermées pour l'instant
            </span>
            @endif
            <p class="font-body text-white/85 text-lg max-w-xl mx-auto">
                Toutes les informations à votre portée pour inscrire votre enfant
            </p>
        </div>

        {{-- Cards téléchargement — désactivées si inscriptions fermées --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            @php
            $annee = $site['annee_scolaire'];
            $cards = [
                ['icon' => '<i class="fi fi-sr-clipboard-list text-primary text-5xl"></i>',
                 'title' => 'Fiche Renseignement Maternelle',
                 'sub'   => 'Toute Petite Section, PS, MS, GS',
                 'href'  => "/documents/inscriptions/fiche-inscription-maternelle-{$annee}.pdf",
                 'color' => 'text-primary'],
                ['icon' => '<i class="fi fi-sr-clipboard-list text-secondary text-5xl"></i>',
                 'title' => 'Fiche Renseignement Primaire',
                 'sub'   => 'CP1, CP2, CE1, CE2, CM1, CM2',
                 'href'  => "/documents/inscriptions/fiche-inscription-primaire-{$annee}.pdf",
                 'color' => 'text-secondary'],
            ];
            @endphp
            @foreach($cards as $i => $card)
            <div class="relative bg-white rounded-3xl p-8 text-center shadow-violet card-hover overflow-hidden {{ !$site['inscription_ouverte'] ? 'opacity-60' : '' }}"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #7C3AED25;"></div>
                <div class="relative z-10">
                    <div class="mb-4">{!! $card['icon'] !!}</div>
                    <h3 class="font-display font-bold text-dark text-lg mb-2">{{ $card['title'] }}</h3>
                    <p class="font-body text-gray-500 text-sm mb-6">{{ $card['sub'] }}</p>
                    @if($site['inscription_ouverte'])
                    <a href="{{ $card['href'] }}" download target="_blank"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary text-white font-body font-semibold hover:bg-purple-700 transition-colors">
                        <i class="fi fi-sr-download"></i> Télécharger
                    </a>
                    @else
                    <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gray-200 text-gray-500 font-body font-semibold text-sm cursor-not-allowed">
                        <i class="fi fi-sr-lock"></i> Disponible à l'ouverture
                    </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

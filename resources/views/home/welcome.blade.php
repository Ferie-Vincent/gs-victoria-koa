<section class="py-20 relative" style="background-color: #FEFCE8;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- ── Collage photos gauche ─────────────────────────────────── --}}
            <div class="flex justify-center" data-aos="fade-right">
                <div class="relative w-72 h-80 md:w-96 md:h-[420px]">

                    {{-- Photo de fond (légèrement inclinée) --}}
                    <div class="absolute bottom-0 right-0 w-52 md:w-64 rounded-3xl overflow-hidden shadow-xl border-4 border-white"
                         style="transform: rotate(4deg); z-index: 1;">
                        <img src="{{ asset('images/gallery/CV5I0186-scaled.jpg') }}"
                             alt="Élèves Victoria-Koa"
                             class="w-full h-56 md:h-64 object-cover object-top">
                    </div>

                    {{-- Photo principale (centrée, légèrement inclinée autre sens) --}}
                    <div class="absolute top-0 left-0 w-52 md:w-64 rounded-3xl overflow-hidden shadow-2xl border-4 border-white"
                         style="transform: rotate(-5deg); z-index: 2;">
                        <img src="{{ asset('images/gallery/CV5I0157-scaled.jpg') }}"
                             alt="Vie scolaire"
                             class="w-full h-56 md:h-64 object-cover object-top">
                    </div>

                    {{-- Badge flottant stats --}}
                    <div class="absolute -bottom-4 left-8 bg-primary text-white rounded-2xl px-4 py-3 shadow-violet z-10 animate-float-2">
                        <p class="font-display font-extrabold text-xl leading-none">350+</p>
                        <p class="font-body text-white/80 text-xs mt-0.5">élèves heureux</p>
                    </div>

                    {{-- Badge flottant love --}}
                    <div class="absolute -top-2 right-4 bg-secondary text-dark rounded-2xl px-3 py-2 shadow-yellow z-10 animate-float-3 text-sm font-body font-bold">
                        ❤️ Depuis 2014
                    </div>
                </div>
            </div>

            {{-- ── Texte droite ───────────────────────────────────────────── --}}
            <div data-aos="fade-left">
                <x-section-title
                    title="Mot de Bienvenue sur le site"
                    align="left"
                />
                <div class="mt-6 space-y-4">
                    @php
                    $paragraphs = [
                        ['<i class="fi fi-sr-star text-secondary"></i>', "Bienvenue dans notre école victoria-koa où l'esprit d'équipe et l'esprit famille est au cœur de tout ce que nous faisons."],
                        ['<i class="fi fi-sr-heart text-amber-400"></i>', "Ici les enfants grandissent ensemble, apprennent des uns des autres et tissent des liens forts qui durent toute une vie."],
                        ['<i class="fi fi-sr-heart text-violet-500"></i>', "Nous sommes fiers de notre équipe enseignante, passionnée, dévouée et de nos élèves motivés qui travaillent ensemble pour atteindre l'excellence."],
                        ['<i class="fi fi-sr-seedling text-green-500"></i>', "Notre école est un endroit où nous nous efforçons de créer un environnement d'apprentissage stimulant et accueillant, où chaque élève unique et valorisé peut grandir et s'épanouir."],
                        ['<i class="fi fi-sr-sparkles text-purple-400"></i>', "Nous sommes à votre écoute et sommes impatients de partager cette aventure éducative avec vous !"],
                        ['<i class="fi fi-sr-book text-primary"></i>', "Bonne visite sur ce site web conçu pour vous donner un aperçu de notre vie scolaire. Vous y trouverez nos convictions éducatives ainsi que nos activités et événements."],
                    ];
                    @endphp
                    @foreach($paragraphs as $i => [$icon, $text])
                    <p class="font-body text-gray-700 leading-relaxed flex items-start gap-3"
                       data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                        <span class="text-lg flex-shrink-0 mt-0.5">{!! $icon !!}</span>
                        <span>{{ $text }}</span>
                    </p>
                    @endforeach
                </div>

                <div class="mt-8" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-primary text-white font-body font-semibold hover:bg-purple-700 transition-colors">
                        En savoir plus sur l'école
                        <i class="fi fi-sr-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

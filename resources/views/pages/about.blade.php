@extends('layouts.app')

@section('title', 'À Propos')
@section('meta_description', 'Découvrez le Groupe Scolaire VICTORIA-KOA : notre histoire, nos valeurs éducatives, notre équipe pédagogique et notre engagement pour la réussite des enfants d\'Abidjan.')
@section('canonical', url('/a-propos'))

@section('content')

<x-page-banner
    title="À Propos"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'À Propos']]"
/>

{{-- ── Notre Histoire ── --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div data-aos="fade-right">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">
                        <i class="fi fi-sr-school text-violet-600 text-2xl"></i>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-dark">Notre Histoire</h2>
                </div>
                <div class="space-y-4 font-body text-gray-600 leading-relaxed">
                    <p>Fondé en <strong class="text-primary">2014</strong>, le Groupe Scolaire VICTORIA-KOA accompagne les familles d'Angré et de ses environs dans l'éducation de leurs enfants avec passion et bienveillance.</p>
                    <p>Notre école s'est construite sur une conviction profonde : chaque enfant est unique et mérite un encadrement bienveillant, rigoureux et adapté à son rythme. Cette philosophie guide chacune de nos décisions pédagogiques.</p>
                    <p>Aujourd'hui, Victoria-Koa accueille des enfants de 2 à 12 ans du niveau TPS au CM2, dans une ambiance familiale qui fait notre réputation.</p>
                </div>
            </div>

            <div data-aos="fade-left">
                <div class="relative bg-gradient-to-br from-violet-50 to-purple-100 rounded-3xl p-8 overflow-hidden">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed #7C3AED40;"></div>
                    <div class="relative z-10 grid grid-cols-2 gap-5">
                        @php
                        $stats = [
                            ['icon' => 'fi-sr-calendar', 'val' => '2014',   'label' => 'Fondation'],
                            ['icon' => 'fi-sr-users',    'val' => '+400',    'label' => 'Élèves'],
                            ['icon' => 'fi-sr-book',     'val' => '10',      'label' => 'Niveaux'],
                            ['icon' => 'fi-sr-star',     'val' => '10 ans',  'label' => "d'expérience"],
                        ];
                        @endphp
                        @foreach($stats as $stat)
                        <div class="bg-white rounded-2xl p-5 text-center shadow-sm">
                            <i class="fi {{ $stat['icon'] }} text-primary text-2xl mb-2 block"></i>
                            <p class="font-display font-extrabold text-2xl text-dark">{{ $stat['val'] }}</p>
                            <p class="font-body text-gray-500 text-xs">{{ $stat['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── Notre Pédagogie ── --}}
<section class="py-16 bg-section-alt">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12" data-aos="fade-up">
            <x-section-title
                title="Notre Pédagogie"
                subtitle="Une approche centrée sur l'enfant, son épanouissement et sa réussite."
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @php
            $pedagos = [
                ['icon' => 'fi-sr-child',     'color' => '#7C3AED', 'bg' => '#EDE9FE',
                 'title' => 'Approche bienveillante',
                 'text'  => "Nous croyons en une pédagogie douce qui respecte le rythme de chaque enfant. Nos enseignants sont formés pour accompagner avec patience et bienveillance."],
                ['icon' => 'fi-sr-target',    'color' => '#F97316', 'bg' => '#FFEDD5',
                 'title' => 'Excellence académique',
                 'text'  => "Nous suivons le programme de l'Éducation Nationale française, enrichi d'activités culturelles et créatives pour former des élèves complets et curieux."],
                ['icon' => 'fi-sr-users',     'color' => '#0F766E', 'bg' => '#CCFBF1',
                 'title' => 'Vie collective',
                 'text'  => "L'école est un espace de vie où s'apprennent le respect, la solidarité et le vivre-ensemble. Des valeurs essentielles pour préparer nos élèves à la vie."],
            ];
            @endphp
            @foreach($pedagos as $i => $item)
            <div class="relative rounded-3xl p-7 overflow-hidden group hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                 style="background-color: {{ $item['bg'] }};"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed {{ $item['color'] }}40;"></div>
                <div class="relative z-10">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm"
                         style="background-color: {{ $item['color'] }}20;">
                        <i class="fi {{ $item['icon'] }} text-2xl" style="color: {{ $item['color'] }};"></i>
                    </div>
                    <h3 class="font-display font-bold text-lg text-dark mb-3">{{ $item['title'] }}</h3>
                    <p class="font-body text-gray-600 text-sm leading-relaxed">{{ $item['text'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ── Nos Locaux ── --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div data-aos="fade-right">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center">
                        <i class="fi fi-sr-building text-amber-600 text-2xl"></i>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-dark">Nos Locaux</h2>
                </div>
                <div class="space-y-4 font-body text-gray-600 leading-relaxed">
                    <p>Situés à <strong>Angré 9ème Tranche CNPS</strong>, face à la Pâtisserie MARY'S, nos locaux sont conçus pour créer un environnement sécurisé, stimulant et propice à l'apprentissage.</p>
                    <p>Chaque salle de classe est aménagée en fonction de l'âge des enfants, avec un mobilier adapté, du matériel pédagogique varié et des espaces dédiés aux différentes activités.</p>
                </div>
                <div class="mt-6 space-y-2">
                    @foreach([
                        ['icon' => 'fi-sr-map-marker', 'text' => $site['adresse']],
                        ['icon' => 'fi-sr-phone-call',  'text' => $site['telephone_1']],
                        ['icon' => 'fi-sr-envelope',    'text' => $site['email_direction']],
                    ] as $info)
                    <div class="flex items-center gap-3 font-body text-sm text-gray-600">
                        <i class="fi {{ $info['icon'] }} text-primary flex-shrink-0"></i>
                        {{ $info['text'] }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div data-aos="fade-left">
                <div class="rounded-3xl overflow-hidden shadow-xl ring-1 ring-violet-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.0!2d-3.944!3d5.371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMjInMTUuNiJOIDPCsDU2JzM4LjQiVw!5e0!3m2!1sfr!2sci!4v1&q=Angr%C3%A9+9%C3%A8me+Tranche+CNPS+Abidjan+Groupe+Scolaire+Victoria-Koa"
                        width="100%" height="340" style="border:0;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Localisation GS Victoria-Koa — Angré 9ème Tranche, Abidjan">
                    </iframe>
                </div>
                <a href="https://maps.google.com/maps?q=92HH+H98,+Voie+Djibi,+Abidjan"
                   target="_blank" rel="noopener noreferrer"
                   class="mt-4 inline-flex items-center gap-2 font-body font-semibold text-sm text-primary hover:underline">
                    <i class="fi fi-sr-map-marker"></i>
                    Ouvrir dans Google Maps
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ── CTA Inscription ── --}}
<section class="py-16 bg-section-alt">
    <div class="max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
        <div class="w-16 h-16 rounded-full bg-primary mx-auto flex items-center justify-center mb-6 shadow-lg shadow-purple-200">
            <i class="fi fi-sr-graduation-cap text-white text-3xl"></i>
        </div>
        <h2 class="font-display font-extrabold text-3xl text-dark mb-4">
            Rejoindre la famille Victoria-Koa
        </h2>
        <p class="font-body text-gray-600 mb-8">
            Inscrivez votre enfant dès aujourd'hui et offrez-lui le meilleur départ dans la vie.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('inscription') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary text-white font-body font-bold
                      hover:bg-purple-700 hover:scale-105 transition-all duration-300 shadow-lg shadow-purple-200">
                <i class="fi fi-sr-pencil"></i>
                Inscrire mon enfant
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full border-2 border-primary text-primary font-body font-bold
                      hover:bg-primary hover:text-white transition-all duration-300">
                <i class="fi fi-sr-phone-call"></i>
                Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection

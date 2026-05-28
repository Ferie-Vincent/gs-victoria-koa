@extends('layouts.app')

@section('title', 'Les Classes')
@section('meta_description', 'Classes maternelle (TPS, PS, MS, GS) et primaire (CP1, CP2, CE1, CE2, CM1, CM2) au GS VICTORIA-KOA. Programmes, effectifs et encadrement pédagogique à Angré, Abidjan.')
@section('canonical', url('/les-classes'))

@section('content')

<x-page-banner
    title="Les Classes"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Les Classes']]"
/>

{{-- ── BLOC 1 : TPS ── --}}
<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center">
                        <i class="fi fi-sr-child text-violet-600 text-2xl"></i>
                    </div>
                    <h2 class="font-display font-extrabold text-2xl text-dark">
                        La Toute Petite Section
                        <span class="text-primary"> — Un lieu d'éveil unique</span>
                    </h2>
                </div>
                <div class="space-y-4 font-body text-gray-600 text-base leading-relaxed">
                    <p>La Toute Petite Section de l'ÉCOLE VICTORIA-KOA est un lieu d'intégration douce vers la maternelle, un lieu chaleureux et sécurisant.</p>
                    <p>L'ÉCOLE VICTORIA-KOA accueille les enfants à partir de deux ans et leur offre, ainsi qu'à leurs parents, une transition douce et rassurante entre la maison et l'école.</p>
                    <p>Un maximum de 25 enfants par classe et l'attention bienveillante de deux professionnelles de la petite enfance permettent de mettre en place des routines rassurantes.</p>
                </div>
            </div>
            <div data-aos="fade-left">
                {{-- Box conseils --}}
                <div class="relative bg-yellow-50 border border-yellow-200 rounded-3xl p-7 overflow-hidden">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed #D9770640;"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-xl bg-yellow-200 flex items-center justify-center">
                                <i class="fi fi-sr-bulb text-yellow-600 text-lg"></i>
                            </div>
                            <h3 class="font-display font-bold text-lg text-yellow-900">Conseils pratiques</h3>
                        </div>
                        <ul class="space-y-3">
                            @foreach([
                                "Privilégiez des chaussures que votre enfant sait mettre seul(e).",
                                "Pensez à marquer les vêtements et aussi les chaussures.",
                                "Bonbons, billes, bijoux, parapluies et casques sont interdits."
                            ] as $conseil)
                            <li class="flex items-start gap-3 font-body text-yellow-900 text-sm">
                                <i class="fi fi-sr-check-circle text-yellow-500 mt-0.5 flex-shrink-0"></i>
                                {{ $conseil }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ── BLOC 2 : Espace d'Éveil ── --}}
<section class="py-16 bg-section-alt">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-8" data-aos="fade-up">
            <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
                <i class="fi fi-sr-home text-teal-600 text-lg"></i>
            </div>
            <h2 class="font-display font-bold text-2xl text-dark">Un Espace d'Éveil Aménagé</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @php
            $eveil = [
                ['icon' => 'fi-sr-puzzle-pieces', 'text' => "La classe est équipée de matériel pédagogique varié (livres, jeux de construction, puzzles) accessibles sur des étagères basses."],
                ['icon' => 'fi-sr-book-open-cover', 'text' => "Le coin lecture invite au calme et à l'imagination, éveille l'amour de la lecture et familiarise les enfants avec les livres."],
                ['icon' => 'fi-sr-brush',           'text' => "Le coin Arts Plastiques est équipé de chevalets et de divers matériaux pour stimuler l'expression libre et la motricité fine."],
                ['icon' => 'fi-sr-shield-check',    'text' => "Découvrez notre TPS conçue pour être un environnement sécurisé et stimulant où l'enfant apprend en jouant."],
            ];
            @endphp
            @foreach($eveil as $i => $item)
            <div class="flex items-start gap-4 bg-white rounded-2xl p-5 shadow-sm"
                 data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center flex-shrink-0">
                    <i class="fi {{ $item['icon'] }} text-teal-600 text-lg"></i>
                </div>
                <p class="font-body text-gray-600 text-sm leading-relaxed">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── BLOC 3 : Maternelle ── --}}
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-6" data-aos="fade-up">
            <div class="w-10 h-10 rounded-xl bg-pink-100 flex items-center justify-center">
                <i class="fi fi-sr-flower text-pink-500 text-lg"></i>
            </div>
            <h2 class="font-display font-bold text-2xl text-dark">La Maternelle</h2>
        </div>
        <div class="space-y-4 font-body text-gray-600 leading-relaxed max-w-3xl" data-aos="fade-up" data-aos-delay="100">
            <p>Nos classes de maternelle n'accueillent pas plus de 25 enfants âgés de 2 à 5 ans, dans un cadre familial et chaleureux.</p>
            <p>La PS, MS et GS sont orchestrées par des maîtresses expérimentées qui s'assurent de la qualité de l'apprentissage en respectant le socle commun de connaissances requis par l'Éducation Nationale française.</p>
        </div>
    </div>
</section>

{{-- ── BLOC 4 : Élémentaire ── --}}
<section class="py-16 bg-section-alt">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 mb-6" data-aos="fade-up">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="fi fi-sr-graduation-cap text-amber-600 text-lg"></i>
            </div>
            <h2 class="font-display font-bold text-2xl text-dark">L'Élémentaire</h2>
        </div>
        <p class="font-body text-gray-600 leading-relaxed max-w-3xl mb-8" data-aos="fade-up" data-aos-delay="80">
            L'apprentissage que l'ÉCOLE VICTORIA-KOA propose au cycle élémentaire assure l'acquisition des instruments fondamentaux : lire, écrire, compter et respecter autrui.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Feature 1 --}}
            <div class="relative bg-white rounded-3xl p-7 shadow-sm border border-gray-100 overflow-hidden"
                 data-aos="fade-right">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #7C3AED30;"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center">
                            <i class="fi fi-sr-target text-violet-600 text-lg"></i>
                        </div>
                        <h3 class="font-display font-bold text-base text-dark">Une pédagogie différenciée et inclusive</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach(["Des groupes de niveaux", "Des outils numériques pour rendre les apprentissages ludiques", "Un suivi individualisé de chaque élève"] as $item)
                        <li class="flex items-center gap-2 font-body text-gray-600 text-sm">
                            <i class="fi fi-sr-check-circle text-violet-400 flex-shrink-0"></i>{{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- Feature 2 --}}
            <div class="relative bg-white rounded-3xl p-7 shadow-sm border border-gray-100 overflow-hidden"
                 data-aos="fade-left">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #0F766E30;"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center">
                            <i class="fi fi-sr-globe text-teal-600 text-lg"></i>
                        </div>
                        <h3 class="font-display font-bold text-base text-dark">Une école ouverte sur le monde</h3>
                    </div>
                    <ul class="space-y-2">
                        @foreach(["Des projets pédagogiques en lien avec l'actualité", "Des sorties scolaires pour découvrir le patrimoine culturel", "Des échanges avec d'autres écoles pour l'ouverture d'esprit"] as $item)
                        <li class="flex items-center gap-2 font-body text-gray-600 text-sm">
                            <i class="fi fi-sr-check-circle text-teal-400 flex-shrink-0"></i>{{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── BLOC 5 : Grille des classes ── --}}
@include('home.classes-preview')

{{-- ── CTA final ── --}}
<section class="py-16 bg-white">
    <div class="max-w-3xl mx-auto px-4 text-center" data-aos="fade-up">
        <h2 class="font-display font-extrabold text-3xl text-dark mb-4">
            Comment inscrire votre enfant ?
        </h2>
        <p class="font-body text-gray-600 mb-8">
            Découvrez toute la procédure d'inscription et les documents nécessaires.
        </p>
        <a href="{{ route('inscription') }}"
           class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary text-white font-body font-bold
                  hover:bg-purple-700 hover:scale-105 transition-all duration-300 shadow-lg shadow-purple-200">
            Voir maintenant
            <i class="fi fi-sr-arrow-right"></i>
        </a>
    </div>
</section>

@endsection

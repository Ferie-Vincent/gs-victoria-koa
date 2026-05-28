@extends('layouts.app')

@php $annee = \App\Models\Setting::schoolYear(); @endphp
@section('title', 'Inscription ' . $annee)
@section('meta_description', 'Inscrivez votre enfant au GS VICTORIA-KOA pour l\'année ' . $annee . '. Téléchargez les fiches d\'inscription maternelle et primaire. Dossier complet disponible en ligne.')
@section('meta_keywords', 'inscription école Abidjan ' . date('Y') . ', fiche inscription maternelle Angré, inscription primaire Abidjan, GS VICTORIA-KOA')
@section('canonical', url('/inscription'))

@section('content')

<x-page-banner
    title="Inscription"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Inscription']]"
/>

{{-- Bandeau statut inscriptions (géré depuis Admin > Paramètres) --}}
@if(!$site['inscription_ouverte'])
<div class="bg-amber-50 border-b border-amber-200 py-4 px-4">
    <div class="max-w-5xl mx-auto flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-amber-200 flex items-center justify-center flex-shrink-0">
            <i class="fi fi-sr-lock text-amber-700 text-sm"></i>
        </div>
        <p class="font-body text-amber-800 text-sm font-semibold">
            Les inscriptions sont actuellement fermées. Contactez-nous pour être mis sur liste d'attente.
        </p>
        <a href="{{ route('contact') }}"
           class="ml-auto flex-shrink-0 inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-900 transition-colors">
            Nous contacter <i class="fi fi-rr-arrow-right text-xs"></i>
        </a>
    </div>
</div>
@else
<div class="bg-emerald-50 border-b border-emerald-200 py-4 px-4">
    <div class="max-w-5xl mx-auto flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-emerald-200 flex items-center justify-center flex-shrink-0">
            <i class="fi fi-sr-check text-emerald-700 text-sm"></i>
        </div>
        <p class="font-body text-emerald-800 text-sm font-semibold">
            Les inscriptions {{ $site['annee_scolaire'] }} sont ouvertes ! Téléchargez les fiches ci-dessous.
        </p>
    </div>
</div>
@endif

<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14" data-aos="fade-up">
            <x-section-title
                title="Inscription au G.S. Victoria-Koa"
                subtitle="Toutes les informations à votre portée pour inscrire votre enfant"
            />
        </div>

        {{-- ── BLOC 1 — Fiches renseignement ── --}}
        <div class="mb-14">
            <h3 class="font-display font-bold text-xl text-dark mb-6 flex items-center gap-2" data-aos="fade-up">
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold flex-shrink-0">1</span>
                Fiches de renseignement
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                $mainForms = [
                    ['icon' => 'fi-sr-child',         'title' => 'Fiche Renseignement Maternelle', 'subtitle' => 'TPS, PS, MS, GS',
                     'color' => '#7C3AED', 'bg' => '#EDE9FE',
                     'href' => "/documents/inscriptions/fiche-inscription-maternelle-{$annee}.pdf"],
                    ['icon' => 'fi-sr-graduation-cap','title' => 'Fiche Renseignement Primaire',   'subtitle' => 'CP1, CP2, CE1, CE2, CM1, CM2',
                     'color' => '#F97316', 'bg' => '#FFEDD5',
                     'href' => "/documents/inscriptions/fiche-inscription-primaire-{$annee}.pdf"],
                ];
                @endphp
                @foreach($mainForms as $i => $form)
                <div class="relative rounded-3xl p-8 overflow-hidden group hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                     style="background-color: {{ $form['bg'] }};"
                     data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed {{ $form['color'] }}40;"></div>
                    <div class="relative z-10 flex items-start gap-5">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-sm"
                             style="background-color: {{ $form['color'] }}20;">
                            <i class="fi {{ $form['icon'] }} text-2xl" style="color: {{ $form['color'] }};"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-display font-bold text-lg text-dark mb-1">{{ $form['title'] }}</h4>
                            <p class="font-body text-sm mb-4" style="color: {{ $form['color'] }};">{{ $form['subtitle'] }}</p>
                            <a href="{{ $form['href'] }}" download target="_blank"
                               class="inline-flex items-center gap-2 px-5 py-2 rounded-full font-body font-bold text-sm text-white
                                      hover:opacity-90 transition-opacity shadow-md"
                               style="background-color: {{ $form['color'] }};">
                                <i class="fi fi-sr-download"></i>
                                Télécharger
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── BLOC 2 — Autres documents ── --}}
        <div class="mb-14">
            <h3 class="font-display font-bold text-xl text-dark mb-6 flex items-center gap-2" data-aos="fade-up">
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold flex-shrink-0">2</span>
                Documents complémentaires
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @php
                $extraDocs = [
                    ['icon' => 'fi-sr-stethoscope',  'title' => 'Fiche médicale',          'color' => '#DC2626', 'bg' => '#FEE2E2',
                     'href' => '/documents/inscriptions/fiche-medicale.pdf'],
                    ['icon' => 'fi-sr-syringe',      'title' => 'Certificat de vaccination','color' => '#0F766E', 'bg' => '#CCFBF1',
                     'href' => '/documents/inscriptions/certificat-vaccination.pdf'],
                ];
                @endphp
                @foreach($extraDocs as $i => $doc)
                <div class="relative rounded-3xl p-6 overflow-hidden text-center group hover:-translate-y-1 hover:shadow-lg transition-all duration-300"
                     style="background-color: {{ $doc['bg'] }};"
                     data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed {{ $doc['color'] }}40;"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm"
                             style="background-color: {{ $doc['color'] }}20;">
                            <i class="fi {{ $doc['icon'] }} text-2xl" style="color: {{ $doc['color'] }};"></i>
                        </div>
                        <h4 class="font-display font-bold text-base text-dark mb-4">{{ $doc['title'] }}</h4>
                        <a href="{{ $doc['href'] }}" download target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-body font-bold text-xs text-white
                                  hover:opacity-90 transition-opacity shadow-sm"
                           style="background-color: {{ $doc['color'] }};">
                            <i class="fi fi-sr-download"></i>
                            Télécharger
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── BLOC 3 — Procédure ── --}}
        <div>
            <h3 class="font-display font-bold text-xl text-dark mb-8 flex items-center gap-2" data-aos="fade-up">
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold flex-shrink-0">3</span>
                Procédure d'inscription
            </h3>

            <div class="space-y-6">
                {{-- Étape 1 --}}
                <div class="flex gap-6" data-aos="fade-right">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-violet-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fi fi-sr-document text-violet-600 text-xl"></i>
                        </div>
                        <div class="flex-1 w-0.5 bg-violet-100 mt-2"></div>
                    </div>
                    <div class="pb-8 flex-1">
                        <div class="bg-violet-50 border border-violet-100 rounded-3xl p-6 relative overflow-hidden">
                            <div class="absolute inset-3 pointer-events-none rounded-2xl"
                                 style="border: 2px dashed #7C3AED30;"></div>
                            <div class="relative z-10">
                                <p class="font-body text-violet-600 text-xs font-bold mb-1 uppercase tracking-wide">Étape 1</p>
                                <h4 class="font-display font-bold text-lg text-dark mb-3">Documents à fournir</h4>
                                <p class="font-body text-gray-600 text-sm mb-4">L'école vous fournira une liste des documents à fournir :</p>
                                <ul class="space-y-2">
                                    @foreach(["Acte de naissance de l'enfant", 'Certificat de vaccination', "04 photos d'identité de l'enfant", "Les frais d'inscription"] as $item)
                                    <li class="flex items-center gap-2 font-body text-gray-700 text-sm">
                                        <i class="fi fi-sr-check-circle text-violet-500 flex-shrink-0"></i>
                                        {{ $item }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Étape 2 --}}
                <div class="flex gap-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fi fi-sr-pencil text-amber-600 text-xl"></i>
                        </div>
                        <div class="flex-1 w-0.5 bg-amber-100 mt-2"></div>
                    </div>
                    <div class="pb-8 flex-1">
                        <div class="bg-amber-50 border border-amber-100 rounded-3xl p-6 relative overflow-hidden">
                            <div class="absolute inset-3 pointer-events-none rounded-2xl"
                                 style="border: 2px dashed #D9770640;"></div>
                            <div class="relative z-10">
                                <p class="font-body text-amber-600 text-xs font-bold mb-1 uppercase tracking-wide">Étape 2</p>
                                <h4 class="font-display font-bold text-lg text-dark mb-3">Remplir le formulaire</h4>
                                <p class="font-body text-gray-600 text-sm">
                                    Téléchargez et remplissez la fiche de renseignement correspondant au cycle de votre enfant, puis retournez-la avec les documents requis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Étape 3 --}}
                <div class="flex gap-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-teal-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fi fi-sr-school text-teal-600 text-xl"></i>
                        </div>
                        <div class="flex-1 w-0.5 bg-teal-100 mt-2"></div>
                    </div>
                    <div class="pb-8 flex-1">
                        <div class="bg-teal-50 border border-teal-100 rounded-3xl p-6 relative overflow-hidden">
                            <div class="absolute inset-3 pointer-events-none rounded-2xl"
                                 style="border: 2px dashed #0F766E40;"></div>
                            <div class="relative z-10">
                                <p class="font-body text-teal-600 text-xs font-bold mb-1 uppercase tracking-wide">Étape 3</p>
                                <h4 class="font-display font-bold text-lg text-dark mb-3">Visite de l'école</h4>
                                <p class="font-body text-gray-600 text-sm">
                                    Venez visiter nos locaux et rencontrer l'équipe pédagogique. Un entretien avec la direction permet de répondre à toutes vos questions.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Étape 4 --}}
                <div class="flex gap-6" data-aos="fade-right" data-aos-delay="300">
                    <div class="flex flex-col items-center">
                        <div class="w-14 h-14 rounded-full bg-pink-100 flex items-center justify-center flex-shrink-0 shadow-sm">
                            <i class="fi fi-sr-check-circle text-pink-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="bg-pink-50 border border-pink-100 rounded-3xl p-6 relative overflow-hidden">
                            <div class="absolute inset-3 pointer-events-none rounded-2xl"
                                 style="border: 2px dashed #EC489940;"></div>
                            <div class="relative z-10">
                                <p class="font-body text-pink-500 text-xs font-bold mb-1 uppercase tracking-wide">Étape 4</p>
                                <h4 class="font-display font-bold text-lg text-dark mb-3">Confirmation & règlement</h4>
                                <p class="font-body text-gray-600 text-sm">
                                    Après validation du dossier, réglez les frais d'inscription pour confirmer la place de votre enfant. Bienvenue dans la famille Victoria-Koa ! 🎉
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Frais d'inscription ── --}}
        <div class="mt-14">
            <h3 class="font-display font-bold text-xl text-dark mb-8 flex items-center gap-2" data-aos="fade-up">
                <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold flex-shrink-0">4</span>
                Frais d'inscription
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Maternelle --}}
                <div class="relative rounded-3xl p-8 overflow-hidden border border-violet-100"
                     style="background-color: #EDE9FE;"
                     data-aos="fade-right">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed #7C3AED40;"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center shadow-sm">
                                <i class="fi fi-sr-child text-violet-600 text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-lg text-dark">Maternelle</h4>
                                <p class="font-body text-violet-600 text-sm">TPS · PS · MS · GS</p>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            @foreach([
                                ['label' => "Frais d'inscription", 'note' => 'Une seule fois'],
                                ['label' => 'Frais de scolarité',  'note' => 'Par trimestre'],
                                ['label' => 'Fournitures scolaires','note' => 'Voir liste PDF'],
                            ] as $item)
                            <li class="flex items-center justify-between bg-white rounded-xl px-4 py-3 shadow-sm">
                                <span class="font-body font-semibold text-sm text-dark">{{ $item['label'] }}</span>
                                <span class="font-body text-xs text-violet-600 font-bold">{{ $item['note'] }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <p class="mt-5 font-body text-violet-700 text-xs font-semibold flex items-center gap-2">
                            <i class="fi fi-sr-info"></i>
                            Contactez-nous pour les tarifs exacts 2025-2026
                        </p>
                    </div>
                </div>

                {{-- Primaire --}}
                <div class="relative rounded-3xl p-8 overflow-hidden border border-orange-100"
                     style="background-color: #FFEDD5;"
                     data-aos="fade-left">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed #F9731640;"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center shadow-sm">
                                <i class="fi fi-sr-graduation-cap text-orange-600 text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-display font-bold text-lg text-dark">Primaire</h4>
                                <p class="font-body text-orange-600 text-sm">CP1 · CP2 · CE1 · CE2 · CM1 · CM2</p>
                            </div>
                        </div>
                        <ul class="space-y-3">
                            @foreach([
                                ['label' => "Frais d'inscription", 'note' => 'Une seule fois'],
                                ['label' => 'Frais de scolarité',  'note' => 'Par trimestre'],
                                ['label' => 'Fournitures scolaires','note' => 'Voir liste PDF'],
                            ] as $item)
                            <li class="flex items-center justify-between bg-white rounded-xl px-4 py-3 shadow-sm">
                                <span class="font-body font-semibold text-sm text-dark">{{ $item['label'] }}</span>
                                <span class="font-body text-xs text-orange-600 font-bold">{{ $item['note'] }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <p class="mt-5 font-body text-orange-700 text-xs font-semibold flex items-center gap-2">
                            <i class="fi fi-sr-info"></i>
                            Contactez-nous pour les tarifs exacts 2025-2026
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA contact --}}
        <div class="mt-14 text-center bg-violet-50 rounded-3xl px-8 py-10" data-aos="fade-up">
            <i class="fi fi-sr-phone-call text-primary text-4xl mb-4 block"></i>
            <h3 class="font-display font-bold text-2xl text-dark mb-2">Une question sur l'inscription ?</h3>
            <p class="font-body text-gray-600 text-sm mb-6">Notre équipe est disponible pour vous accompagner.</p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-primary text-white font-body font-bold
                      hover:bg-purple-700 transition-colors duration-300 shadow-lg shadow-purple-200">
                Nous contacter
                <i class="fi fi-sr-arrow-right"></i>
            </a>
        </div>

    </div>
</section>

@endsection

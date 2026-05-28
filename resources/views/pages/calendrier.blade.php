@extends('layouts.app')

@php $annee = \App\Models\Setting::schoolYear(); @endphp
@section('title', 'Calendrier Scolaire ' . $annee)
@section('meta_description', 'Calendrier scolaire ' . $annee . ' du GS VICTORIA-KOA : rentrée, vacances, examens et événements de l\'année scolaire. Téléchargez le calendrier complet.')
@section('canonical', url('/calendrier-scolaire'))

@section('content')

<x-page-banner
    title="Calendrier Scolaire"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Calendrier Scolaire']]"
/>

<section class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Bouton téléchargement --}}
        <div class="flex justify-center mb-12" data-aos="fade-up">
            <a href="/documents/calendrier/calendrier-scolaire-{{ $annee }}.pdf"
               download target="_blank"
               class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-primary text-white font-body font-bold
                      hover:bg-purple-700 hover:scale-105 transition-all duration-300 shadow-lg shadow-purple-200">
                <i class="fi fi-sr-download text-xl"></i>
                Télécharger le calendrier complet 2025-2026
            </a>
        </div>

        {{-- Grand tableau --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-purple-100/50 overflow-hidden border border-purple-100"
             data-aos="fade-up" data-no-tilt>

            {{-- En-tête tableau --}}
            <div class="bg-gradient-to-r from-primary to-purple-800 px-8 py-6 text-center">
                <h2 class="font-display font-extrabold text-white text-xl md:text-2xl tracking-wide">
                    CALENDRIER SCOLAIRE {{ strtoupper(str_replace('-', ' – ', $annee)) }}
                </h2>
                <p class="font-body text-white/70 text-sm mt-1">Groupe Scolaire VICTORIA-KOA</p>
            </div>

            <div class="divide-y divide-gray-100">
                @foreach($rows as $row)
                @php $s = $row->styles; @endphp
                {{-- Mobile : stack vertical | md+ : grille 12 cols --}}
                <div class="flex flex-col md:grid md:grid-cols-12 md:items-center px-4 md:px-6 py-4 gap-1 md:gap-0 {{ $s['bg'] }} hover:brightness-95 transition-all">
                    {{-- Icône + label --}}
                    <div class="flex items-center gap-2 md:contents">
                        <div class="md:col-span-1 flex justify-center flex-shrink-0">
                            <i class="fi {{ $row->icone }} text-lg {{ $s['text'] }}"></i>
                        </div>
                        <div class="md:col-span-6 md:pl-3">
                            <span class="font-body font-bold text-sm {{ $s['text'] }}">{{ $row->label }}</span>
                        </div>
                    </div>
                    {{-- Date + durée --}}
                    <div class="flex items-center justify-between md:contents">
                        <div class="md:col-span-4 font-body text-xs text-gray-600">{{ $row->date_affichee ?? '—' }}</div>
                        <div class="md:col-span-1 md:text-right">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-bold {{ $s['badge'] }}">{{ $row->duree }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Box jours fériés --}}
        <div class="mt-10 rounded-3xl p-8 overflow-hidden relative border border-amber-200"
             style="background-color: #FFF7ED;"
             data-aos="fade-up">

            {{-- Effet cousu --}}
            <div class="absolute inset-3 pointer-events-none rounded-2xl"
                 style="border: 2px dashed #F97316 40;"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center">
                        <i class="fi fi-sr-star text-amber-500 text-xl"></i>
                    </div>
                    <h3 class="font-display font-bold text-xl text-amber-900">
                        Ajoutés aux congés les journées suivantes :
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($feries as $f)
                    <div class="flex items-center justify-between bg-white rounded-xl px-4 py-2.5 shadow-sm">
                        <span class="font-body font-semibold text-sm text-amber-900">{{ $f->label }}</span>
                        <span class="font-body text-xs text-gray-500">{{ $f->date_affichee }}</span>
                    </div>
                    @endforeach
                </div>

                <p class="mt-4 font-body text-amber-700 text-sm italic">
                    Et quatre (4) fêtes musulmanes : Fête de Maouloud, Jour après Nuit du destin
                    (dates variables selon le calendrier islamique).
                </p>
            </div>
        </div>

    </div>
</section>

@endsection

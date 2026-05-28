@extends('layouts.app')

@php $annee = \App\Models\Setting::schoolYear(); @endphp
@section('title', 'Fournitures Scolaires ' . $annee)
@section('meta_description', 'Liste des fournitures scolaires ' . $annee . ' du GS VICTORIA-KOA. Téléchargez la liste par classe : TPS, PS, MS, GS, CP, CE1, CE2, CM1, CM2.')
@section('meta_keywords', 'fournitures scolaires Abidjan ' . $annee . ', liste fournitures maternelle, liste fournitures primaire, VICTORIA-KOA')
@section('canonical', url('/fournitures-scolaires'))

@section('content')

<x-page-banner
    title="Fournitures Scolaires"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Fournitures Scolaires']]"
/>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14" data-aos="fade-up">
            <x-section-title
                title="Liste des fournitures scolaires {{ $annee }}"
                subtitle="Téléchargez la liste de fournitures de votre classe"
            />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($levels as $i => $level)
            <div class="relative rounded-3xl p-8 overflow-hidden group hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                 style="background-color: {{ $level['bg'] }};"
                 data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">

                {{-- Blob déco --}}
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full pointer-events-none opacity-40"
                     style="background-color: {{ $level['color'] }}20;"></div>

                {{-- Effet cousu --}}
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed {{ $level['color'] }}40;"></div>

                <div class="relative z-10">
                    {{-- Badge cycle --}}
                    <span class="inline-block px-3 py-1 rounded-full font-body text-xs font-bold mb-5"
                          style="background-color: {{ $level['color'] }}20; color: {{ $level['color'] }};">
                        {{ $level['cycle'] }}
                    </span>

                    {{-- Icône --}}
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm"
                         style="background-color: {{ $level['color'] }}20;">
                        <i class="fi fi-sr-school-bus text-2xl" style="color: {{ $level['color'] }};"></i>
                    </div>

                    {{-- Code + Nom --}}
                    <h3 class="font-display font-extrabold text-2xl mb-1" style="color: {{ $level['color'] }};">
                        {{ $level['code'] }}
                    </h3>
                    <p class="font-body text-gray-600 text-sm mb-6 leading-snug">{{ $level['name'] }}</p>

                    {{-- Bouton download --}}
                    <a href="/documents/fournitures/{{ $level['pdf'] }}"
                       download
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-body font-bold text-sm text-white
                              hover:opacity-90 hover:scale-105 transition-all duration-300 shadow-md"
                       style="background-color: {{ $level['color'] }};">
                        <i class="fi fi-sr-download"></i>
                        Télécharger
                    </a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection

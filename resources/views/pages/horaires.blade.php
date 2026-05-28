@extends('layouts.app')

@section('title', 'Horaires')
@section('meta_description', 'Horaires de l\'école GS VICTORIA-KOA à Angré, Abidjan. Accueil, heures de cours, pause déjeuner et activités périscolaires pour la maternelle et le primaire.')
@section('canonical', url('/les-horaires'))

@section('content')

<x-page-banner
    title="Les Horaires"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Les Horaires']]"
/>

<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14" data-aos="fade-up">
            <x-section-title
                title="Les horaires de cours"
                subtitle="Nos horaires de cours sont les suivants :"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Card 1 — Jours de cours --}}
            <div class="relative bg-purple-50 border-2 border-purple-100 rounded-3xl p-8 overflow-hidden"
                 data-aos="fade-right">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #7C3AED40;"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center flex-shrink-0">
                            <i class="fi fi-sr-calendar text-violet-600 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="font-display font-bold text-xl text-dark">Jours de cours</h2>
                            <p class="font-body text-violet-600 text-sm font-semibold">{{ $horaires['jours'] }}</p>
                        </div>
                    </div>
                    <div class="border-t-2 border-dashed border-violet-200 mb-5"></div>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between bg-white rounded-2xl px-5 py-3 shadow-sm">
                            <div class="flex items-center gap-3">
                                <i class="fi fi-sr-sun text-amber-500 text-lg"></i>
                                <span class="font-body font-semibold text-dark text-sm">Matin</span>
                            </div>
                            <span class="font-display font-bold text-violet-700">{{ $horaires['matin_debut'] }} – {{ $horaires['matin_fin'] }}</span>
                        </div>
                        <div class="flex items-center justify-between bg-white rounded-2xl px-5 py-3 shadow-sm">
                            <div class="flex items-center gap-3">
                                <i class="fi fi-sr-cloud-sun text-blue-400 text-lg"></i>
                                <span class="font-body font-semibold text-dark text-sm">Après-midi</span>
                            </div>
                            <span class="font-display font-bold text-violet-700">{{ $horaires['apm_debut'] }} – {{ $horaires['apm_fin'] }}</span>
                        </div>
                    </div>
                    <p class="mt-5 font-body text-gray-500 text-xs flex items-center gap-2">
                        <i class="fi fi-sr-info text-violet-400"></i>
                        Les élèves sont accueillis dès <strong class="ml-1">{{ $horaires['accueil'] }}</strong>
                    </p>
                </div>
            </div>

            {{-- Card 2 — Jours sans cours --}}
            <div class="relative bg-gray-50 border-2 border-gray-200 rounded-3xl p-8 overflow-hidden"
                 data-aos="fade-left">
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #6B728040;"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-gray-200 flex items-center justify-center flex-shrink-0">
                            <i class="fi fi-sr-moon text-gray-500 text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="font-display font-bold text-xl text-dark">Jours sans cours</h2>
                            <p class="font-body text-gray-500 text-sm font-semibold">{{ $horaires['jours_fermes'] }}</p>
                        </div>
                    </div>
                    <div class="border-t-2 border-dashed border-gray-300 mb-5"></div>
                    <div class="bg-white rounded-2xl px-5 py-8 shadow-sm text-center">
                        <i class="fi fi-sr-heart text-pink-400 text-4xl mb-3 block"></i>
                        <p class="font-body text-gray-600 text-sm leading-relaxed">
                            Pas de cours — Profitez du repos bien mérité !
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Note --}}
        <div class="mt-10 bg-amber-50 border border-amber-200 rounded-2xl px-6 py-4 flex items-start gap-3"
             data-aos="fade-up">
            <i class="fi fi-sr-bulb text-amber-500 text-xl flex-shrink-0 mt-0.5"></i>
            <p class="font-body text-amber-800 text-sm leading-relaxed">
                Les horaires peuvent être ajustés lors de journées pédagogiques ou d'événements scolaires.
                Consultez le <a href="{{ route('calendrier') }}" class="font-semibold underline hover:text-amber-600 transition-colors">calendrier scolaire</a> pour rester informé.
            </p>
        </div>

    </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Actualités')
@section('meta_description', 'Toutes les actualités du Groupe Scolaire VICTORIA-KOA : événements scolaires, activités sportives, animations pédagogiques et vie de l\'école à Abidjan.')
@section('canonical', url('/actualites'))

@section('content')

<x-page-banner
    title="Actualités"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Actualités']]"
/>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12" data-aos="fade-up">
            <x-section-title
                title="Actualités Récentes"
                subtitle="Restez informés des dernières nouvelles et événements du Groupe Scolaire VICTORIA-KOA."
            />
        </div>

        <div x-data="{ active: 'all' }">

            {{-- Filtres dynamiques depuis DB --}}
            <div class="flex flex-wrap gap-3 justify-center mb-10" data-aos="fade-up">
                <button @click="active = 'all'"
                        :class="active === 'all' ? 'bg-primary text-white shadow-lg shadow-purple-200' : 'bg-white text-gray-600 hover:bg-violet-50'"
                        class="px-5 py-2 rounded-full border border-gray-200 font-body font-semibold text-sm transition-all duration-200">
                    Tous
                </button>
                @foreach($categories as $cat)
                <button @click="active = '{{ $cat }}'"
                        :class="active === '{{ $cat }}' ? 'bg-primary text-white shadow-lg shadow-purple-200' : 'bg-white text-gray-600 hover:bg-violet-50'"
                        class="px-5 py-2 rounded-full border border-gray-200 font-body font-semibold text-sm transition-all duration-200">
                    {{ $cat }}
                </button>
                @endforeach
            </div>

            {{-- Grille articles --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="fade-up">
                @forelse($articles as $i => $article)
                <div x-show="active === 'all' || active === '{{ $article->categorie }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100
                            hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                     style="animation: galleryIn 0.4s ease-out {{ ($i % 6) * 70 }}ms both;">

                    <div class="relative h-48 overflow-hidden">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="{{ $article->titre }}"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">
                            <div class="absolute inset-0"
                                 style="background: linear-gradient(to top, rgba(0,0,0,0.3) 0%, transparent 60%);"></div>
                        @else
                            @php
                            $gradients = ['from-violet-400 to-pink-400','from-teal-400 to-blue-400','from-amber-400 to-orange-400','from-green-400 to-teal-400'];
                            @endphp
                            <div class="w-full h-full bg-gradient-to-br {{ $gradients[$i % 4] }} flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                <i class="fi fi-sr-star text-6xl text-white/90"></i>
                            </div>
                        @endif
                        <span class="absolute top-4 left-4 {{ $article->badge_bg }} text-white px-3 py-1 rounded-full text-xs font-body font-bold shadow">
                            {{ $article->categorie }}
                        </span>
                    </div>

                    <div class="p-6">
                        <p class="font-body text-gray-400 text-xs mb-2 flex items-center gap-1">
                            <i class="fi fi-rr-calendar"></i>
                            {{ $article->date_publication->translatedFormat('j F Y') }}
                        </p>
                        <h3 class="font-display font-bold text-dark text-xl mb-3 line-clamp-2">{{ $article->titre }}</h3>
                        <p class="font-body text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">{{ $article->extrait }}</p>
                        <a href="{{ route('actualites.show', $article) }}"
                           class="inline-flex items-center gap-1 font-body font-semibold text-primary text-sm hover:gap-2 transition-all duration-200">
                            Lire la suite
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-20 text-center">
                    <div class="w-20 h-20 rounded-full bg-violet-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fi fi-sr-newspaper text-violet-400 text-3xl"></i>
                    </div>
                    <p class="font-body text-gray-500">Aucune actualité publiée pour l'instant.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</section>

@endsection

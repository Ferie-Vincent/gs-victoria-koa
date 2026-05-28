@extends('layouts.app')

@section('title', 'Galerie Photos')
@section('meta_description', 'Galerie photos du Groupe Scolaire VICTORIA-KOA : vie scolaire, activités, événements et moments forts de nos élèves à Angré, Abidjan.')
@section('canonical', url('/galleries'))

@section('content')

<x-page-banner
    title="Nos Galeries"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Nos Galeries']]"
/>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-12" data-aos="fade-up">
            <x-section-title
                title="Galerie Photos"
                subtitle="Découvrez les moments forts de la vie scolaire au Groupe Scolaire VICTORIA-KOA."
            />
        </div>

        <div x-data="{ active: 'all' }">

            {{-- Filtres dynamiques (seulement les catégories ayant des photos) --}}
            @if(count($categories) > 1)
            <div class="flex flex-wrap gap-3 justify-center mb-10" data-aos="fade-up">
                @php
                $catLabels = ['pro' => 'Photos officielles', 'vie' => 'Vie scolaire'];
                @endphp
                <button @click="active = 'all'"
                        :class="active === 'all' ? 'bg-primary text-white shadow-lg shadow-purple-200' : 'bg-white text-gray-600 hover:bg-violet-50'"
                        class="px-5 py-2 rounded-full border border-gray-200 font-body font-semibold text-sm transition-all duration-200">
                    Toutes
                </button>
                @foreach($categories as $cat)
                <button @click="active = '{{ $cat }}'"
                        :class="active === '{{ $cat }}' ? 'bg-primary text-white shadow-lg shadow-purple-200' : 'bg-white text-gray-600 hover:bg-violet-50'"
                        class="px-5 py-2 rounded-full border border-gray-200 font-body font-semibold text-sm transition-all duration-200">
                    {{ $catLabels[$cat] ?? ucfirst($cat) }}
                </button>
                @endforeach
            </div>
            @endif

            {{-- Grille photos --}}
            @if(count($photos) > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" data-aos="fade-up">
                @foreach($photos as $i => $photo)
                <div x-show="active === 'all' || active === '{{ $photo['category'] }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group relative overflow-hidden rounded-2xl aspect-square bg-violet-50"
                     style="animation: galleryIn 0.4s ease-out {{ ($i % 8) * 60 }}ms both;">
                    <a href="{{ $photo['src'] }}"
                       class="glightbox block w-full h-full"
                       data-gallery="gallery-main"
                       data-description="GS Victoria-Koa — Photo {{ $i + 1 }}">
                        <img src="{{ $photo['thumb'] }}"
                             alt="Photo de l'école GS Victoria-Koa — {{ $photo['category'] === 'pro' ? 'Portraits officiels' : 'Vie scolaire' }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out"
                             loading="{{ $i < 8 ? 'eager' : 'lazy' }}">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center gap-1">
                                <i class="fi fi-sr-search text-white text-2xl drop-shadow"></i>
                                <span class="text-white text-xs font-body font-semibold drop-shadow">Agrandir</span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-24 h-24 rounded-full bg-violet-100 flex items-center justify-center mx-auto mb-6">
                    <i class="fi fi-sr-camera text-violet-400 text-4xl"></i>
                </div>
                <h3 class="font-display font-bold text-xl text-dark mb-2">Les photos arrivent bientôt !</h3>
                <p class="font-body text-gray-500">Nous préparons de beaux souvenirs à partager avec vous.</p>
            </div>
            @endif

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: false,
        openEffect: 'zoom',
        closeEffect: 'fade',
    });
});
</script>
@endpush

@extends('layouts.app')

@section('title', $actualite->titre)
@section('meta_description', $actualite->extrait)

@section('content')

{{-- ── Hero article ─────────────────────────────────────────────────────── --}}
<div class="relative overflow-hidden" style="min-height: 380px;">

    {{-- Image de fond --}}
    @if($actualite->image)
    <div class="absolute inset-0">
        <img src="{{ $actualite->image }}" alt="{{ $actualite->titre }}"
             class="w-full h-full object-cover object-top">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(15,5,40,0.55) 0%, rgba(15,5,40,0.82) 100%);"></div>
    </div>
    @else
    <div class="absolute inset-0 bg-gradient-to-br from-violet-900 to-purple-800">
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 24px 24px;"></div>
    </div>
    @endif

    {{-- Contenu hero --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex flex-col justify-end" style="min-height: 380px;">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-white/60 text-xs font-body mb-6">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Accueil</a>
            <i class="fi fi-rr-angle-right text-[10px]"></i>
            <a href="{{ route('actualites') }}" class="hover:text-white transition-colors">Actualités</a>
            <i class="fi fi-rr-angle-right text-[10px]"></i>
            <span class="text-white/40 truncate max-w-xs">{{ Str::limit($actualite->titre, 40) }}</span>
        </nav>

        {{-- Badge catégorie --}}
        <div class="mb-4">
            <span class="{{ $actualite->badge_bg }} text-white px-4 py-1.5 rounded-full text-xs font-body font-bold shadow">
                {{ $actualite->categorie }}
            </span>
        </div>

        {{-- Titre --}}
        <h1 class="font-display font-extrabold text-white text-3xl md:text-4xl leading-tight mb-4" data-aos="fade-up">
            {{ $actualite->titre }}
        </h1>

        {{-- Meta --}}
        <div class="flex items-center gap-4 text-white/70 text-sm font-body" data-aos="fade-up" data-aos-delay="100">
            <span class="flex items-center gap-1.5">
                <i class="fi fi-rr-calendar text-xs"></i>
                {{ $actualite->date_publication->translatedFormat('j F Y') }}
            </span>
            <span class="text-white/30">·</span>
            <span class="flex items-center gap-1.5">
                <i class="fi fi-rr-school text-xs"></i>
                GS Victoria-Koa
            </span>
        </div>

    </div>
</div>

{{-- ── Corps de l'article ────────────────────────────────────────────────── --}}
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- ── Contenu principal ────────────────────────────────── --}}
            <div class="lg:col-span-8">

                {{-- Extrait mis en avant --}}
                <div class="bg-violet-50 border-l-4 border-primary rounded-r-2xl px-6 py-5 mb-8" data-aos="fade-up">
                    <p class="font-body text-violet-900 text-base leading-relaxed font-semibold italic">
                        {{ $actualite->extrait }}
                    </p>
                </div>

                {{-- Corps de l'article --}}
                @if($actualite->contenu)
                <div class="prose prose-violet max-w-none font-body text-gray-700 leading-relaxed space-y-4"
                     data-aos="fade-up" data-aos-delay="100">
                    {!! nl2br(e($actualite->contenu)) !!}
                </div>
                @endif

                {{-- Galerie photos (images multiples) --}}
                @if(count($actualite->all_photos) > 1)
                <div class="mt-10" data-aos="fade-up">
                    <h3 class="font-display font-bold text-dark text-xl mb-5 flex items-center gap-2">
                        <i class="fi fi-sr-camera text-primary text-lg"></i>
                        Photos
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($actualite->all_photos as $i => $photo)
                        <a href="{{ $photo }}"
                           class="glightbox block relative aspect-square rounded-2xl overflow-hidden group"
                           data-gallery="article-gallery"
                           data-description="{{ $actualite->titre }}">
                            <img src="{{ $photo }}" alt="Photo {{ $i + 1 }}"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25 transition-all duration-300 flex items-center justify-center">
                                <i class="fi fi-sr-search text-white text-xl opacity-0 group-hover:opacity-100 transition-opacity drop-shadow"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @elseif($actualite->image)
                {{-- Image unique déjà dans le hero, rien à répéter --}}
                @endif

                {{-- Partage / retour --}}
                <div class="mt-10 pt-8 border-t border-gray-100 flex items-center justify-between flex-wrap gap-4" data-aos="fade-up">
                    <a href="{{ route('actualites') }}"
                       class="inline-flex items-center gap-2 text-sm font-body font-semibold text-gray-500 hover:text-primary transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Retour aux actualités
                    </a>
                    <span class="text-xs text-gray-300">Groupe Scolaire VICTORIA-KOA — Angré, Abidjan</span>
                </div>

            </div>

            {{-- ── Sidebar ───────────────────────────────────────────── --}}
            <aside class="lg:col-span-4" data-aos="fade-left">

                {{-- Infos école --}}
                <div class="bg-violet-50 rounded-3xl p-6 mb-6 sticky top-6">
                    <h4 class="font-display font-bold text-dark text-base mb-4">Contacter l'école</h4>
                    <div class="space-y-3">
                        <a href="tel:{{ preg_replace('/\s/', '', $site['telephone_1']) }}"
                           class="flex items-center gap-3 text-sm font-body text-gray-700 hover:text-primary transition-colors group">
                            <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all">
                                <i class="fi fi-sr-phone-call text-primary group-hover:text-white text-xs"></i>
                            </div>
                            {{ $site['telephone_1'] }}
                        </a>
                        <a href="mailto:{{ $site['email_direction'] }}"
                           class="flex items-center gap-3 text-sm font-body text-gray-700 hover:text-primary transition-colors group">
                            <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:text-white transition-all">
                                <i class="fi fi-sr-envelope text-primary group-hover:text-white text-xs"></i>
                            </div>
                            {{ $site['email_direction'] }}
                        </a>
                    </div>
                    <div class="mt-5 pt-4 border-t border-violet-200">
                        <a href="{{ route('inscription') }}"
                           class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-primary text-white font-body font-bold text-sm hover:bg-purple-700 transition-all duration-300 shadow-md shadow-purple-200">
                            <i class="fi fi-sr-graduation-cap"></i>
                            Inscrire mon enfant
                        </a>
                    </div>
                </div>

            </aside>

        </div>
    </div>
</section>

{{-- ── Autres actualités ─────────────────────────────────────────────────── --}}
@if($autres->count() > 0)
<section class="py-16 bg-section-alt">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="font-display font-extrabold text-2xl text-dark mb-8 flex items-center gap-3">
            <i class="fi fi-sr-newspaper text-primary text-xl"></i>
            Autres actualités
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($autres as $i => $art)
            <a href="{{ route('actualites.show', $art) }}"
               class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100
                      hover:-translate-y-1 hover:shadow-lg transition-all duration-300"
               data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                <div class="relative h-40 overflow-hidden">
                    @if($art->image)
                    <img src="{{ $art->image }}" alt="{{ $art->titre }}"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                    @else
                    @php $gradients = ['from-violet-400 to-pink-400','from-teal-400 to-blue-400','from-amber-400 to-orange-400']; @endphp
                    <div class="w-full h-full bg-gradient-to-br {{ $gradients[$i % 3] }} flex items-center justify-center">
                        <i class="fi fi-sr-star text-4xl text-white/80"></i>
                    </div>
                    @endif
                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.25) 0%, transparent 60%);"></div>
                    <span class="absolute top-3 left-3 {{ $art->badge_bg }} text-white px-2.5 py-1 rounded-full text-xs font-body font-bold">
                        {{ $art->categorie }}
                    </span>
                </div>

                <div class="p-5">
                    <p class="font-body text-gray-400 text-xs mb-1.5">{{ $art->date_publication->translatedFormat('j F Y') }}</p>
                    <h3 class="font-display font-bold text-dark text-base leading-snug line-clamp-2 group-hover:text-primary transition-colors">{{ $art->titre }}</h3>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection

@if(count($actualite->all_photos) > 1)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        openEffect: 'zoom',
        closeEffect: 'fade',
    });
});
</script>
@endpush
@endif

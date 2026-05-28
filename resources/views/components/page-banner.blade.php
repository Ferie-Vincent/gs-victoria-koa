{{--
    Page Banner Component
    @param string $title    — Titre principal
    @param array  $breadcrumb — [['label' => 'Accueil', 'route' => 'home'], ['label' => 'Page courante']]
    @param string $color    — Couleur accent (default: 'primary')
--}}
@props(['title', 'breadcrumb' => [], 'color' => 'primary'])

<section class="bg-hero pt-28 pb-16 relative overflow-hidden">

    {{-- Bulles décoratives --}}
    <div aria-hidden="true" class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-8 left-8 w-16 h-16 rounded-full bg-white/10 animate-float-1"></div>
        <div class="absolute top-1/2 right-12 w-10 h-10 rounded-full bg-yellow-300/20 animate-float-2"></div>
        <div class="absolute bottom-8 left-1/3 w-8 h-8 rounded-full bg-pink-300/20 animate-float-3"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="font-display font-extrabold text-3xl md:text-5xl text-white mb-4"
            data-aos="fade-up">
            {{ $title }}
        </h1>

        @if(count($breadcrumb) > 0)
        <nav aria-label="Fil d'Ariane" data-aos="fade-up" data-aos-delay="100">
            <ol class="flex items-center gap-2 text-sm font-body text-white/75">
                @foreach($breadcrumb as $index => $crumb)
                    @if(!$loop->last)
                        <li>
                            <a href="{{ isset($crumb['route']) ? route($crumb['route']) : '#' }}"
                               class="hover:text-white transition-colors">
                                {{ $crumb['label'] }}
                            </a>
                        </li>
                        <li aria-hidden="true">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </li>
                    @else
                        <li class="text-white font-semibold" aria-current="page">{{ $crumb['label'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
        @endif
    </div>

    {{-- Wave bas --}}
    <div aria-hidden="true" class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none">
        <svg viewBox="0 0 1440 40" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full">
            <path d="M0,20 C360,40 1080,0 1440,20 L1440,40 L0,40 Z" fill="white"/>
        </svg>
    </div>
</section>

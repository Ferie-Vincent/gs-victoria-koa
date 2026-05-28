<section class="bg-hero relative overflow-hidden flex items-center pt-20"
         style="min-height: 85vh;">

    {{-- SVG Pointillés overlay --}}
    <div aria-hidden="true" class="absolute inset-0 opacity-10 z-[1]"
         style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;">
    </div>

    {{-- Bulles flottantes --}}
    @include('components.floating-bubbles')

    {{-- Nuage SVG animé --}}
    <div aria-hidden="true" class="absolute top-16 left-0 opacity-20 z-[1] animate-[cloud_18s_linear_infinite]">
        <svg width="200" height="60" viewBox="0 0 200 60" fill="white">
            <ellipse cx="60" cy="40" rx="60" ry="20"/>
            <ellipse cx="100" cy="30" rx="50" ry="22"/>
            <ellipse cx="140" cy="40" rx="40" ry="18"/>
        </svg>
    </div>

    {{-- ───── Garçon hero : PNG fond transparent, ancré en bas, cadré sur centre-droite ── --}}
    <img src="{{ asset('images/hero/boy-hero.png') }}"
         alt="Élève GS Victoria-Koa en uniforme"
         class="absolute bottom-0 z-[2] pointer-events-none hidden lg:block"
         loading="eager"
         style="height: 92%; width: auto; left: 53%;
                filter: drop-shadow(-6px 0 32px rgba(124,58,237,0.4));">

    {{-- ───── Contenu texte ───────────────────────────────────────────────── --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 relative z-10">
        <div class="max-w-xl">

            {{-- Badge école --}}
            <div class="inline-flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full text-sm font-body font-semibold mb-6 text-white"
                 data-aos="fade-down">
                <i class="fi fi-sr-star text-secondary"></i> École de confiance depuis 2014
            </div>

            {{-- Titre --}}
            <h1 class="font-display font-extrabold text-4xl md:text-6xl leading-tight mb-6 text-white"
                data-aos="fade-up" data-aos-delay="100">
                Bienvenue à<br>
                <span class="text-secondary">VICTORIA-KOA</span>
            </h1>

            <p class="font-body text-white/90 text-lg md:text-xl leading-relaxed mb-4"
               data-aos="fade-up" data-aos-delay="200">
                Nous avons un programme unique qui aide chaque enfant à s'adapter rapidement et à se sentir chez lui.
            </p>
            <p class="font-body text-white/80 text-base leading-relaxed mb-8"
               data-aos="fade-up" data-aos-delay="300">
                Nous aidons également chaque enfant à trouver sa propre voie.
            </p>

            {{-- Badges stats --}}
            <div class="flex gap-4 mb-8" data-aos="fade-up" data-aos-delay="350">
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl px-4 py-3 text-center">
                    <p class="font-display font-extrabold text-2xl text-secondary leading-none">+400</p>
                    <p class="font-body text-white/80 text-xs mt-1">élèves</p>
                </div>
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl px-4 py-3 text-center">
                    <p class="font-display font-extrabold text-2xl text-secondary leading-none">10</p>
                    <p class="font-body text-white/80 text-xs mt-1">niveaux</p>
                </div>
                <div class="bg-white/15 backdrop-blur-sm border border-white/20 rounded-2xl px-4 py-3 text-center">
                    <p class="font-display font-extrabold text-2xl text-secondary leading-none">+10</p>
                    <p class="font-body text-white/80 text-xs mt-1">ans d'expérience</p>
                </div>
            </div>

            {{-- Boutons CTA --}}
            <div class="flex flex-col sm:flex-row flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('inscription') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full bg-secondary text-dark font-body font-bold text-base hover:scale-105 hover:shadow-2xl transition-all duration-300 shadow-lg">
                    <i class="fi fi-sr-book"></i>
                    S'inscrire maintenant
                </a>
                <a href="{{ route('about') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-full border-2 border-white text-white font-body font-bold text-base hover:bg-white hover:text-primary transition-all duration-300">
                    En savoir plus
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Indicateur scroll --}}
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce z-10" aria-hidden="true">
        <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>

    {{-- Wave bas --}}
    <div aria-hidden="true" class="absolute bottom-0 left-0 right-0 overflow-hidden leading-none z-[3]">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full">
            <path d="M0,30 C360,60 1080,0 1440,30 L1440,60 L0,60 Z" fill="#FEFCE8"/>
        </svg>
    </div>
</section>

@push('head')
<style>
@keyframes cloud {
  from { transform: translateX(-100%); }
  to   { transform: translateX(110vw); }
}
</style>
@endpush

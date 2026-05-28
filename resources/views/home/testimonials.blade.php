<section class="py-20 bg-section-alt">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <x-section-title title="Ce que disent les parents" subtitle="La confiance des familles est notre plus belle récompense." />
        </div>

        {{-- Swiper — pt-10 pour laisser l'avatar déborder vers le haut --}}
        <div class="swiper swiper-testimonials pb-12" style="padding-top: 2.5rem; overflow: hidden;" data-aos="fade-up">
            <div class="swiper-wrapper">

                @foreach($temoignages as $t)
                <div class="swiper-slide" style="height: auto; padding-top: 2.5rem;">
                    {{-- Card bulle --}}
                    <div class="relative bg-white border-2 border-gray-200 rounded-3xl p-6 pt-10 h-full
                                hover:border-primary/40 hover:shadow-lg hover:shadow-violet-50 transition-all duration-300">

                        {{-- Avatar --}}
                        <div class="absolute -top-8 left-5">
                            <div class="w-16 h-16 rounded-full border-4 border-white shadow-md
                                        flex items-center justify-center text-white font-display font-bold text-base
                                        {{ $t->bg_color }}">
                                {{ $t->initiales }}
                            </div>
                        </div>

                        {{-- Étoiles --}}
                        <div class="flex items-center justify-end gap-0.5 mb-5">
                            @for($s = 0; $s < $t->note; $s++)
                            <i class="fi fi-sr-star text-secondary text-sm"></i>
                            @endfor
                        </div>

                        {{-- Texte --}}
                        <p class="font-body text-gray-700 text-sm leading-relaxed mb-5">
                            « {{ $t->texte }} »
                        </p>

                        <div class="border-t-2 border-dashed border-gray-200 mb-4"></div>

                        <div class="flex items-end justify-between">
                            <div>
                                <p class="font-body font-bold text-dark text-sm">{{ $t->nom_parent }}</p>
                                <p class="font-body text-gray-500 text-xs mt-0.5">{{ $t->role_parent }}</p>
                            </div>
                            <div class="text-5xl font-display text-primary/20 leading-none select-none"
                                 aria-hidden="true" style="line-height: 0.8;">"</div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-pagination mt-6"></div>
        </div>
    </div>
</section>

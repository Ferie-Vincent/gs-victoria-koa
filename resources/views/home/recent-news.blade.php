<section class="py-20 bg-section-alt">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-section-title title="Actualités Récentes" subtitle="Restez informé de la vie de notre école." />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($recentNews as $i => $article)
            <div class="bg-white rounded-3xl overflow-hidden card-hover shadow-sm hover:shadow-violet group"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                <div class="relative h-52 overflow-hidden">
                    @if($article->image)
                    <img src="{{ $article->image }}"
                         alt="{{ $article->titre }}"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 ease-out"
                         loading="lazy">
                    @endif
                    <div class="absolute inset-0"
                         style="background: linear-gradient(to top, rgba(0,0,0,0.35) 0%, transparent 60%);"></div>
                    <span class="absolute top-4 left-4 {{ $article->badge_bg }} text-white px-3 py-1 rounded-full text-xs font-body font-bold shadow">
                        {{ $article->categorie }}
                    </span>
                </div>

                <div class="p-6">
                    <p class="font-body text-gray-400 text-xs mb-2">
                        <i class="fi fi-rr-calendar mr-1"></i>{{ $article->date_publication->format('j F Y') }}
                    </p>
                    <h3 class="font-display font-bold text-dark text-xl mb-3">{{ $article->titre }}</h3>
                    <p class="font-body text-gray-500 text-sm leading-relaxed mb-4">{{ $article->extrait }}</p>
                    <a href="{{ route('actualites.show', $article) }}"
                       class="inline-flex items-center gap-1 font-body font-semibold text-primary text-sm hover:gap-2 transition-all duration-200">
                        Lire la suite
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('actualites') }}"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-primary text-primary font-body font-semibold hover:bg-primary hover:text-white transition-all duration-300">
                Voir toutes les actualités
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

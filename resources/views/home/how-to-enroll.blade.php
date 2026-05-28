<section class="py-20" style="background-color: #EDE9FE;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-section-title title="Comment inscrire votre enfant ?" />
        </div>

        {{-- Timeline --}}
        <div class="relative">
            {{-- Ligne pointillée verticale --}}
            <div class="absolute left-8 top-12 bottom-12 w-0.5 border-l-2 border-dashed border-primary/30 hidden sm:block" aria-hidden="true"></div>

            <div class="space-y-10">

                {{-- Étape 1 --}}
                <div class="flex gap-6" data-aos="fade-up">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white font-display font-extrabold text-xl shadow-violet z-10 relative">
                            1
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-8 flex-1 shadow-violet">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="fi fi-sr-document text-2xl text-primary"></i>
                            <h3 class="font-display font-bold text-xl text-dark">Documents à fournir</h3>
                        </div>
                        <ul class="space-y-2 font-body text-gray-600">
                            @foreach([
                                'Acte de naissance de l\'enfant',
                                'Certificat de vaccination',
                                '04 photos d\'identité de l\'enfant',
                                'Les frais d\'inscription',
                            ] as $doc)
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-primary flex-shrink-0"></span>
                                {{ $doc }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Étape 2 --}}
                <div class="flex gap-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-full bg-secondary flex items-center justify-center text-dark font-display font-extrabold text-xl shadow-yellow z-10 relative">
                            2
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-8 flex-1 shadow-yellow">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="fi fi-sr-edit text-2xl text-secondary"></i>
                            <h3 class="font-display font-bold text-xl text-dark">Remplir le formulaire</h3>
                        </div>
                        <p class="font-body text-gray-600 leading-relaxed">
                            L'école vous fournira un formulaire d'inscription à remplir et à retourner avec les documents nécessaires.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12" data-aos="zoom-in" data-aos-delay="200">
            <a href="{{ route('inscription') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary text-white font-body font-bold hover:bg-purple-700 hover:scale-105 transition-all duration-300 shadow-violet">
                Plus d'information
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>

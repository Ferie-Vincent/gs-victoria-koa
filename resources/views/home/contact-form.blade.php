<section class="py-16 px-4 sm:px-6 lg:px-8" style="background-color: #F3F2FF;">

    <div class="max-w-6xl mx-auto">

        {{-- Card gradient inline (style Kidza) --}}
        <div class="relative rounded-3xl overflow-hidden"
             data-no-tilt
             style="background: linear-gradient(135deg, #7C3AED 0%, #5B1A8A 45%, #1E1B4B 100%);">

            {{-- Pattern pointillés subtil --}}
            <div aria-hidden="true" class="absolute inset-0 opacity-5"
                 style="background-image: radial-gradient(circle, white 1.5px, transparent 1.5px); background-size: 28px 28px;">
            </div>

            {{-- Effet cousu blanc --}}
            <div aria-hidden="true" class="absolute inset-4 pointer-events-none rounded-2xl"
                 style="border: 2px dashed rgba(255,255,255,0.3);"></div>

            {{-- Formes décoratives --}}
            <div aria-hidden="true" class="absolute top-0 left-1/3 w-40 h-40 rounded-full bg-white/5 -translate-y-1/2"></div>
            <div aria-hidden="true" class="absolute bottom-0 right-4 w-56 h-56 rounded-full bg-white/5 translate-y-1/3"></div>

            <form method="POST" action="{{ route('contact.send') }}" class="relative z-10">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2">

                    {{-- ── GAUCHE : Texte + bouton ── --}}
                    <div class="flex flex-col justify-center px-10 py-12 lg:px-14 lg:py-14" data-aos="fade-right">

                        @if(session('success'))
                        <div class="mb-6 p-4 bg-green-500/20 border border-green-400/30 rounded-2xl flex items-center gap-3">
                            <i class="fi fi-sr-check-circle text-xl text-green-300"></i>
                            <p class="font-body text-green-200 text-sm">{{ session('success') }}</p>
                        </div>
                        @endif

                        <h2 class="font-display font-extrabold text-white leading-tight mb-4"
                            style="font-size: clamp(1.8rem, 3.5vw, 2.75rem);">
                            Rejoignez-nous<br>et restez connectés !
                        </h2>
                        <p class="font-body text-white/65 text-base mb-10">
                            Pour toute question sur l'inscription ou la vie scolaire de votre enfant.
                        </p>

                        {{-- Bouton submit — style Kidza pill avec icône cercle --}}
                        <div>
                            <button type="submit"
                                    class="inline-flex items-center gap-3 pl-3 pr-7 py-3 rounded-full
                                           bg-secondary text-dark font-body font-bold text-base
                                           hover:bg-amber-400 hover:scale-105 transition-all duration-300 shadow-lg shadow-black/20">
                                <span class="w-9 h-9 rounded-full bg-dark/25 flex items-center justify-center flex-shrink-0">
                                    <i class="fi fi-sr-arrow-right text-white"></i>
                                </span>
                                Nous contacter
                            </button>
                        </div>

                        {{-- Adresse --}}
                        <div class="mt-10 space-y-2">
                            <p class="font-body text-white/55 text-sm flex items-start gap-2">
                                <i class="fi fi-sr-map-marker text-secondary/80 mt-0.5 flex-shrink-0"></i>
                                {{ $site['adresse'] }}
                            </p>
                        </div>
                    </div>

                    {{-- ── DROITE : Champs directement sur gradient ── --}}
                    <div class="flex flex-col justify-center px-10 py-12 lg:px-10 lg:py-14" data-aos="fade-left">

                        @if($errors->any())
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-400/30 rounded-2xl">
                            @foreach($errors->all() as $error)
                            <p class="font-body text-red-200 text-xs flex items-center gap-2 mb-1">
                                <i class="fi fi-sr-exclamation text-red-300 flex-shrink-0"></i> {{ $error }}
                            </p>
                            @endforeach
                        </div>
                        @endif

                        {{-- Ligne 3 champs --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nom complet"
                                   autocomplete="name"
                                   class="w-full px-5 py-3.5 rounded-full font-body text-sm
                                          bg-white/15 border border-white/20 text-white placeholder-white/55
                                          focus:outline-none focus:bg-white/25 focus:border-white/50 transition-all"
                                   required>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Email"
                                   autocomplete="email"
                                   class="w-full px-5 py-3.5 rounded-full font-body text-sm
                                          bg-white/15 border border-white/20 text-white placeholder-white/55
                                          focus:outline-none focus:bg-white/25 focus:border-white/50 transition-all"
                                   required>
                            <input type="tel"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+225 XX XX XX"
                                   autocomplete="tel"
                                   class="w-full px-5 py-3.5 rounded-full font-body text-sm
                                          bg-white/15 border border-white/20 text-white placeholder-white/55
                                          focus:outline-none focus:bg-white/25 focus:border-white/50 transition-all">
                        </div>

                        {{-- Textarea message --}}
                        <textarea name="message"
                                  rows="4"
                                  placeholder="Votre message..."
                                  class="w-full px-5 py-4 rounded-2xl font-body text-sm resize-none
                                         bg-white/15 border border-white/20 text-white placeholder-white/55
                                         focus:outline-none focus:bg-white/25 focus:border-white/50 transition-all">{{ old('message') }}</textarea>

                    </div>
                </div>
            </form>
        </div>

    </div>
</section>

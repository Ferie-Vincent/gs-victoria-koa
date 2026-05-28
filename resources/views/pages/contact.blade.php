@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Contactez le Groupe Scolaire VICTORIA-KOA à Angré 9ème Tranche, Abidjan. Téléphone : (+225) 07 67 48 55 94. Email : direction@gsvictoriakoa.ci. Formulaire de contact en ligne.')
@section('canonical', url('/contact'))

@section('content')

<x-page-banner
    title="Contact"
    :breadcrumb="[['label' => 'Accueil', 'route' => 'home'], ['label' => 'Contact']]"
/>

{{-- ── SECTION PRINCIPALE : Infos + Formulaire ── --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Intro --}}
        <div class="mb-12" data-aos="fade-up">
            <h2 class="font-display font-extrabold text-3xl text-dark mb-3">Contactez-nous</h2>
            <p class="font-body text-gray-500 max-w-xl">
                Vous avez une question sur les inscriptions, les horaires ou la vie scolaire ?
                Notre équipe est disponible pour vous accompagner.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">

            {{-- ── GAUCHE : Blocs info + CTA card ── --}}
            <div class="lg:col-span-2 space-y-6" data-aos="fade-right">

                {{-- Adresse --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-map-marker text-primary text-lg"></i>
                    </div>
                    <div>
                        <p class="font-body font-bold text-dark text-sm mb-1">Adresse</p>
                        <p class="font-body text-gray-600 text-sm leading-relaxed">
                            {{ $site['adresse'] }}
                        </p>
                        <p class="font-body text-gray-400 text-xs mt-1">GPS : {{ $site['gps'] }}</p>
                    </div>
                </div>

                <div class="h-px bg-gray-100"></div>

                {{-- Téléphone --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-phone-call text-amber-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="font-body font-bold text-dark text-sm mb-1">Téléphone</p>
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_1']) }}"
                           class="font-body text-gray-600 text-sm hover:text-primary transition-colors block">
                            {{ $site['telephone_1'] }}
                        </a>
                        @if($site['telephone_2'])
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_2']) }}"
                           class="font-body text-gray-600 text-sm hover:text-primary transition-colors">
                            {{ $site['telephone_2'] }}
                        </a>
                        @endif
                    </div>
                </div>

                <div class="h-px bg-gray-100"></div>

                {{-- Email --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-envelope text-teal-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="font-body font-bold text-dark text-sm mb-1">Courrier électronique</p>
                        <a href="mailto:{{ $site['email_direction'] }}"
                           class="font-body text-gray-600 text-sm hover:text-primary transition-colors block">
                            {{ $site['email_direction'] }}
                        </a>
                        @if($site['email_secondaire'])
                        <a href="mailto:{{ $site['email_secondaire'] }}"
                           class="font-body text-gray-600 text-sm hover:text-primary transition-colors">
                            {{ $site['email_secondaire'] }}
                        </a>
                        @endif
                        <p class="font-body text-gray-400 text-xs mt-1">Réponse sous 48h ouvrables</p>
                    </div>
                </div>

                <div class="h-px bg-gray-100"></div>

                {{-- CTA Card (style CEDEAO) --}}
                <div class="relative rounded-3xl p-7 overflow-hidden"
                     data-no-tilt
                     style="background: linear-gradient(135deg, #7C3AED 0%, #5B1A8A 100%);">
                    <div class="absolute inset-3 pointer-events-none rounded-2xl"
                         style="border: 2px dashed rgba(255,255,255,0.25);"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center mb-4">
                            <i class="fi fi-sr-comments text-white text-xl"></i>
                        </div>
                        <h3 class="font-display font-bold text-white text-lg mb-2">
                            Besoin de parler à l'école directement ?
                        </h3>
                        <p class="font-body text-white/70 text-sm leading-relaxed mb-4">
                            Notre équipe d'accueil vous orientera vers le bon interlocuteur pour traiter votre demande.
                        </p>
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_1']) }}"
                           class="inline-flex items-center gap-2 bg-secondary text-dark font-body font-bold text-sm
                                  px-5 py-2.5 rounded-full hover:bg-amber-400 transition-colors">
                            <i class="fi fi-sr-phone-call"></i>
                            Appeler maintenant
                        </a>
                    </div>
                </div>

            </div>

            {{-- ── DROITE : Formulaire ── --}}
            <div class="lg:col-span-3 bg-gray-50 rounded-3xl p-8 relative overflow-hidden" data-aos="fade-left" data-no-tilt>

                {{-- Effet cousu --}}
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed #7C3AED20;"></div>

                <div class="relative z-10">
                    <h3 class="font-display font-bold text-xl text-dark mb-1">Envoyez-nous un message</h3>
                    <p class="font-body text-gray-500 text-sm mb-6">Tous les champs marqués * sont obligatoires.</p>

                    @if(session('success'))
                    <div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-3">
                        <i class="fi fi-sr-check-circle text-green-500 text-xl flex-shrink-0"></i>
                        <p class="font-body text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-center gap-3">
                        <i class="fi fi-sr-exclamation text-red-500 text-xl flex-shrink-0"></i>
                        <p class="font-body text-red-700 text-sm">{{ session('error') }}</p>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                        @csrf

                        {{-- Ligne Nom + Email --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="font-body font-semibold text-dark text-sm block mb-1.5">
                                    Nom complet <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}" autocomplete="name"
                                       placeholder="Ex : Koné Adjoua"
                                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-body text-sm text-dark
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                              @error('name') border-red-400 @enderror">
                                @error('name')<p class="text-red-500 text-xs mt-1 font-body">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="font-body font-semibold text-dark text-sm block mb-1.5">
                                    Email <span class="text-red-400">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}" autocomplete="email"
                                       placeholder="votre@email.com"
                                       class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-body text-sm text-dark
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                              @error('email') border-red-400 @enderror">
                                @error('email')<p class="text-red-500 text-xs mt-1 font-body">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        {{-- Téléphone --}}
                        <div>
                            <label class="font-body font-semibold text-dark text-sm block mb-1.5">
                                Téléphone <span class="text-gray-400 font-normal text-xs">(optionnel)</span>
                            </label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                                   placeholder="+225 XX XX XX XX"
                                   class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-body text-sm text-dark
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                        </div>

                        {{-- Sujet --}}
                        <div>
                            <label class="font-body font-semibold text-dark text-sm block mb-1.5">
                                Sujet <span class="text-red-400">*</span>
                            </label>
                            <select name="sujet" required
                                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-body text-sm text-dark
                                           focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                           @error('sujet') border-red-400 @enderror">
                                <option value="">— Choisissez un sujet —</option>
                                @foreach(['Inscription 2025-2026', 'Renseignements sur les classes', 'Frais de scolarité', 'Fournitures scolaires', 'Partenariat', 'Autre'] as $s)
                                <option value="{{ $s }}" {{ old('sujet') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            @error('sujet')<p class="text-red-500 text-xs mt-1 font-body">{{ $message }}</p>@enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="font-body font-semibold text-dark text-sm block mb-1.5">
                                Message <span class="text-red-400">*</span>
                            </label>
                            <textarea name="message" rows="5"
                                      placeholder="Comment pouvons-nous vous aider ?"
                                      class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-body text-sm text-dark resize-none
                                             focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all
                                             @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-500 text-xs mt-1 font-body">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit"
                                class="w-full flex items-center justify-center gap-3 px-8 py-4 rounded-2xl
                                       bg-primary text-white font-body font-bold text-base
                                       hover:bg-purple-700 transition-colors duration-300
                                       shadow-lg shadow-purple-200/60">
                            Envoyer le message
                            <i class="fi fi-sr-arrow-right text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ── CARTE GOOGLE MAPS pleine largeur ── --}}
<section class="bg-white pb-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4" data-aos="fade-up">
            <h3 class="font-display font-bold text-xl text-dark flex items-center gap-2">
                <i class="fi fi-sr-map-marker text-primary"></i>
                Notre Localisation
            </h3>
            <a href="https://maps.google.com/maps?q=92HH%2BH98,+Voie+Djibi,+Abidjan"
               target="_blank" rel="noopener"
               class="font-body text-sm text-primary hover:underline flex items-center gap-1">
                Ouvrir dans Google Maps
                <i class="fi fi-rr-arrow-up-right-from-square text-xs"></i>
            </a>
        </div>
        <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100" data-aos="fade-up" data-aos-delay="100" data-no-tilt>
            <iframe
                src="https://maps.google.com/maps?q=92HH%2BH98,+Voie+Djibi,+Abidjan&output=embed"
                width="100%" height="400" style="border:0;" allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Localisation GS Victoria-Koa">
            </iframe>
        </div>
    </div>
</section>

@endsection

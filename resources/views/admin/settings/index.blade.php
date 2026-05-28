@extends('layouts.admin')
@section('title', 'Paramètres')
@section('page-title', 'Paramètres de l\'école')

@section('content')
@php use App\Models\Setting; @endphp

<form method="POST" action="{{ route('admin.settings.update') }}" id="settings-form">
@csrf

@php
$allSettings = $settings->flatten()->keyBy('cle');
$val = fn($key, $default = '') => old("settings.$key", $allSettings[$key]->valeur ?? $default);
@endphp

<div class="flex gap-8 items-start">

    {{-- ── Nav latérale sticky ─────────────────────────────────────────── --}}
    <aside class="hidden xl:flex flex-col gap-1 w-52 flex-shrink-0 sticky top-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest px-3 mb-2">Sections</p>

        @php
        $sections = [
            ['id' => 'contact',      'icon' => 'fi-sr-phone-call', 'label' => 'Contact',      'bg' => 'bg-violet-100', 'text' => 'text-violet-600'],
            ['id' => 'localisation', 'icon' => 'fi-sr-map-marker', 'label' => 'Localisation', 'bg' => 'bg-teal-100',   'text' => 'text-teal-600'],
            ['id' => 'ecole',        'icon' => 'fi-sr-school',     'label' => 'École',        'bg' => 'bg-amber-100',  'text' => 'text-amber-600'],
            ['id' => 'horaires',     'icon' => 'fi-sr-clock',      'label' => 'Horaires',     'bg' => 'bg-pink-100',   'text' => 'text-pink-600'],
        ];
        @endphp

        @foreach($sections as $sec)
        <a href="#{{ $sec['id'] }}"
           class="group flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-100 transition-all text-sm font-medium text-gray-500 hover:text-gray-800"
           onclick="scrollToSection('{{ $sec['id'] }}')">
            <span class="w-7 h-7 rounded-lg {{ $sec['bg'] }} flex items-center justify-center flex-shrink-0">
                <i class="fi {{ $sec['icon'] }} text-sm {{ $sec['text'] }}"></i>
            </span>
            {{ $sec['label'] }}
        </a>
        @endforeach

        <div class="border-t border-gray-200 my-3"></div>

        <button type="submit"
                data-tooltip="Sauvegarder tous les paramètres"
                class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200">
            <i class="fi fi-sr-disk text-sm"></i>
            Enregistrer
        </button>
    </aside>

    {{-- ── Contenu principal ────────────────────────────────────────────── --}}
    <div class="flex-1 space-y-6 min-w-0">

        {{-- Bannière année scolaire --}}
        <div class="relative overflow-hidden rounded-2xl p-6"
             style="background: linear-gradient(135deg, #1E1B4B 0%, #312E81 60%, #4C1D95 100%);">
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 24px 24px;"></div>
            <div class="absolute -right-12 -top-12 w-48 h-48 rounded-full opacity-20"
                 style="background: radial-gradient(circle, #A78BFA, transparent 70%);"></div>
            <div class="relative z-10 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center">
                        <i class="fi fi-sr-calendar text-2xl text-amber-400"></i>
                    </div>
                    <div>
                        <p class="text-white/60 text-xs font-semibold uppercase tracking-widest">Année scolaire en cours</p>
                        <p class="text-white font-bold text-3xl leading-tight mt-0.5">{{ Setting::schoolYear() }}</p>
                    </div>
                </div>
                <div class="bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-xs text-white/70 leading-relaxed max-w-xs">
                    <span class="text-white font-semibold block mb-1">⚡ Calculée automatiquement</span>
                    Basée sur la date de rentrée configurée ci-dessous.<br>
                    Change chaque année sans intervention.
                </div>
            </div>
        </div>

        {{-- ══ CONTACT ════════════════════════════════════════════════════ --}}
        <div id="contact" class="scroll-mt-6">
            @include('admin.settings._section-header', ['icon' => 'fi-sr-phone-call', 'bg' => 'bg-violet-100', 'color' => 'text-violet-600', 'title' => 'Informations de contact', 'sub' => 'Téléphones, emails et réseaux sociaux'])

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm divide-y divide-gray-100">

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Téléphone principal</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-violet-400 focus-within:ring-2 focus-within:ring-violet-100 transition-all">
                        <i class="fi fi-sr-phone-call text-violet-400 text-sm flex-shrink-0"></i>
                        <input type="text" name="settings[telephone_1]" value="{{ $val('telephone_1') }}"
                               placeholder="(+225) 07 67 48 55 94"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Téléphone secondaire</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-violet-400 focus-within:ring-2 focus-within:ring-violet-100 transition-all">
                        <i class="fi fi-sr-mobile text-gray-400 text-sm flex-shrink-0"></i>
                        <input type="text" name="settings[telephone_2]" value="{{ $val('telephone_2') }}"
                               placeholder="(+225) 01 43 23 84 82"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Email direction</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-violet-400 focus-within:ring-2 focus-within:ring-violet-100 transition-all">
                        <i class="fi fi-sr-envelope text-blue-400 text-sm flex-shrink-0"></i>
                        <input type="email" name="settings[email_direction]" value="{{ $val('email_direction') }}"
                               placeholder="direction@gsvictoriakoa.ci"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Email secondaire</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-violet-400 focus-within:ring-2 focus-within:ring-violet-100 transition-all">
                        <i class="fi fi-sr-at text-gray-400 text-sm flex-shrink-0"></i>
                        <input type="email" name="settings[email_secondaire]" value="{{ $val('email_secondaire') }}"
                               placeholder="victoria-koa1965@gmail.com"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">URL Facebook</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-violet-400 focus-within:ring-2 focus-within:ring-violet-100 transition-all">
                        <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        <input type="url" name="settings[facebook_url]" value="{{ $val('facebook_url') }}"
                               placeholder="https://facebook.com/CM.VICTORIA.KOA/"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

            </div>
        </div>

        {{-- ══ LOCALISATION ════════════════════════════════════════════════ --}}
        <div id="localisation" class="scroll-mt-6">
            @include('admin.settings._section-header', ['icon' => 'fi-sr-map-marker', 'bg' => 'bg-teal-100', 'color' => 'text-teal-600', 'title' => 'Localisation', 'sub' => 'Adresse et coordonnées GPS'])

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm divide-y divide-gray-100">

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Adresse complète</label>
                    <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-teal-400 focus-within:ring-2 focus-within:ring-teal-100 transition-all">
                        <i class="fi fi-sr-home text-teal-400 text-sm flex-shrink-0 mt-0.5"></i>
                        <textarea name="settings[adresse]" rows="2"
                                  placeholder="Angré 9ème Tranche CNPS en haut, face Pâtisserie MARY'S, Abidjan"
                                  class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300 resize-none">{{ $val('adresse') }}</textarea>
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Code Google Maps / GPS</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-teal-400 focus-within:ring-2 focus-within:ring-teal-100 transition-all">
                        <i class="fi fi-sr-map-marker text-teal-400 text-sm flex-shrink-0"></i>
                        <input type="text" name="settings[gps]" value="{{ $val('gps') }}"
                               placeholder="92HH+H98, Voie Djibi, Abidjan"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                    <p class="text-xs text-gray-400 mt-2 ml-1">Code Plus Code Google Maps ou coordonnées GPS (latitude, longitude).</p>
                </div>

            </div>
        </div>

        {{-- ══ ÉCOLE ════════════════════════════════════════════════════════ --}}
        <div id="ecole" class="scroll-mt-6">
            @include('admin.settings._section-header', ['icon' => 'fi-sr-school', 'bg' => 'bg-amber-100', 'color' => 'text-amber-600', 'title' => 'École', 'sub' => 'Année scolaire et inscriptions'])

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm divide-y divide-gray-100">

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                        Date de rentrée <span class="text-amber-500 normal-case font-normal tracking-normal">(MM-JJ)</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-amber-400 focus-within:ring-2 focus-within:ring-amber-100 transition-all w-36">
                            <i class="fi fi-sr-calendar text-amber-400 text-sm flex-shrink-0"></i>
                            <input type="text" name="settings[rentree_date]" value="{{ $val('rentree_date', '09-01') }}"
                                   placeholder="09-01" maxlength="5"
                                   class="w-16 text-sm text-gray-800 font-mono font-bold bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300 tracking-widest">
                        </div>
                        <span class="text-sm text-gray-500">
                            → <strong class="text-amber-600 font-semibold">{{ Setting::schoolYear() }}</strong>
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">
                        Format <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 font-mono">MM-JJ</code>
                        — ex : <code class="bg-gray-100 px-1.5 py-0.5 rounded text-gray-600 font-mono">09-01</code> = 1er septembre
                    </p>
                </div>

                <div class="px-5 py-4"
                     x-data="{ open: {{ $val('inscription_ouverte', '0') === '1' ? 'true' : 'false' }} }">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Inscriptions ouvertes</label>
                    <div class="flex items-center gap-4">
                        <button type="button" @click="open = !open"
                                :class="open ? 'bg-emerald-500' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none flex-shrink-0">
                            <span :class="open ? 'translate-x-6' : 'translate-x-1'"
                                  class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform duration-200"></span>
                        </button>
                        <input type="hidden" name="settings[inscription_ouverte]" :value="open ? '1' : '0'">
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold" :class="open ? 'text-emerald-700' : 'text-gray-400'">
                                <span x-show="open">✅ Ouvertes — affichage bandeau vert</span>
                                <span x-show="!open">🔒 Fermées — affichage bandeau amber</span>
                            </span>
                            <span class="text-xs text-gray-400 mt-0.5">Contrôle le bandeau sur la page Inscription et le dashboard</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ══ HORAIRES ════════════════════════════════════════════════════ --}}
        <div id="horaires" class="scroll-mt-6">
            @include('admin.settings._section-header', ['icon' => 'fi-sr-clock', 'bg' => 'bg-pink-100', 'color' => 'text-pink-600', 'title' => 'Horaires', 'sub' => 'Heures d\'ouverture et jours de classe'])

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm divide-y divide-gray-100">

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Jours de cours</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-pink-400 focus-within:ring-2 focus-within:ring-pink-100 transition-all">
                        <i class="fi fi-sr-calendar-days text-pink-400 text-sm flex-shrink-0"></i>
                        <input type="text" name="settings[horaire_jours]" value="{{ $val('horaire_jours') }}"
                               placeholder="Lundi · Mardi · Jeudi · Vendredi"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

                {{-- Horaires matin --}}
                <div class="px-5 py-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Horaires matin</p>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['key' => 'horaire_accueil',    'label' => 'Accueil dès',  'icon' => 'fi-sr-door-open', 'color' => 'text-pink-400',   'ph' => '7h30'],
                            ['key' => 'horaire_matin_debut','label' => 'Début cours',  'icon' => 'fi-sr-play',      'color' => 'text-green-500',  'ph' => '7h45'],
                            ['key' => 'horaire_matin_fin',  'label' => 'Fin matin',    'icon' => 'fi-sr-stop',      'color' => 'text-orange-400', 'ph' => '11h45'],
                        ] as $h)
                        <div>
                            <label class="block text-xs text-gray-500 mb-1.5">{{ $h['label'] }}</label>
                            <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 focus-within:border-pink-400 focus-within:ring-2 focus-within:ring-pink-100 transition-all">
                                <i class="fi {{ $h['icon'] }} {{ $h['color'] }} text-sm flex-shrink-0"></i>
                                <input type="text" name="settings[{{ $h['key'] }}]" value="{{ $val($h['key']) }}"
                                       placeholder="{{ $h['ph'] }}"
                                       class="w-full text-sm text-gray-800 font-mono font-bold bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Horaires après-midi --}}
                <div class="px-5 py-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Horaires après-midi</p>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach([
                            ['key' => 'horaire_apm_debut', 'label' => 'Début après-midi', 'icon' => 'fi-sr-play', 'color' => 'text-blue-400',  'ph' => '13h45'],
                            ['key' => 'horaire_apm_fin',   'label' => 'Fin après-midi',   'icon' => 'fi-sr-stop', 'color' => 'text-red-400',   'ph' => '15h45'],
                        ] as $h)
                        <div>
                            <label class="block text-xs text-gray-500 mb-1.5">{{ $h['label'] }}</label>
                            <div class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-3 py-2.5 focus-within:border-pink-400 focus-within:ring-2 focus-within:ring-pink-100 transition-all">
                                <i class="fi {{ $h['icon'] }} {{ $h['color'] }} text-sm flex-shrink-0"></i>
                                <input type="text" name="settings[{{ $h['key'] }}]" value="{{ $val($h['key']) }}"
                                       placeholder="{{ $h['ph'] }}"
                                       class="w-full text-sm text-gray-800 font-mono font-bold bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="px-5 py-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Jours sans cours</label>
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus-within:border-pink-400 focus-within:ring-2 focus-within:ring-pink-100 transition-all">
                        <i class="fi fi-sr-calendar-xmark text-gray-400 text-sm flex-shrink-0"></i>
                        <input type="text" name="settings[horaire_jours_fermes]" value="{{ $val('horaire_jours_fermes') }}"
                               placeholder="Mercredi · Samedi · Dimanche"
                               class="flex-1 text-sm text-gray-800 font-medium bg-transparent border-0 outline-none focus:ring-0 placeholder-gray-300">
                    </div>
                </div>

            </div>
        </div>

        {{-- Barre de sauvegarde --}}
        <div class="flex items-center justify-between bg-white rounded-2xl border border-gray-200 shadow-sm px-6 py-4">
            <div class="flex items-center gap-2 text-gray-400 text-xs">
                <i class="fi fi-sr-info text-sm"></i>
                Modifications appliquées immédiatement sur le site public
            </div>
            <button type="submit"
                    class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-7 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200/60">
                <i class="fi fi-sr-disk text-sm"></i>
                Enregistrer les paramètres
            </button>
        </div>

    </div>
</div>
</form>

<script>
function scrollToSection(id) {
    const el = document.getElementById(id);
    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        document.querySelectorAll('aside a[onclick]').forEach(a => {
            a.classList.toggle('bg-gray-100', false);
            a.classList.toggle('text-gray-800', false);
            a.classList.toggle('font-semibold', false);
        });
        event.currentTarget.classList.add('bg-gray-100', 'text-gray-800', 'font-semibold');
    }
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const id = entry.target.id;
            document.querySelectorAll('aside a[onclick]').forEach(a => {
                const active = a.getAttribute('onclick')?.includes(id);
                a.classList.toggle('bg-gray-100', active);
                a.classList.toggle('text-gray-800', active);
                a.classList.toggle('font-semibold', active);
            });
        }
    });
}, { threshold: 0.4 });

['contact', 'localisation', 'ecole', 'horaires'].forEach(id => {
    const el = document.getElementById(id);
    if (el) observer.observe(el);
});
</script>
@endsection

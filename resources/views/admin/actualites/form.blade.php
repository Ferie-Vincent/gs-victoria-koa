@extends('layouts.admin')
@section('title', $actualite->exists ? 'Modifier l\'actualité' : 'Nouvelle actualité')
@section('page-title', $actualite->exists ? 'Modifier l\'actualité' : 'Nouvelle actualité')

@section('content')
@php $isEdit = $actualite->exists; @endphp

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── Formulaire principal (2/3) ─────────────────────────────────── --}}
    <div class="xl:col-span-2">
        <form method="POST"
              action="{{ $isEdit ? route('admin.actualites.update', $actualite) : route('admin.actualites.store') }}"
              id="main-form">
            @csrf
            @if($isEdit) @method('PUT') @endif

            {{-- Titre --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                    Titre de l'article <span class="text-red-400 normal-case font-normal tracking-normal">*</span>
                </label>
                <input type="text" name="titre" value="{{ old('titre', $actualite->titre) }}" required
                       placeholder="Ex: Journée sportive annuelle 2026"
                       class="w-full text-xl font-bold text-gray-800 placeholder-gray-200 border-0 outline-none focus:ring-0 bg-transparent">
                @error('titre')
                <p class="text-red-500 text-xs mt-2 flex items-center gap-1">
                    <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Extrait --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                    Extrait <span class="text-red-400 normal-case font-normal tracking-normal">*</span>
                    <span class="text-gray-300 font-normal tracking-normal normal-case ml-1">(max 500 caractères)</span>
                </label>
                <textarea name="extrait" rows="3" required maxlength="500"
                          placeholder="Résumé court affiché dans les listes d'articles..."
                          class="w-full text-sm text-gray-700 placeholder-gray-200 border-0 outline-none focus:ring-0 bg-transparent resize-none leading-relaxed">{{ old('extrait', $actualite->extrait) }}</textarea>
                @error('extrait')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Contenu complet --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                    Contenu complet
                    <span class="text-gray-300 font-normal tracking-normal normal-case ml-1">(optionnel)</span>
                </label>
                <textarea name="contenu" rows="8"
                          placeholder="Contenu détaillé de l'article..."
                          class="w-full text-sm text-gray-700 placeholder-gray-200 border-0 outline-none focus:ring-0 bg-transparent resize-y leading-relaxed">{{ old('contenu', $actualite->contenu) }}</textarea>
            </div>

            {{-- Image --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                    Image de couverture
                </label>
                <div class="flex items-start gap-4">
                    {{-- Preview --}}
                    <div class="w-20 h-20 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center flex-shrink-0 overflow-hidden bg-gray-50">
                        <img id="preview-img"
                             src="{{ old('image', $actualite->image) ?: '' }}"
                             alt="Aperçu"
                             class="w-full h-full object-cover object-top {{ old('image', $actualite->image) ? '' : 'hidden' }}">
                        <i id="preview-placeholder" class="fi fi-sr-picture text-gray-300 text-xl {{ old('image', $actualite->image) ? 'hidden' : '' }}"></i>
                    </div>
                    <div class="flex-1">
                        <input type="text" name="image" id="image-input"
                               value="{{ old('image', $actualite->image) }}"
                               placeholder="/images/gallery/nom-fichier.jpg"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                        <p class="text-xs text-gray-400 mt-2">
                            Chemin relatif depuis <code class="bg-gray-100 px-1.5 py-0.5 rounded font-mono text-gray-600">public/</code>
                        </p>
                    </div>
                </div>
            </div>

        </form>
    </div>

    {{-- ── Panneau latéral (1/3) ───────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Publication --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-settings text-gray-400"></i>
                Publication
            </h3>

            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Date</label>
                <input type="date" name="date_publication" form="main-form"
                       value="{{ old('date_publication', $actualite->date_publication?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"
                       required
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300">
            </div>

            {{-- Toggle publié --}}
            <label class="flex items-center justify-between cursor-pointer py-3 border-t border-gray-50">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Visible sur le site</p>
                    <p class="text-xs text-gray-400 mt-0.5">Publié pour les visiteurs</p>
                </div>
                <div class="relative flex-shrink-0">
                    <input type="checkbox" name="publie" form="main-form" value="1"
                           id="toggle-publie"
                           {{ old('publie', $actualite->publie ?? true) ? 'checked' : '' }}
                           class="sr-only">
                    <button type="button"
                            onclick="document.getElementById('toggle-publie').click(); this.setAttribute('data-on', document.getElementById('toggle-publie').checked ? '1' : '0')"
                            data-on="{{ old('publie', $actualite->publie ?? true) ? '1' : '0' }}"
                            class="w-11 h-6 rounded-full transition-colors duration-200 flex items-center px-0.5
                                   [&[data-on='1']]:bg-violet-600 [&[data-on='0']]:bg-gray-200">
                        <span class="w-5 h-5 bg-white rounded-full shadow-sm transition-transform duration-200
                                     block [&[data-on='1']]:translate-x-5"
                              id="toggle-knob"></span>
                    </button>
                </div>
            </label>

            <div class="flex flex-col gap-2 mt-4 pt-4 border-t border-gray-50">
                <button type="submit" form="main-form"
                        class="w-full flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700
                               text-white font-semibold py-2.5 rounded-xl text-sm transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                    <i class="fi fi-sr-disk text-sm"></i>
                    {{ $isEdit ? 'Enregistrer' : 'Publier' }}
                </button>
                <a href="{{ route('admin.actualites.index') }}"
                   class="w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200
                          text-gray-600 font-medium py-2.5 rounded-xl text-sm transition-colors">
                    Annuler
                </a>
            </div>
        </div>

        {{-- Catégorie & Badge --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-tag text-gray-400"></i>
                Catégorie & Badge
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Catégorie</label>
                    <select name="categorie" form="main-form" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300">
                        @foreach(['Sport', 'Événement', 'Animation', 'Créatif', 'Pédagogie', 'Santé'] as $cat)
                        <option value="{{ $cat }}" {{ old('categorie', $actualite->categorie) === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Couleur badge</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach([
                            'bg-violet-600' => 'Violet',
                            'bg-orange-500' => 'Orange',
                            'bg-teal-600'   => 'Vert',
                            'bg-pink-500'   => 'Rose',
                            'bg-blue-600'   => 'Bleu',
                            'bg-amber-500'  => 'Jaune',
                        ] as $cls => $label)
                        <label class="cursor-pointer">
                            <input type="radio" name="badge_bg" form="main-form" value="{{ $cls }}"
                                   {{ old('badge_bg', $actualite->badge_bg ?? 'bg-violet-600') === $cls ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="flex flex-col items-center gap-1.5 p-2 rounded-xl border-2 border-transparent
                                        peer-checked:border-gray-400 hover:border-gray-200 transition-all cursor-pointer">
                                <div class="w-7 h-7 rounded-full {{ $cls }} shadow-sm"></div>
                                <span class="text-[10px] text-gray-500 font-medium">{{ $label }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
// Preview image en temps réel — DOM safe (pas d'innerHTML)
(function() {
    const input = document.getElementById('image-input');
    const img   = document.getElementById('preview-img');
    const ph    = document.getElementById('preview-placeholder');
    if (!input || !img) return;

    input.addEventListener('input', function() {
        const val = this.value.trim();
        if (val) {
            img.src = val;          // attribut src = sûr (pas d'exécution JS)
            img.classList.remove('hidden');
            if (ph) ph.classList.add('hidden');
        } else {
            img.classList.add('hidden');
            if (ph) ph.classList.remove('hidden');
        }
    });

    // Toggle sync
    const toggle = document.getElementById('toggle-publie');
    const btn    = toggle?.nextElementSibling;
    const knob   = document.getElementById('toggle-knob');
    if (toggle && btn && knob) {
        toggle.addEventListener('change', function() {
            btn.setAttribute('data-on', this.checked ? '1' : '0');
            knob.setAttribute('data-on', this.checked ? '1' : '0');
        });
    }
})();
</script>
@endsection

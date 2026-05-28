@extends('layouts.admin')
@section('title', $temoignage->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')
@section('page-title', $temoignage->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')

@section('content')
@php $isEdit = $temoignage->exists; @endphp

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── Formulaire principal (2/3) ─────────────────────────────────── --}}
    <div class="xl:col-span-2 space-y-4">
        <form method="POST"
              action="{{ $isEdit ? route('admin.temoignages.update', $temoignage) : route('admin.temoignages.store') }}"
              id="main-form">
            @csrf
            @if($isEdit) @method('PUT') @endif

            {{-- Identité --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">
                    Identité du parent
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">
                            Nom complet <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="nom_parent"
                               value="{{ old('nom_parent', $temoignage->nom_parent) }}" required
                               placeholder="Ex: Mme Koné Adjoua"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all">
                        @error('nom_parent')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">
                            Initiales <span class="text-red-400">*</span>
                            <span class="text-gray-300 ml-1 font-normal">(2-5 car.)</span>
                        </label>
                        <input type="text" name="initiales"
                               value="{{ old('initiales', $temoignage->initiales) }}" required maxlength="5"
                               placeholder="KA"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all">
                        @error('initiales')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">
                        Rôle / Description <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="role_parent"
                           value="{{ old('role_parent', $temoignage->role_parent) }}" required
                           placeholder="Ex: Maman d'Ange, CP1"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all">
                    @error('role_parent')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- Témoignage --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                    Témoignage <span class="text-red-400 normal-case font-normal tracking-normal">*</span>
                </label>
                <textarea name="texte" rows="6" required
                          placeholder="Le témoignage du parent sur l'école..."
                          class="w-full text-sm text-gray-700 placeholder-gray-200 border-0 outline-none focus:ring-0 bg-transparent resize-y leading-relaxed">{{ old('texte', $temoignage->texte) }}</textarea>
                @error('texte')
                <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                    <i class="fi fi-sr-exclamation text-xs"></i> {{ $message }}
                </p>
                @enderror
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

            {{-- Toggle publié --}}
            <label class="flex items-center justify-between cursor-pointer py-3 border-b border-gray-50 mb-4">
                <div>
                    <p class="text-sm font-semibold text-gray-700">Visible sur le site</p>
                    <p class="text-xs text-gray-400 mt-0.5">Affiché dans les témoignages</p>
                </div>
                <div class="relative flex-shrink-0">
                    <input type="checkbox" name="publie" form="main-form" value="1"
                           id="toggle-publie"
                           {{ old('publie', $temoignage->publie ?? true) ? 'checked' : '' }}
                           class="sr-only">
                    <button type="button"
                            onclick="document.getElementById('toggle-publie').click(); this.setAttribute('data-on', document.getElementById('toggle-publie').checked ? '1' : '0')"
                            data-on="{{ old('publie', $temoignage->publie ?? true) ? '1' : '0' }}"
                            class="w-11 h-6 rounded-full transition-colors duration-200 flex items-center px-0.5
                                   [&[data-on='1']]:bg-teal-600 [&[data-on='0']]:bg-gray-200">
                        <span class="w-5 h-5 bg-white rounded-full shadow-sm transition-transform duration-200
                                     block [&[data-on='1']]:translate-x-5"
                              id="toggle-knob"></span>
                    </button>
                </div>
            </label>

            <div class="flex flex-col gap-2">
                <button type="submit" form="main-form"
                        class="w-full flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700
                               text-white font-semibold py-2.5 rounded-xl text-sm transition-all hover:scale-[1.01] shadow-md shadow-teal-200/60">
                    <i class="fi fi-sr-disk text-sm"></i>
                    {{ $isEdit ? 'Enregistrer' : 'Créer' }}
                </button>
                <a href="{{ route('admin.temoignages.index') }}"
                   class="w-full flex items-center justify-center bg-gray-100 hover:bg-gray-200
                          text-gray-600 font-medium py-2.5 rounded-xl text-sm transition-colors">
                    Annuler
                </a>
            </div>
        </div>

        {{-- Note (étoiles) --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-star text-amber-400"></i>
                Note
            </h3>

            {{-- Star rating — CSS trick: reverse order + sibling hover --}}
            <div class="flex flex-row-reverse justify-end gap-1" id="star-rating">
                @for($i = 5; $i >= 1; $i--)
                <label class="cursor-pointer star-label" data-val="{{ $i }}">
                    <input type="radio" name="note" form="main-form" value="{{ $i }}"
                           {{ old('note', $temoignage->note ?? 5) == $i ? 'checked' : '' }}
                           class="sr-only">
                    <i class="fi fi-sr-star text-2xl transition-colors duration-100
                               {{ old('note', $temoignage->note ?? 5) >= $i ? 'text-amber-400' : 'text-gray-200' }}"
                       id="star-icon-{{ $i }}"></i>
                </label>
                @endfor
            </div>
            <p class="text-xs text-gray-400 mt-3" id="star-label-text">
                @php $currentNote = old('note', $temoignage->note ?? 5); @endphp
                @if($currentNote == 5) Excellent @elseif($currentNote == 4) Très bien @elseif($currentNote == 3) Bien @elseif($currentNote == 2) Passable @else Insuffisant @endif
            </p>
        </div>

        {{-- Couleur avatar --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-palette text-gray-400"></i>
                Couleur avatar
            </h3>

            {{-- Aperçu live --}}
            <div class="flex items-center gap-3 mb-4">
                <div id="avatar-preview"
                     class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-sm font-bold shadow-sm {{ old('bg_color', $temoignage->bg_color ?? 'bg-teal-500') }}">
                    <span id="avatar-initiales-preview">{{ old('initiales', $temoignage->initiales ?? '?') }}</span>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-700" id="avatar-nom-preview">{{ old('nom_parent', $temoignage->nom_parent ?? 'Prénom Nom') }}</p>
                    <p class="text-xs text-gray-400" id="avatar-role-preview">{{ old('role_parent', $temoignage->role_parent ?? 'Rôle') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2">
                @foreach([
                    'bg-teal-500'    => 'Vert',
                    'bg-violet-600'  => 'Violet',
                    'bg-amber-500'   => 'Jaune',
                    'bg-pink-500'    => 'Rose',
                    'bg-blue-600'    => 'Bleu',
                    'bg-orange-500'  => 'Orange',
                ] as $cls => $label)
                <label class="cursor-pointer">
                    <input type="radio" name="bg_color" form="main-form" value="{{ $cls }}"
                           {{ old('bg_color', $temoignage->bg_color ?? 'bg-teal-500') === $cls ? 'checked' : '' }}
                           class="sr-only peer color-radio"
                           data-color="{{ $cls }}">
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

<script>
(function() {
    // ── Toggle sync ──────────────────────────────────────────────────────
    const toggle = document.getElementById('toggle-publie');
    const btn    = toggle?.nextElementSibling;
    const knob   = document.getElementById('toggle-knob');
    if (toggle && btn && knob) {
        toggle.addEventListener('change', function() {
            btn.setAttribute('data-on', this.checked ? '1' : '0');
            knob.setAttribute('data-on', this.checked ? '1' : '0');
        });
    }

    // ── Avatar live preview ──────────────────────────────────────────────
    const nomInput      = document.querySelector('[name="nom_parent"]');
    const initialesInput= document.querySelector('[name="initiales"]');
    const roleInput     = document.querySelector('[name="role_parent"]');
    const avatarDiv     = document.getElementById('avatar-preview');
    const avatarInit    = document.getElementById('avatar-initiales-preview');
    const avatarNom     = document.getElementById('avatar-nom-preview');
    const avatarRole    = document.getElementById('avatar-role-preview');

    if (nomInput && avatarNom) {
        nomInput.addEventListener('input', () => { avatarNom.textContent = nomInput.value || 'Prénom Nom'; });
    }
    if (initialesInput && avatarInit) {
        initialesInput.addEventListener('input', () => { avatarInit.textContent = initialesInput.value || '?'; });
    }
    if (roleInput && avatarRole) {
        roleInput.addEventListener('input', () => { avatarRole.textContent = roleInput.value || 'Rôle'; });
    }

    // Color picker → update avatar
    document.querySelectorAll('.color-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            if (!avatarDiv) return;
            // Remove all bg-* classes safely
            const bgClasses = [...avatarDiv.classList].filter(c => c.startsWith('bg-'));
            bgClasses.forEach(c => avatarDiv.classList.remove(c));
            this.dataset.color.split(' ').forEach(c => avatarDiv.classList.add(c));
        });
    });

    // ── Star rating interactive ──────────────────────────────────────────
    const labels   = ['', 'Insuffisant', 'Passable', 'Bien', 'Très bien', 'Excellent'];
    const starIcons = {};
    for (let i = 1; i <= 5; i++) { starIcons[i] = document.getElementById('star-icon-' + i); }
    const labelText = document.getElementById('star-label-text');

    document.querySelectorAll('.star-label').forEach(label => {
        const radio = label.querySelector('input[type="radio"]');
        radio.addEventListener('change', function() {
            const val = parseInt(this.value);
            for (let i = 1; i <= 5; i++) {
                if (!starIcons[i]) continue;
                if (i <= val) {
                    starIcons[i].classList.remove('text-gray-200');
                    starIcons[i].classList.add('text-amber-400');
                } else {
                    starIcons[i].classList.add('text-gray-200');
                    starIcons[i].classList.remove('text-amber-400');
                }
            }
            if (labelText) labelText.textContent = labels[val] || '';
        });
    });
})();
</script>
@endsection

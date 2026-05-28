@extends('layouts.admin')
@section('title', $event->exists ? 'Modifier l\'événement' : 'Nouvel événement')
@section('page-title', $event->exists ? 'Modifier l\'événement' : 'Nouvel événement')

@section('content')
@php $isEdit = $event->exists; @endphp

<div class="max-w-2xl">
    <form method="POST"
          action="{{ $isEdit ? route('admin.calendrier.update', $event) : route('admin.calendrier.store') }}"
          class="space-y-4">
        @csrf
        @if($isEdit) @method('PUT') @endif

        {{-- Label --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">
                Libellé <span class="text-red-400 normal-case font-normal tracking-normal">*</span>
            </label>
            <input type="text" name="label"
                   value="{{ old('label', $event->label) }}" required
                   placeholder="Ex: VACANCES DE NOËL"
                   class="w-full text-lg font-bold text-gray-800 placeholder-gray-200 border-0 outline-none focus:ring-0 bg-transparent uppercase">
            @error('label')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Dates réelles --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Dates (calendrier visuel)</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-gray-400 mb-2">Date début</label>
                    <input type="date" name="date_debut"
                           value="{{ old('date_debut', $event->date_debut?->format('Y-m-d')) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-2">Date fin <span class="text-gray-300">(optionnel)</span></label>
                    <input type="date" name="date_fin"
                           value="{{ old('date_fin', $event->date_fin?->format('Y-m-d')) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
            </div>
        </div>

        {{-- Texte libre + durée --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Affichage texte (liste)</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-gray-400 mb-2">Date affichée <span class="text-gray-300">(texte libre)</span></label>
                    <input type="text" name="date_affichee"
                           value="{{ old('date_affichee', $event->date_affichee) }}"
                           placeholder="Ex: Vend. 19 déc. → Lun. 05 jan."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
                <div>
                    <label class="block text-xs text-gray-400 mb-2">Durée</label>
                    <input type="text" name="duree"
                           value="{{ old('duree', $event->duree ?? '—') }}"
                           placeholder="Ex: 16 j. ou 7 sem."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
            </div>
        </div>

        {{-- Type + Icône + Ordre --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        Type <span class="text-red-400">*</span>
                    </label>
                    <select name="type" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300">
                        @foreach(['classes' => 'Cours', 'vacances' => 'Vacances', 'conges' => 'Congés', 'rentree' => 'Rentrée / Sortie', 'ferie' => 'Jour férié'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('type', $event->type ?? request('type', 'classes')) === $val ? 'selected' : '' }}>
                            {{ $lbl }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        Icône Flaticon
                    </label>
                    <input type="text" name="icone"
                           value="{{ old('icone', $event->icone ?? 'fi-sr-book') }}"
                           placeholder="fi-sr-book"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 font-mono focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">
                        Ordre <span class="text-gray-300 font-normal tracking-normal ml-1">(ex: 10, 20…)</span>
                    </label>
                    <input type="number" name="ordre" min="0" step="10"
                           value="{{ old('ordre', $event->ordre ?? 0) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all">
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                <i class="fi fi-sr-disk text-sm"></i>
                {{ $isEdit ? 'Enregistrer' : 'Créer' }}
            </button>
            <a href="{{ route('admin.calendrier.index') }}"
               class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium px-6 py-2.5 rounded-xl text-sm transition-colors">
                Annuler
            </a>
        </div>

    </form>

    {{-- Aide icônes --}}
    <div class="mt-6 bg-blue-50 rounded-2xl p-4 border border-blue-100">
        <p class="text-xs text-blue-700 font-semibold mb-2 flex items-center gap-1.5">
            <i class="fi fi-sr-info text-blue-500"></i>
            Icônes disponibles (Flaticon Uicons Solid Rounded)
        </p>
        <div class="flex flex-wrap gap-3">
            @foreach(['fi-sr-book' => 'Cours', 'fi-sr-school' => 'Rentrée', 'fi-sr-graduation-cap' => 'Sortie', 'fi-sr-snowflake' => 'Noël', 'fi-sr-leaf' => 'Toussaint', 'fi-sr-flower' => 'Avril', 'fi-sr-wind' => 'Février', 'fi-sr-star' => 'Férié'] as $cls => $lbl)
            <div class="flex items-center gap-1.5 text-xs text-blue-600 cursor-pointer hover:text-blue-800"
                 onclick="document.querySelector('[name=icone]').value='{{ $cls }}'">
                <i class="fi {{ $cls }} text-blue-500"></i>
                <code class="font-mono text-[10px]">{{ $cls }}</code>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title', 'Témoignages')
@section('page-title', 'Témoignages')

@section('content')

{{-- Outer x-data : modal CRÉER --}}
<div x-data="{ open: {{ ($errors->any() && !old('_edit_id')) || request()->query('create') ? 'true' : 'false' }} }">

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $temoignages->total() }} témoignage(s) au total</p>
    <button @click="open = true"
            data-tooltip="Ajouter manuellement un témoignage de parent"
            class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-teal-200/60">
        <i class="fi fi-sr-plus text-sm"></i>
        Nouveau témoignage
    </button>
</div>

{{-- Cartes --}}
@forelse($temoignages as $item)
{{-- Inner x-data : modal MODIFIER pour cet item --}}
<div x-data="{ open: {{ (old('_edit_id') == $item->id && $errors->any()) || request()->query('edit_id') == $item->id ? 'true' : 'false' }} }"
     class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-3 hover:shadow-md hover:border-teal-100 transition-all duration-200">

    <div class="flex items-start gap-4">
        <div class="w-11 h-11 rounded-xl {{ $item->bg_color }} flex items-center justify-center text-white text-sm font-bold flex-shrink-0 shadow-sm">
            {{ $item->initiales }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-3 flex-wrap mb-1">
                <div class="flex items-center gap-3 min-w-0">
                    <p class="font-bold text-sm text-gray-800 truncate">{{ $item->nom_parent }}</p>
                    <span class="text-gray-300 text-xs flex-shrink-0">·</span>
                    <p class="text-xs text-gray-400 truncate">{{ $item->role_parent }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if($item->publie)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Publié
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-100 text-gray-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Masqué
                    </span>
                    @endif
                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button @click="open = true"
                                class="w-8 h-8 rounded-lg bg-teal-50 hover:bg-teal-100 flex items-center justify-center transition-colors"
                                data-tooltip="Modifier ce témoignage">
                            <i class="fi fi-sr-pencil text-teal-600 text-xs"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.temoignages.destroy', $item) }}"
                              onsubmit="return confirm('Supprimer le témoignage de « {{ addslashes($item->nom_parent) }} » ?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors"
                                    data-tooltip="Supprimer définitivement">
                                <i class="fi fi-sr-trash text-red-500 text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-0.5 mb-2">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fi {{ $i <= $item->note ? 'fi-sr-star text-amber-400' : 'fi-rr-star text-gray-200' }} text-xs"></i>
                @endfor
                <span class="text-xs text-gray-400 ml-1.5">{{ $item->note }}/5</span>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">{{ $item->texte }}</p>
        </div>
    </div>

    {{-- ── Modal Modifier ── --}}
    <x-admin.modal title="Modifier le témoignage" size="max-w-xl">
        @if($errors->any() && old('_edit_id') == $item->id)
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
            <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
            <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.temoignages.update', $item) }}" class="space-y-4">
            @csrf @method('PUT')
            <input type="hidden" name="_edit_id" value="{{ $item->id }}">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Nom du parent <span class="text-red-400 normal-case font-normal">*</span></label>
                    <input type="text" name="nom_parent" value="{{ old('nom_parent', $item->nom_parent) }}" required
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Initiales <span class="text-red-400 normal-case font-normal">*</span></label>
                    <input type="text" name="initiales" value="{{ old('initiales', $item->initiales) }}" required maxlength="5"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Rôle <span class="text-red-400 normal-case font-normal">*</span></label>
                    <input type="text" name="role_parent" value="{{ old('role_parent', $item->role_parent) }}" required
                           placeholder="Maman d'Ange, CP1"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all placeholder-gray-300">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Couleur avatar</label>
                    <div class="flex gap-2 pt-1 flex-wrap">
                        @foreach(['bg-violet-600' => '#7C3AED', 'bg-amber-500' => '#F59E0B', 'bg-pink-500' => '#EC4899', 'bg-teal-500' => '#14B8A6', 'bg-blue-600' => '#2563EB', 'bg-orange-500' => '#F97316'] as $cls => $hex)
                        <label class="cursor-pointer">
                            <input type="radio" name="bg_color" value="{{ $cls }}"
                                   {{ old('bg_color', $item->bg_color) === $cls ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-7 h-7 rounded-full border-2 border-transparent peer-checked:border-gray-700 peer-checked:scale-110 transition-all cursor-pointer shadow-sm"
                                 style="background: {{ $hex }}"></div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Témoignage <span class="text-red-400 normal-case font-normal">*</span></label>
                <textarea name="texte" rows="4" required
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all resize-none">{{ old('texte', $item->texte) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Note</label>
                <div class="flex gap-3">
                    @for($i = 1; $i <= 5; $i++)
                    <label class="flex items-center gap-1.5 cursor-pointer">
                        <input type="radio" name="note" value="{{ $i }}"
                               {{ old('note', $item->note) == $i ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-transparent peer-checked:border-teal-400 peer-checked:bg-teal-50 transition-all cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <span class="text-amber-400 text-sm">{{ str_repeat('★', $i) }}</span>
                            <span class="text-xs text-gray-500 font-medium">{{ $i }}</span>
                        </div>
                    </label>
                    @endfor
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="publie" value="1"
                           {{ old('publie', $item->publie) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-teal-600 border-gray-300 cursor-pointer">
                    <span class="text-sm text-gray-600 font-medium">Afficher sur le site</span>
                </label>
                <div class="flex items-center gap-3">
                    <button type="button" @click="open = false"
                            class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                        Annuler
                    </button>
                    <button type="submit"
                            class="flex items-center gap-2 px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-teal-200/60">
                        <i class="fi fi-sr-disk text-sm"></i>
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </x-admin.modal>
</div>{{-- /inner x-data --}}
@empty
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm py-16 text-center">
    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
        <i class="fi fi-sr-comment-alt text-gray-300 text-2xl"></i>
    </div>
    <p class="text-gray-400 font-medium text-sm">Aucun témoignage pour l'instant</p>
    <button @click="open = true"
            class="inline-flex items-center gap-2 mt-4 text-teal-600 hover:text-teal-800 text-sm font-semibold">
        <i class="fi fi-sr-plus text-xs"></i>
        Ajouter le premier témoignage
    </button>
</div>
@endforelse

@if($temoignages->hasPages())
<div class="mt-4">{{ $temoignages->links() }}</div>
@endif

{{-- ── Modal Nouveau témoignage ─────────────────────────────────────────── --}}
<x-admin.modal title="Nouveau témoignage" size="max-w-xl">
    @if($errors->any() && !old('_edit_id'))
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
        <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
        <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.temoignages.store') }}" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Nom du parent <span class="text-red-400 normal-case font-normal">*</span></label>
                <input type="text" name="nom_parent" value="{{ old('nom_parent') }}" required
                       placeholder="Mme Koné Adjoua"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all placeholder-gray-300">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Initiales <span class="text-red-400 normal-case font-normal">*</span></label>
                <input type="text" name="initiales" value="{{ old('initiales') }}" required maxlength="5"
                       placeholder="KA"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all placeholder-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Rôle <span class="text-red-400 normal-case font-normal">*</span></label>
                <input type="text" name="role_parent" value="{{ old('role_parent') }}" required
                       placeholder="Maman d'Ange, CP1"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all placeholder-gray-300">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Couleur avatar</label>
                <div class="flex gap-2 pt-1 flex-wrap">
                    @foreach(['bg-violet-600' => '#7C3AED', 'bg-amber-500' => '#F59E0B', 'bg-pink-500' => '#EC4899', 'bg-teal-500' => '#14B8A6', 'bg-blue-600' => '#2563EB', 'bg-orange-500' => '#F97316'] as $cls => $hex)
                    <label class="cursor-pointer">
                        <input type="radio" name="bg_color" value="{{ $cls }}"
                               {{ old('bg_color', 'bg-teal-500') === $cls ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-7 h-7 rounded-full border-2 border-transparent peer-checked:border-gray-700 peer-checked:scale-110 transition-all cursor-pointer shadow-sm"
                             style="background: {{ $hex }}"></div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Témoignage <span class="text-red-400 normal-case font-normal">*</span></label>
            <textarea name="texte" rows="4" required
                      placeholder="Ce que le parent dit de l'école…"
                      class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-400 transition-all resize-none placeholder-gray-300">{{ old('texte') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Note</label>
            <div class="flex gap-3">
                @for($i = 1; $i <= 5; $i++)
                <label class="flex items-center gap-1.5 cursor-pointer">
                    <input type="radio" name="note" value="{{ $i }}"
                           {{ old('note', 5) == $i ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="flex items-center gap-1 px-3 py-1.5 rounded-lg border-2 border-transparent peer-checked:border-teal-400 peer-checked:bg-teal-50 transition-all cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <span class="text-amber-400 text-sm">{{ str_repeat('★', $i) }}</span>
                        <span class="text-xs text-gray-500 font-medium">{{ $i }}</span>
                    </div>
                </label>
                @endfor
            </div>
        </div>

        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
            <label class="flex items-center gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="publie" value="1" {{ old('publie', '1') ? 'checked' : '' }}
                       class="w-4 h-4 rounded text-teal-600 border-gray-300 cursor-pointer">
                <span class="text-sm text-gray-600 font-medium">Afficher sur le site</span>
            </label>
            <div class="flex items-center gap-3">
                <button type="button" @click="open = false"
                        class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                    Annuler
                </button>
                <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-teal-200/60">
                    <i class="fi fi-sr-disk text-sm"></i>
                    Ajouter
                </button>
            </div>
        </div>
    </form>
</x-admin.modal>

</div>{{-- /outer x-data créer --}}
@endsection

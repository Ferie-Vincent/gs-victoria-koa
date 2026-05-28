@extends('layouts.admin')
@section('title', 'Actualités')
@section('page-title', 'Actualités')

@section('content')

{{-- Outer x-data : modal CRÉER --}}
<div x-data="{ open: {{ ($errors->any() && !old('_edit_id')) || request()->query('create') ? 'true' : 'false' }} }">

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $actualites->total() }} article(s) au total</p>
    <button @click="open = true"
            data-tooltip="Rédiger et publier un nouvel article"
            class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200/60">
        <i class="fi fi-sr-plus text-sm"></i>
        Nouvelle actualité
    </button>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <div class="grid items-center px-5 py-3 border-b border-gray-50"
         style="grid-template-columns: 3fr 1fr 1fr 1fr auto;">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Article</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Catégorie</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Date</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Statut</p>
        <p></p>
    </div>

    @forelse($actualites as $item)
    {{-- Inner x-data : modal MODIFIER pour cet item --}}
    <div x-data="{ open: {{ (old('_edit_id') == $item->id && $errors->any()) || request()->query('edit_id') == $item->id ? 'true' : 'false' }} }"
         class="group border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors">

        <div class="grid items-center px-5 py-3.5"
             style="grid-template-columns: 3fr 1fr 1fr 1fr auto;">

            <div class="flex items-center gap-3 min-w-0 pr-4">
                @if($item->image)
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                    <img src="{{ $item->image }}" alt="" class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center text-white text-sm font-bold"
                     style="background: linear-gradient(135deg, #7C3AED, #EC4899);">
                    <i class="fi fi-sr-newspaper text-sm"></i>
                </div>
                @endif
                <div class="min-w-0">
                    <p class="font-semibold text-sm text-gray-800 truncate">{{ $item->titre }}</p>
                    <p class="text-xs text-gray-400 truncate mt-0.5">{{ Str::limit($item->extrait, 55) }}</p>
                </div>
            </div>

            <div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $item->badge_bg }} text-white">
                    {{ $item->categorie }}
                </span>
            </div>

            <p class="text-sm text-gray-500">{{ $item->date_publication->format('d/m/Y') }}</p>

            <div>
                @if($item->publie)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Publié
                </span>
                @else
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold bg-gray-100 text-gray-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Brouillon
                </span>
                @endif
            </div>

            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <button @click="open = true"
                        class="w-8 h-8 rounded-lg bg-violet-50 hover:bg-violet-100 flex items-center justify-center transition-colors"
                        data-tooltip="Modifier cet article">
                    <i class="fi fi-sr-pencil text-violet-600 text-xs"></i>
                </button>
                <form method="POST" action="{{ route('admin.actualites.destroy', $item) }}"
                      onsubmit="return confirm('Supprimer « {{ addslashes($item->titre) }} » ?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors"
                            data-tooltip="Supprimer définitivement">
                        <i class="fi fi-sr-trash text-red-500 text-xs"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Modal Modifier ── --}}
        <x-admin.modal title="Modifier l'actualité" size="max-w-3xl">
            @if($errors->any() && old('_edit_id') == $item->id)
            <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
                <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
                <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.actualites.update', $item) }}"
                  enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')
                <input type="hidden" name="_edit_id" value="{{ $item->id }}">

                <div>
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                        Titre <span class="text-red-400 normal-case font-normal">*</span>
                    </label>
                    <input type="text" name="titre" value="{{ old('titre', $item->titre) }}" required
                           class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                        Extrait <span class="text-red-400 normal-case font-normal">*</span>
                        <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(max 500 car.)</span>
                    </label>
                    <textarea name="extrait" rows="3" required maxlength="500"
                              class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all resize-none">{{ old('extrait', $item->extrait) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                        Contenu complet <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(optionnel)</span>
                    </label>
                    <textarea name="contenu" rows="4"
                              class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all resize-y">{{ old('contenu', $item->contenu) }}</textarea>
                </div>

                {{-- Photos existantes + ajout --}}
                <div x-data="photoZone()">
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                        Photos <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(jpg/png/webp · max 5 Mo chacune)</span>
                    </label>

                    {{-- Photos existantes conservées --}}
                    @php $existingPhotos = $item->all_photos; @endphp
                    @if(count($existingPhotos) > 0)
                    <div class="grid gap-2 mb-3" style="grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));"
                         x-data="{ kept: {{ json_encode($existingPhotos) }} }">
                        <template x-for="(src, i) in kept" :key="i">
                            <div class="relative rounded-xl overflow-hidden" style="aspect-ratio:1;">
                                <img :src="src" class="w-full h-full object-cover">
                                <input type="hidden" name="keep_images[]" :value="src" :id="'keep_'+i">
                                <button type="button"
                                        @click="kept.splice(i, 1); $el.closest('div').querySelector('input').remove()"
                                        class="absolute top-1 right-1 w-5 h-5 rounded-full bg-red-600 flex items-center justify-center"
                                        style="opacity:0.85;">
                                    <i class="fi fi-rr-cross text-white" style="font-size:0.5rem;"></i>
                                </button>
                            </div>
                        </template>
                        <p x-show="kept.length === 0" class="col-span-full text-xs text-gray-400 italic">Toutes les photos supprimées</p>
                    </div>
                    @endif

                    {{-- Zone upload nouvelles photos --}}
                    <label for="photos-edit-{{ $item->id }}"
                           class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 bg-white cursor-pointer transition-colors"
                           style="padding: 16px;"
                           :style="dragging ? 'border-color:#7C3AED; background:#f5f3ff;' : ''"
                           @dragover.prevent="dragging = true"
                           @dragleave.prevent="dragging = false"
                           @drop.prevent="dragging = false; handleDrop($event)">
                        <i class="fi fi-sr-add-image text-gray-300" style="font-size:1.5rem;"></i>
                        <span class="text-xs text-gray-400">Ajouter des photos · <span class="text-violet-600 font-semibold">cliquer</span></span>
                        <input id="photos-edit-{{ $item->id }}" type="file" name="photos[]" multiple
                               accept="image/jpeg,image/png,image/webp"
                               class="hidden" x-ref="input" @change="handleChange">
                    </label>

                    {{-- Preview nouvelles --}}
                    <div x-show="previews.length > 0" class="grid gap-2 mt-2" style="grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));">
                        <template x-for="(p, i) in previews" :key="i">
                            <div class="relative rounded-xl overflow-hidden" style="aspect-ratio:1;">
                                <img :src="p.src" :alt="p.name" class="w-full h-full object-cover">
                                <button type="button" @click="remove(i)"
                                        class="absolute top-1 right-1 w-5 h-5 rounded-full bg-gray-900 flex items-center justify-center"
                                        style="opacity:0.75;">
                                    <i class="fi fi-rr-cross text-white" style="font-size:0.5rem;"></i>
                                </button>
                                <span class="absolute bottom-0 left-0 right-0 text-white text-center"
                                      style="font-size:0.6rem; padding:2px 4px; background:rgba(0,0,0,0.5); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
                                      x-text="p.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                        Date de publication <span class="text-red-400 normal-case font-normal">*</span>
                    </label>
                    <input type="date" name="date_publication"
                           value="{{ old('date_publication', $item->date_publication->format('Y-m-d')) }}" required
                           class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            Catégorie <span class="text-red-400 normal-case font-normal">*</span>
                        </label>
                        <select name="categorie" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                            @foreach(['Sport', 'Événement', 'Animation', 'Créatif', 'Pédagogie', 'Santé'] as $cat)
                            <option value="{{ $cat }}" {{ old('categorie', $item->categorie) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Couleur badge</label>
                        <div class="flex gap-2 flex-wrap pt-1">
                            @foreach(['bg-violet-600' => '#7C3AED', 'bg-orange-500' => '#F97316', 'bg-teal-600' => '#0D9488', 'bg-pink-500' => '#EC4899', 'bg-blue-600' => '#2563EB', 'bg-amber-500' => '#F59E0B'] as $cls => $hex)
                            <label class="cursor-pointer">
                                <input type="radio" name="badge_bg" value="{{ $cls }}"
                                       {{ old('badge_bg', $item->badge_bg) === $cls ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-7 h-7 rounded-full border-2 border-transparent peer-checked:border-gray-700 peer-checked:scale-110 transition-all cursor-pointer shadow-sm"
                                     style="background: {{ $hex }}"></div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <label class="flex items-center gap-2.5 cursor-pointer select-none">
                        <input type="checkbox" name="publie" value="1"
                               {{ old('publie', $item->publie) ? 'checked' : '' }}
                               class="w-4 h-4 rounded text-violet-600 border-gray-300 cursor-pointer">
                        <span class="text-sm text-gray-600 font-medium">Publié</span>
                    </label>
                    <div class="flex items-center gap-3">
                        <button type="button" @click="open = false"
                                class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                            Annuler
                        </button>
                        <button type="submit"
                                class="flex items-center gap-2 px-5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                            <i class="fi fi-sr-disk text-sm"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </x-admin.modal>
    </div>{{-- /inner x-data --}}
    @empty
    <div class="py-16 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
            <i class="fi fi-sr-newspaper text-gray-300 text-2xl"></i>
        </div>
        <p class="text-gray-400 font-medium text-sm">Aucune actualité pour l'instant</p>
        <button @click="open = true"
                class="inline-flex items-center gap-2 mt-4 text-violet-600 hover:text-violet-800 text-sm font-semibold">
            <i class="fi fi-sr-plus text-xs"></i>
            Créer la première actualité
        </button>
    </div>
    @endforelse

    @if($actualites->hasPages())
    <div class="px-5 py-4 border-t border-gray-50">{{ $actualites->links() }}</div>
    @endif
</div>

{{-- ── Modal Nouvelle actualité ─────────────────────────────────────────── --}}
<x-admin.modal title="Nouvelle actualité" size="max-w-3xl">
    @if($errors->any() && !old('_edit_id'))
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
        <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
        <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.actualites.store') }}"
          enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                Titre <span class="text-red-400 normal-case font-normal">*</span>
            </label>
            <input type="text" name="titre" value="{{ old('titre') }}" required
                   placeholder="Ex : Journée sportive annuelle 2026"
                   class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 font-semibold focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                Extrait <span class="text-red-400 normal-case font-normal">*</span>
                <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(max 500 car.)</span>
            </label>
            <textarea name="extrait" rows="3" required maxlength="500"
                      placeholder="Résumé court affiché dans les listes…"
                      class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all resize-none placeholder-gray-300">{{ old('extrait') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                Contenu complet <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(optionnel)</span>
            </label>
            <textarea name="contenu" rows="4"
                      placeholder="Texte détaillé de l'article…"
                      class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all resize-y placeholder-gray-300">{{ old('contenu') }}</textarea>
        </div>

        {{-- Zone upload multi-photos --}}
        <div x-data="photoZone()">
            <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                Photos <span class="text-gray-400 font-normal tracking-normal normal-case ml-1">(optionnel · jpg/png/webp · max 5 Mo chacune)</span>
            </label>

            {{-- Drop zone --}}
            <label for="photos-create"
                   class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 bg-white cursor-pointer transition-colors"
                   style="padding: 20px;"
                   :style="dragging ? 'border-color:#7C3AED; background:#f5f3ff;' : ''"
                   @dragover.prevent="dragging = true"
                   @dragleave.prevent="dragging = false"
                   @drop.prevent="dragging = false; handleDrop($event)">
                <i class="fi fi-sr-picture text-gray-300" style="font-size:1.75rem;"></i>
                <span class="text-sm text-gray-400">Glisser des photos ici ou <span class="text-violet-600 font-semibold">cliquer</span></span>
                <input id="photos-create" type="file" name="photos[]" multiple
                       accept="image/jpeg,image/png,image/webp"
                       class="hidden" x-ref="input" @change="handleChange">
            </label>

            {{-- Previews --}}
            <div x-show="previews.length > 0" class="grid gap-2 mt-3" style="grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));">
                <template x-for="(p, i) in previews" :key="i">
                    <div class="relative rounded-xl overflow-hidden" style="aspect-ratio:1;">
                        <img :src="p.src" :alt="p.name" class="w-full h-full object-cover">
                        <button type="button" @click="remove(i)"
                                class="absolute top-1 right-1 w-5 h-5 rounded-full bg-gray-900 flex items-center justify-center transition-opacity"
                                style="opacity:0.75;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.75'">
                            <i class="fi fi-rr-cross text-white" style="font-size:0.5rem;"></i>
                        </button>
                        <span class="absolute bottom-0 left-0 right-0 text-white text-center"
                              style="font-size:0.6rem; padding:2px 4px; background:rgba(0,0,0,0.5); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"
                              x-text="p.name"></span>
                    </div>
                </template>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                Date de publication <span class="text-red-400 normal-case font-normal">*</span>
            </label>
            <input type="date" name="date_publication" value="{{ old('date_publication', now()->format('Y-m-d')) }}" required
                   class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">
                    Catégorie <span class="text-red-400 normal-case font-normal">*</span>
                </label>
                <select name="categorie" required
                        class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                    @foreach(['Sport', 'Événement', 'Animation', 'Créatif', 'Pédagogie', 'Santé'] as $cat)
                    <option value="{{ $cat }}" {{ old('categorie') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-violet-700 uppercase tracking-wide mb-1.5">Couleur badge</label>
                <div class="flex gap-2 flex-wrap pt-1">
                    @foreach(['bg-violet-600' => '#7C3AED', 'bg-orange-500' => '#F97316', 'bg-teal-600' => '#0D9488', 'bg-pink-500' => '#EC4899', 'bg-blue-600' => '#2563EB', 'bg-amber-500' => '#F59E0B'] as $cls => $hex)
                    <label class="cursor-pointer" data-tooltip="{{ $cls }}">
                        <input type="radio" name="badge_bg" value="{{ $cls }}"
                               {{ old('badge_bg', 'bg-violet-600') === $cls ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-7 h-7 rounded-full border-2 border-transparent peer-checked:border-gray-700 peer-checked:scale-110 transition-all cursor-pointer shadow-sm"
                             style="background: {{ $hex }}"></div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 mt-2 border-t border-gray-200">
            <label class="flex items-center gap-2.5 cursor-pointer select-none">
                <input type="checkbox" name="publie" value="1" {{ old('publie', '1') ? 'checked' : '' }}
                       class="w-4 h-4 rounded text-violet-600 border-gray-300 cursor-pointer">
                <span class="text-sm text-gray-600 font-medium">Publier immédiatement</span>
            </label>
            <div class="flex items-center gap-3">
                <button type="button" @click="open = false"
                        class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                    Annuler
                </button>
                <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                    <i class="fi fi-sr-disk text-sm"></i>
                    Publier l'article
                </button>
            </div>
        </div>
    </form>
</x-admin.modal>

</div>{{-- /outer x-data créer --}}
@endsection

@push('scripts')
<script>
function photoZone() {
    return {
        previews: [],
        files: [],
        dragging: false,

        handleChange(e) {
            this.addFiles(e.target.files);
        },

        handleDrop(e) {
            this.addFiles(e.dataTransfer.files);
            // Sync dropped files into the real input via DataTransfer
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.input.files = dt.files;
        },

        addFiles(fileList) {
            Array.from(fileList).forEach(f => {
                if (!f.type.startsWith('image/')) return;
                this.files.push(f);
                const reader = new FileReader();
                reader.onload = (ev) => this.previews.push({ name: f.name, src: ev.target.result });
                reader.readAsDataURL(f);
            });
            // Sync all files into the input
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.input.files = dt.files;
        },

        remove(i) {
            this.previews.splice(i, 1);
            this.files.splice(i, 1);
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.input.files = dt.files;
        }
    };
}
</script>
@endpush

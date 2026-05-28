@extends('layouts.admin')
@section('title', $user->exists ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur')
@section('page-title', $user->exists ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur')

@section('content')
@php $isEdit = $user->exists; @endphp

<div class="max-w-lg">
    <form method="POST"
          action="{{ $isEdit ? route('admin.utilisateurs.update', $user) : route('admin.utilisateurs.store') }}"
          class="space-y-5">
        @csrf
        @if($isEdit) @method('PUT') @endif

        {{-- Errors --}}
        @if($errors->any())
        <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
            <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
            <ul class="space-y-0.5">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

            {{-- Nom --}}
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2 flex items-center gap-1.5">
                    Nom complet <span class="text-red-400 normal-case font-normal">*</span>
                    <span data-tooltip="Prénom et nom de la personne" class="w-4 h-4 rounded-full bg-gray-100 flex items-center justify-center cursor-help">
                        <i class="fi fi-sr-info text-gray-400" style="font-size:9px"></i>
                    </span>
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       placeholder="Ex: Mme Koffi Direction"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2 flex items-center gap-1.5">
                    Adresse email <span class="text-red-400 normal-case font-normal">*</span>
                    <span data-tooltip="Utilisée pour se connecter à l'administration" class="w-4 h-4 rounded-full bg-gray-100 flex items-center justify-center cursor-help">
                        <i class="fi fi-sr-info text-gray-400" style="font-size:9px"></i>
                    </span>
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       placeholder="email@gsvictoriakoa.ci"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
            </div>

            {{-- Mot de passe --}}
            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2 flex items-center gap-1.5">
                    Mot de passe {{ $isEdit ? '' : '*' }}
                    <span data-tooltip="{{ $isEdit ? 'Laissez vide pour conserver le mot de passe actuel' : 'Minimum 8 caractères, avec des lettres et des chiffres' }}"
                          class="w-4 h-4 rounded-full bg-gray-100 flex items-center justify-center cursor-help">
                        <i class="fi fi-sr-info text-gray-400" style="font-size:9px"></i>
                    </span>
                </label>
                <input type="password" name="password" {{ $isEdit ? '' : 'required' }}
                       placeholder="{{ $isEdit ? 'Laisser vide = pas de changement' : 'Min. 8 caractères + chiffres' }}"
                       autocomplete="new-password"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
                @if($isEdit)
                <p class="text-xs text-gray-400 mt-1.5 flex items-center gap-1">
                    <i class="fi fi-sr-info text-gray-300 text-xs"></i>
                    Laissez vide pour conserver le mot de passe actuel
                </p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                <i class="fi fi-sr-disk text-sm"></i>
                {{ $isEdit ? 'Enregistrer' : 'Créer le compte' }}
            </button>
            <a href="{{ route('admin.utilisateurs.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection

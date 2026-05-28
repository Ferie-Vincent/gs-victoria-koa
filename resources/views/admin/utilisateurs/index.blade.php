@extends('layouts.admin')
@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des utilisateurs')

@section('content')

<div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $users->count() }} compte(s) administrateur</p>
    <button @click="open = true"
            data-tooltip="Ajouter un nouveau compte administrateur"
            class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200/60">
        <i class="fi fi-sr-plus text-sm"></i>
        Nouvel utilisateur
    </button>
</div>

<div class="flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-sm text-amber-800 mb-6">
    <i class="fi fi-sr-shield-check text-amber-500 flex-shrink-0 mt-0.5"></i>
    <span>Tous ces comptes ont un accès <strong>complet</strong> à l'espace d'administration. Ne créez un compte que pour une personne de confiance de l'équipe.</span>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <div class="grid items-center px-5 py-3 border-b border-gray-50"
         style="grid-template-columns: 3fr 2fr 1fr auto;">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Utilisateur</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Email</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Créé le</p>
        <p></p>
    </div>

    @forelse($users as $u)
    <div class="group grid items-center px-5 py-3.5 border-b border-gray-50 last:border-0 hover:bg-gray-50/60 transition-colors"
         style="grid-template-columns: 3fr 2fr 1fr auto;">

        <div class="flex items-center gap-3 min-w-0">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-sm flex-shrink-0
                        {{ $u->id === auth()->id() ? 'bg-violet-600' : 'bg-slate-400' }}">
                {{ strtoupper(substr($u->name, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-sm text-gray-800 truncate flex items-center gap-2">
                    {{ $u->name }}
                    @if($u->id === auth()->id())
                    <span class="text-[10px] font-medium text-violet-600 bg-violet-50 px-2 py-0.5 rounded-full border border-violet-200"
                          data-tooltip="C'est votre propre compte">Vous</span>
                    @endif
                </p>
            </div>
        </div>

        <p class="text-sm text-gray-500 truncate pr-4">{{ $u->email }}</p>
        <p class="text-sm text-gray-400">{{ $u->created_at->format('d/m/Y') }}</p>

        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('admin.utilisateurs.edit', $u) }}"
               class="w-8 h-8 rounded-lg bg-violet-50 hover:bg-violet-100 flex items-center justify-center transition-colors"
               data-tooltip="Modifier ce compte">
                <i class="fi fi-sr-pencil text-violet-600 text-xs"></i>
            </a>
            @if($u->id !== auth()->id())
            <form method="POST" action="{{ route('admin.utilisateurs.destroy', $u) }}"
                  onsubmit="return confirm('Supprimer le compte de « {{ addslashes($u->name) }} » ?\nCette action est irréversible.')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors"
                        data-tooltip="Supprimer ce compte">
                    <i class="fi fi-sr-trash text-red-500 text-xs"></i>
                </button>
            </form>
            @else
            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                 data-tooltip="Impossible de supprimer votre propre compte">
                <i class="fi fi-sr-trash text-gray-200 text-xs"></i>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="py-16 text-center">
        <p class="text-gray-400 text-sm">Aucun utilisateur.</p>
    </div>
    @endforelse

</div>

{{-- ── Modal Nouvel utilisateur ─────────────────────────────────────────── --}}
<x-admin.modal title="Nouvel utilisateur" size="max-w-md">
    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
        <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
        <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.utilisateurs.store') }}" class="space-y-4">
        @csrf

        <div class="flex items-start gap-3 bg-amber-50 border border-amber-100 rounded-xl px-4 py-3 text-xs text-amber-700 mb-1">
            <i class="fi fi-sr-shield-check text-amber-500 flex-shrink-0 mt-0.5"></i>
            Ce compte aura un accès <strong class="ml-1">complet</strong> à l'administration.
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Nom complet <span class="text-red-400 normal-case font-normal">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   placeholder="Ex : Mme Koffi Direction"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Adresse email <span class="text-red-400 normal-case font-normal">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   placeholder="email@gsvictoriakoa.ci"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Mot de passe <span class="text-red-400 normal-case font-normal">*</span></label>
            <input type="password" name="password" required autocomplete="new-password"
                   placeholder="Min. 8 caractères + chiffres"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
            <p class="text-xs text-gray-400 mt-1.5">Minimum 8 caractères avec au moins une lettre et un chiffre.</p>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
            <button type="button" @click="open = false"
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                Annuler
            </button>
            <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                <i class="fi fi-sr-user-add text-sm"></i>
                Créer le compte
            </button>
        </div>
    </form>
</x-admin.modal>

</div>{{-- /x-data --}}
@endsection

@extends('layouts.admin')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

{{-- ── En-tête ──────────────────────────────────────────────────────────── --}}
<div class="flex items-center justify-between mb-7">
    <div>
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            Bonjour, {{ auth()->user()->name ?? 'Direction' }}
            <span class="text-xl">👋</span>
        </h2>
        <p class="text-sm text-gray-400 mt-0.5 flex items-center gap-2">
            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
            <span class="text-gray-200">·</span>
            <span class="inline-flex items-center gap-1.5 font-semibold text-violet-600">
                <span class="w-1.5 h-1.5 rounded-full bg-violet-500 inline-block"></span>
                Année {{ \App\Models\Setting::schoolYear() }}
            </span>
        </p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.actualites.create') }}"
           class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200/60">
            <i class="fi fi-sr-plus text-xs"></i>
            Nouvelle actualité
        </a>
    </div>
</div>

{{-- ── Stats row ────────────────────────────────────────────────────────── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">

    {{-- Actualités --}}
    <a href="{{ route('admin.actualites.index') }}"
       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:border-violet-100 transition-all duration-200 overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-violet-500 rounded-l-2xl"></div>
        <div class="pl-2">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-violet-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fi fi-sr-newspaper text-violet-600 text-sm"></i>
                </div>
                <i class="fi fi-rr-arrow-up-right-from-square text-gray-200 group-hover:text-violet-400 text-xs transition-colors"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800 leading-none tracking-tight">{{ $nbActualites }}</p>
            <p class="text-xs text-gray-400 font-medium mt-1.5">Actualités</p>
        </div>
    </a>

    {{-- Témoignages --}}
    <a href="{{ route('admin.temoignages.index') }}"
       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:border-teal-100 transition-all duration-200 overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-teal-500 rounded-l-2xl"></div>
        <div class="pl-2">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-teal-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fi fi-sr-comment-alt text-teal-600 text-sm"></i>
                </div>
                <i class="fi fi-rr-arrow-up-right-from-square text-gray-200 group-hover:text-teal-400 text-xs transition-colors"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800 leading-none tracking-tight">{{ $nbTemoignages }}</p>
            <p class="text-xs text-gray-400 font-medium mt-1.5">Témoignages</p>
        </div>
    </a>

    {{-- Messages reçus --}}
    <a href="{{ route('admin.messages.index') }}"
       class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:shadow-md hover:border-blue-100 transition-all duration-200 overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-blue-500 rounded-l-2xl"></div>
        <div class="pl-2">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fi fi-sr-envelope text-blue-600 text-sm"></i>
                </div>
                <i class="fi fi-rr-arrow-up-right-from-square text-gray-200 group-hover:text-blue-400 text-xs transition-colors"></i>
            </div>
            <p class="text-3xl font-bold text-gray-800 leading-none tracking-tight">{{ $nbMessages }}</p>
            <p class="text-xs text-gray-400 font-medium mt-1.5">Messages reçus</p>
        </div>
    </a>

    {{-- Non lus --}}
    <a href="{{ route('admin.messages.index') }}"
       class="group relative shadow-sm p-5 transition-all duration-200 overflow-hidden rounded-2xl border
              {{ $nbNonLus > 0
                  ? 'bg-red-50 border-red-200 hover:shadow-md hover:border-red-300'
                  : 'bg-white border-gray-100 hover:shadow-md hover:border-gray-200' }}">
        @if($nbNonLus > 0)
        <div class="absolute top-0 left-0 w-1 h-full bg-red-500 rounded-l-2xl"></div>
        <div class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
        @else
        <div class="absolute top-0 left-0 w-1 h-full bg-gray-200 rounded-l-2xl"></div>
        @endif
        <div class="pl-2">
            <div class="flex items-start justify-between mb-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform
                            {{ $nbNonLus > 0 ? 'bg-red-100' : 'bg-gray-100' }}">
                    <i class="fi fi-sr-bell text-sm {{ $nbNonLus > 0 ? 'text-red-500' : 'text-gray-400' }}"></i>
                </div>
            </div>
            <p class="text-3xl font-bold leading-none tracking-tight {{ $nbNonLus > 0 ? 'text-red-600' : 'text-gray-800' }}">
                {{ $nbNonLus }}
            </p>
            <p class="text-xs font-medium mt-1.5 {{ $nbNonLus > 0 ? 'text-red-400' : 'text-gray-400' }}">
                {{ $nbNonLus > 0 ? 'Non lus · à traiter' : 'Tout est lu' }}
            </p>
        </div>
    </a>

</div>

{{-- ── Contenu principal ────────────────────────────────────────────────── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- ── Colonne gauche (2/3) ─────────────────────────────────────────── --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Dernières actualités --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-50">
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fi fi-sr-newspaper text-violet-500 text-sm"></i>
                    Dernières actualités
                </h3>
                <a href="{{ route('admin.actualites.index') }}"
                   class="text-xs text-violet-500 hover:text-violet-700 font-semibold flex items-center gap-1 transition-colors">
                    Tout voir <i class="fi fi-rr-arrow-right text-xs"></i>
                </a>
            </div>

            @forelse($recentActualites as $actu)
            <div class="group flex items-center gap-4 px-5 py-3.5 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                {{-- Thumb --}}
                @if($actu->image)
                <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                    <img src="{{ $actu->image }}" alt=""
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center text-white text-xs"
                     style="background: linear-gradient(135deg, #7C3AED, #EC4899);">
                    <i class="fi fi-sr-newspaper text-xs"></i>
                </div>
                @endif

                {{-- Contenu --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-sm text-gray-800 truncate">{{ $actu->titre }}</p>
                    <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold {{ $actu->badge_bg }} text-white">
                            {{ $actu->categorie }}
                        </span>
                        {{ $actu->date_publication->locale('fr')->isoFormat('D MMM YYYY') }}
                    </p>
                </div>

                {{-- Statut + action --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    @if($actu->publie)
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500" title="Publié"></span>
                    @else
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300" title="Brouillon"></span>
                    @endif
                    <a href="{{ route('admin.actualites.index', ['edit_id' => $actu->id]) }}"
                       class="opacity-0 group-hover:opacity-100 w-7 h-7 rounded-lg bg-violet-50 hover:bg-violet-100 flex items-center justify-center transition-all">
                        <i class="fi fi-sr-pencil text-violet-600 text-[10px]"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="py-10 text-center">
                <p class="text-gray-400 text-sm">Aucune actualité pour l'instant.</p>
                <a href="{{ route('admin.actualites.create') }}"
                   class="inline-flex items-center gap-1.5 mt-2 text-violet-600 hover:text-violet-800 text-xs font-semibold">
                    <i class="fi fi-sr-plus text-xs"></i> Créer la première
                </a>
            </div>
            @endforelse
        </div>

        {{-- Derniers messages --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-50">
                <h3 class="font-bold text-gray-800 text-sm flex items-center gap-2">
                    <i class="fi fi-sr-envelope text-blue-500 text-sm"></i>
                    Derniers messages
                    @if($nbNonLus > 0)
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-600">
                        {{ $nbNonLus }} non lu{{ $nbNonLus > 1 ? 's' : '' }}
                    </span>
                    @endif
                </h3>
                <a href="{{ route('admin.messages.index') }}"
                   class="text-xs text-blue-500 hover:text-blue-700 font-semibold flex items-center gap-1 transition-colors">
                    Tout voir <i class="fi fi-rr-arrow-right text-xs"></i>
                </a>
            </div>

            @forelse($recentMessages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}"
               class="group flex items-center gap-4 px-5 py-3 border-b border-gray-50 last:border-0 transition-colors
                      {{ !$msg->lu ? 'bg-blue-50/30 hover:bg-blue-50/50' : 'hover:bg-gray-50/50' }}">
                {{-- Avatar --}}
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr($msg->nom, 0, 1)) }}
                </div>

                {{-- Contenu --}}
                <div class="flex-1 min-w-0">
                    <p class="text-sm truncate {{ !$msg->lu ? 'font-bold text-gray-900' : 'font-medium text-gray-700' }}">
                        {{ $msg->nom }}
                        @if(!$msg->lu)
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-red-500 mb-0.5 ml-1"></span>
                        @endif
                    </p>
                    <p class="text-xs text-gray-400 truncate">{{ Str::limit($msg->sujet, 50) }}</p>
                </div>

                {{-- Date --}}
                <p class="text-xs text-gray-300 flex-shrink-0 group-hover:text-gray-400 transition-colors">
                    {{ $msg->created_at->locale('fr')->diffForHumans() }}
                </p>
            </a>
            @empty
            <div class="py-10 text-center">
                <p class="text-gray-400 text-sm">Aucun message reçu.</p>
            </div>
            @endforelse
        </div>

    </div>

    {{-- ── Colonne droite (1/3) ─────────────────────────────────────────── --}}
    <div class="space-y-5">

        {{-- Actions rapides --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-bolt text-amber-400"></i>
                Actions rapides
            </h3>
            <div class="space-y-1">
                @php
                $actions = [
                    ['route' => 'admin.actualites.create',  'icon' => 'fi-sr-plus',        'label' => 'Nouvelle actualité',  'color' => 'text-violet-600', 'bg' => 'bg-violet-50', 'hover' => 'hover:bg-violet-100'],
                    ['route' => 'admin.temoignages.create', 'icon' => 'fi-sr-plus',        'label' => 'Nouveau témoignage',  'color' => 'text-teal-600',   'bg' => 'bg-teal-50',   'hover' => 'hover:bg-teal-100'],
                    ['route' => 'admin.messages.index',     'icon' => 'fi-sr-envelope',    'label' => 'Voir les messages',   'color' => 'text-blue-600',   'bg' => 'bg-blue-50',   'hover' => 'hover:bg-blue-100'],
                    ['route' => 'admin.calendrier.index',   'icon' => 'fi-sr-calendar',    'label' => 'Calendrier scolaire', 'color' => 'text-indigo-600', 'bg' => 'bg-indigo-50', 'hover' => 'hover:bg-indigo-100'],
                    ['route' => 'admin.documents.index',    'icon' => 'fi-sr-file-pdf',    'label' => 'Documents PDF',       'color' => 'text-orange-600', 'bg' => 'bg-orange-50', 'hover' => 'hover:bg-orange-100'],
                    ['route' => 'admin.settings.index',     'icon' => 'fi-sr-settings',    'label' => 'Paramètres du site',  'color' => 'text-gray-600',   'bg' => 'bg-gray-50',   'hover' => 'hover:bg-gray-100'],
                ];
                @endphp
                @foreach($actions as $action)
                <a href="{{ route($action['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ $action['bg'] }} {{ $action['hover'] }} transition-colors group">
                    <div class="w-7 h-7 rounded-lg bg-white shadow-sm flex items-center justify-center flex-shrink-0">
                        <i class="fi {{ $action['icon'] }} {{ $action['color'] }} text-xs"></i>
                    </div>
                    <span class="text-sm font-semibold {{ $action['color'] }}">{{ $action['label'] }}</span>
                    <i class="fi fi-rr-arrow-right text-xs {{ $action['color'] }} opacity-0 group-hover:opacity-100 ml-auto transition-opacity"></i>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Infos école --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-school text-amber-500"></i>
                École
            </h3>
            <div class="space-y-3">
                @php
                $infos = [
                    ['icon' => 'fi-sr-calendar',   'label' => 'Année scolaire', 'value' => \App\Models\Setting::schoolYear(),                   'color' => 'bg-violet-50 text-violet-500'],
                    ['icon' => 'fi-sr-phone-call',  'label' => 'Téléphone',      'value' => \App\Models\Setting::get('telephone_1', '—'),         'color' => 'bg-emerald-50 text-emerald-500'],
                    ['icon' => 'fi-sr-envelope',   'label' => 'Email',           'value' => \App\Models\Setting::get('email_direction', '—'),     'color' => 'bg-blue-50 text-blue-500'],
                ];
                @endphp
                @foreach($infos as $info)
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg {{ $info['color'] }} flex items-center justify-center flex-shrink-0">
                        <i class="fi {{ $info['icon'] }} text-xs"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide leading-none">{{ $info['label'] }}</p>
                        <p class="text-xs font-semibold text-gray-700 mt-0.5 truncate">{{ $info['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-3 border-t border-gray-50">
                <a href="{{ route('admin.settings.index') }}"
                   class="text-xs text-violet-500 hover:text-violet-700 font-semibold flex items-center gap-1 transition-colors">
                    Modifier les paramètres
                    <i class="fi fi-rr-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        {{-- Statut inscriptions --}}
        <div class="rounded-2xl border p-5 {{ $inscriptionOuverte ? 'bg-emerald-50 border-emerald-200' : 'bg-amber-50 border-amber-200' }}">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ $inscriptionOuverte ? 'bg-emerald-200' : 'bg-amber-200' }}">
                    <i class="fi {{ $inscriptionOuverte ? 'fi-sr-check' : 'fi-sr-lock' }} text-sm {{ $inscriptionOuverte ? 'text-emerald-700' : 'text-amber-700' }}"></i>
                </div>
                <div>
                    <p class="font-bold text-sm {{ $inscriptionOuverte ? 'text-emerald-800' : 'text-amber-800' }}">
                        Inscriptions {{ $inscriptionOuverte ? 'ouvertes' : 'fermées' }}
                    </p>
                    <p class="text-xs {{ $inscriptionOuverte ? 'text-emerald-600' : 'text-amber-600' }}">
                        Année {{ \App\Models\Setting::schoolYear() }}
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.settings.index') }}"
               class="text-xs font-semibold flex items-center gap-1 {{ $inscriptionOuverte ? 'text-emerald-700 hover:text-emerald-900' : 'text-amber-700 hover:text-amber-900' }} transition-colors">
                Modifier le statut <i class="fi fi-rr-arrow-right text-xs"></i>
            </a>
        </div>

    </div>
</div>

@endsection

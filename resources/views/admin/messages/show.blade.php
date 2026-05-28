@extends('layouts.admin')
@section('title', 'Message de ' . $message->nom)
@section('page-title', 'Détail du message')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 max-w-5xl">

    {{-- ── Message principal (2/3) ─────────────────────────────────────── --}}
    <div class="xl:col-span-2 space-y-4">

        {{-- Sujet --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Sujet</p>
            <h2 class="text-lg font-bold text-gray-800">{{ $message->sujet }}</h2>
        </div>

        {{-- Corps du message --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-2">
                <i class="fi fi-sr-comment-alt text-blue-400"></i>
                Message
            </p>
            <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100">
                <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $message->message }}</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->sujet) }}"
               data-tooltip="Ouvre votre client email avec le sujet pré-rempli"
               class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all hover:scale-[1.01] shadow-md shadow-blue-200/60">
                <i class="fi fi-sr-paper-plane text-sm"></i>
                Répondre par email
            </a>
            @if($message->telephone)
            <a href="tel:{{ $message->telephone }}"
               class="flex items-center gap-2 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 font-semibold px-5 py-2.5 rounded-xl text-sm transition-colors">
                <i class="fi fi-sr-phone-call text-sm"></i>
                Appeler
            </a>
            @endif
            <a href="{{ route('admin.messages.index') }}"
               class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium px-5 py-2.5 rounded-xl text-sm transition-colors ml-auto">
                <i class="fi fi-rr-arrow-left text-sm"></i>
                Retour
            </a>
        </div>
    </div>

    {{-- ── Infos expéditeur (1/3) ──────────────────────────────────────── --}}
    <div class="space-y-4">

        {{-- Carte expéditeur --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <i class="fi fi-sr-user text-gray-400"></i>
                Expéditeur
            </h3>

            {{-- Avatar --}}
            <div class="flex items-center gap-3 mb-5 pb-5 border-b border-gray-50">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0 shadow-sm">
                    {{ strtoupper(substr($message->nom, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-gray-800 text-sm">{{ $message->nom }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Visiteur du site</p>
                </div>
            </div>

            {{-- Coordonnées --}}
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-envelope text-blue-500 text-xs"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide leading-none">Email</p>
                        <a href="mailto:{{ $message->email }}"
                           class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors mt-0.5 block truncate">
                            {{ $message->email }}
                        </a>
                    </div>
                </div>

                @if($message->telephone)
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-phone-call text-emerald-500 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide leading-none">Téléphone</p>
                        <a href="tel:{{ $message->telephone }}"
                           class="text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors mt-0.5 block">
                            {{ $message->telephone }}
                        </a>
                    </div>
                </div>
                @endif

                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-clock text-gray-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide leading-none">Reçu le</p>
                        <p class="text-xs font-semibold text-gray-700 mt-0.5">
                            {{ $message->created_at->format('d/m/Y') }}
                            <span class="text-gray-400 font-normal">à {{ $message->created_at->format('H:i') }}</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i class="fi fi-sr-eye text-gray-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide leading-none">Statut</p>
                        @if($message->lu)
                        <span class="inline-flex items-center gap-1.5 mt-0.5 text-xs font-semibold text-emerald-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Lu
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 mt-0.5 text-xs font-semibold text-red-600">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Non lu
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Zone danger --}}
        <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 text-sm mb-3 flex items-center gap-2">
                <i class="fi fi-sr-trash text-red-400"></i>
                Zone danger
            </h3>
            <p class="text-xs text-gray-400 mb-4 leading-relaxed">
                Cette action est irréversible. Le message sera définitivement supprimé.
            </p>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                  onsubmit="return confirm('Supprimer définitivement ce message ?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2.5 rounded-xl text-sm transition-colors border border-red-200">
                    <i class="fi fi-sr-trash text-sm"></i>
                    Supprimer ce message
                </button>
            </form>
        </div>

    </div>
</div>

@endsection

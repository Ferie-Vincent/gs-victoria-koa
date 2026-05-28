@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Messages de contact')

@section('content')

<div x-data="{
    open: false,
    loading: false,
    msg: null,

    async openMsg(id) {
        this.open    = true;
        this.loading = true;
        this.msg     = null;
        try {
            const r = await fetch('/admin/messages/' + id, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            this.msg = await r.json();
            /* Marquer la ligne comme lue visuellement */
            const row = document.querySelector('[data-msg-id=\'' + id + '\']');
            if (row) {
                row.classList.remove('bg-blue-50/30', 'hover:bg-blue-50/50');
                row.classList.add('hover:bg-gray-50/60');
                const dot = row.querySelector('.unread-dot');
                if (dot) dot.remove();
                const name = row.querySelector('.msg-name');
                if (name) { name.classList.remove('font-bold', 'text-gray-900'); name.classList.add('font-medium', 'text-gray-700'); }
                const subj = row.querySelector('.msg-subj');
                if (subj) { subj.classList.remove('font-semibold', 'text-gray-800'); subj.classList.add('text-gray-600'); }
            }
        } catch(e) {
            this.open = false;
        }
        this.loading = false;
    }
}">

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-gray-400 text-sm">
            {{ $messages->total() }} message(s)
            @if(($nbNonLus ?? 0) > 0)
            <span class="ml-2 inline-flex items-center gap-1 text-red-500 font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span>
                {{ $nbNonLus }} non lu{{ $nbNonLus > 1 ? 's' : '' }}
            </span>
            @endif
        </p>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <div class="grid items-center px-5 py-3 border-b border-gray-50"
         style="grid-template-columns: 24px 2fr 1.5fr 2fr 1fr auto;">
        <p></p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Expéditeur</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Email</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Sujet</p>
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Date</p>
        <p></p>
    </div>

    @forelse($messages as $msg)
    <div class="group grid items-center px-5 py-3.5 border-b border-gray-50 last:border-0 transition-colors
                {{ !$msg->lu ? 'bg-blue-50/30 hover:bg-blue-50/50' : 'hover:bg-gray-50/60' }}"
         style="grid-template-columns: 24px 2fr 1.5fr 2fr 1fr auto;"
         data-msg-id="{{ $msg->id }}">

        {{-- Indicateur non-lu --}}
        <div class="flex items-center justify-center">
            @if(!$msg->lu)
            <span class="unread-dot w-2 h-2 rounded-full bg-red-500 flex-shrink-0"></span>
            @endif
        </div>

        {{-- Expéditeur --}}
        <div class="flex items-center gap-3 min-w-0 pr-3">
            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                {{ strtoupper(substr($msg->nom, 0, 1)) }}
            </div>
            <p class="msg-name text-sm truncate {{ !$msg->lu ? 'font-bold text-gray-900' : 'font-medium text-gray-700' }}">
                {{ $msg->nom }}
            </p>
        </div>

        <p class="text-xs text-gray-400 truncate pr-3">{{ $msg->email }}</p>

        <p class="msg-subj text-sm truncate pr-3 {{ !$msg->lu ? 'font-semibold text-gray-800' : 'text-gray-600' }}">
            {{ Str::limit($msg->sujet, 45) }}
        </p>

        <p class="text-xs text-gray-400 whitespace-nowrap">
            {{ $msg->created_at->format('d/m/Y') }}<br>
            <span class="text-gray-300">{{ $msg->created_at->format('H:i') }}</span>
        </p>

        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <button @click="openMsg({{ $msg->id }})"
                    class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center transition-colors"
                    data-tooltip="Lire ce message">
                <i class="fi fi-sr-envelope-open text-blue-600 text-xs"></i>
            </button>
            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}"
                  onsubmit="return confirm('Supprimer le message de « {{ addslashes($msg->nom) }} » ?')">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors"
                        data-tooltip="Supprimer">
                    <i class="fi fi-sr-trash text-red-500 text-xs"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="py-16 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
            <i class="fi fi-sr-envelope text-gray-300 text-2xl"></i>
        </div>
        <p class="text-gray-400 font-medium text-sm">Aucun message reçu pour l'instant</p>
        <p class="text-gray-300 text-xs mt-1">Les messages du formulaire de contact apparaîtront ici</p>
    </div>
    @endforelse

    @if($messages->hasPages())
    <div class="px-5 py-4 border-t border-gray-50">{{ $messages->links() }}</div>
    @endif
</div>

{{-- ══ Modal message ═══════════════════════════════════════════════════ --}}
<div x-show="open"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     @keydown.escape.window="open = false">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"></div>

    {{-- Panel --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[92vh] flex flex-col"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-2">

        {{-- Header modal --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                {{-- Avatar --}}
                <div x-show="msg" class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    <span x-text="msg ? msg.initiale : ''"></span>
                </div>
                <div class="min-w-0" x-show="msg">
                    <p class="font-bold text-gray-800 text-sm leading-tight truncate" x-text="msg ? msg.nom : ''"></p>
                    <p class="text-xs text-gray-400 leading-tight truncate" x-text="msg ? msg.email : ''"></p>
                </div>
                {{-- Skeleton --}}
                <div x-show="loading" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gray-100 animate-pulse"></div>
                    <div class="space-y-1.5">
                        <div class="w-28 h-3 rounded bg-gray-100 animate-pulse"></div>
                        <div class="w-36 h-2.5 rounded bg-gray-100 animate-pulse"></div>
                    </div>
                </div>
            </div>
            <button type="button" @click="open = false"
                    class="w-8 h-8 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors flex-shrink-0 ml-3"
                    data-tooltip="Fermer">
                <i class="fi fi-rr-cross text-gray-500 text-xs"></i>
            </button>
        </div>

        {{-- Contenu scrollable --}}
        <div class="overflow-y-auto flex-1 p-6 space-y-4">

            {{-- Skeleton loading --}}
            <template x-if="loading">
                <div class="space-y-4 animate-pulse">
                    <div class="h-5 bg-gray-100 rounded-lg w-3/4"></div>
                    <div class="space-y-2">
                        <div class="h-3 bg-gray-100 rounded w-full"></div>
                        <div class="h-3 bg-gray-100 rounded w-full"></div>
                        <div class="h-3 bg-gray-100 rounded w-2/3"></div>
                    </div>
                </div>
            </template>

            {{-- Contenu message --}}
            <template x-if="msg && !loading">
                <div class="space-y-4">

                    {{-- Sujet --}}
                    <div>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1">Sujet</p>
                        <h2 class="text-base font-bold text-gray-800" x-text="msg.sujet"></h2>
                    </div>

                    {{-- Méta : date + téléphone --}}
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <i class="fi fi-sr-clock text-gray-300 text-xs"></i>
                            <span x-text="'Reçu le ' + msg.created_at + ' à ' + msg.created_time"></span>
                        </div>
                        <template x-if="msg.telephone">
                            <a :href="'tel:' + msg.telephone"
                               class="flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-800 transition-colors">
                                <i class="fi fi-sr-phone-call text-xs"></i>
                                <span x-text="msg.telephone"></span>
                            </a>
                        </template>
                    </div>

                    {{-- Corps message --}}
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap" x-text="msg.message"></p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 pt-1 border-t border-gray-50 flex-wrap">
                        <a :href="'mailto:' + msg.email + '?subject=Re: ' + encodeURIComponent(msg.sujet)"
                           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-all hover:scale-[1.01] shadow-md shadow-blue-200/60">
                            <i class="fi fi-sr-paper-plane text-sm"></i>
                            Répondre par email
                        </a>
                        <template x-if="msg.telephone">
                            <a :href="'tel:' + msg.telephone"
                               class="flex items-center gap-2 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                                <i class="fi fi-sr-phone-call text-sm"></i>
                                Appeler
                            </a>
                        </template>
                        <form :action="'/admin/messages/' + msg.id" method="POST" class="ml-auto"
                              onsubmit="return confirm('Supprimer définitivement ce message ?')">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                    class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 font-semibold px-4 py-2 rounded-xl text-sm transition-colors border border-red-100">
                                <i class="fi fi-sr-trash text-sm"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>
            </template>

        </div>
    </div>
</div>

</div>{{-- /x-data --}}
@endsection

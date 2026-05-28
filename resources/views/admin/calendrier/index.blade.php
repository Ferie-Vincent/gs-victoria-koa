@extends('layouts.admin')
@section('title', 'Calendrier scolaire')
@section('page-title', 'Calendrier scolaire')

@section('content')

<script>window.__calEvents = @json($eventsJson);</script>

<style>
.cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); }
.cal-cell { position: relative; height: 48px; display: flex; align-items: center; justify-content: center; }
.cal-band {
    position: absolute; top: 5px; bottom: 5px;
    transition: opacity 0.15s;
}
.cal-band-start { left: 6px; border-radius: 10px 0 0 10px; }
.cal-band-end   { right: 6px; border-radius: 0 10px 10px 0; }
.cal-band-solo  { left: 6px; right: 6px; border-radius: 10px; }
.cal-band-mid   { left: 0; right: 0; border-radius: 0; }
.cal-band-row-start { left: 6px; border-radius: 10px 0 0 10px; }
.cal-band-row-end   { right: 6px; border-radius: 0 10px 10px 0; }
.mini-dot { width: 5px; height: 5px; border-radius: 2px; }
</style>

@php
    $now    = now();
    $sy     = $now->month >= 9 ? $now->year : $now->year - 1;
    $syNext = $sy + 1;
@endphp

<div x-data="{
    open: {{ $errors->any() ? 'true' : 'false' }},
    selYear: new Date().getFullYear(),
    selMonth: new Date().getMonth(),
    events: window.__calEvents,

    goTo(y, m) { this.selYear = y; this.selMonth = m; },
    prevMonth() {
        if (this.selMonth === 0) { this.selMonth = 11; this.selYear--; }
        else { this.selMonth--; }
    },
    nextMonth() {
        if (this.selMonth === 11) { this.selMonth = 0; this.selYear++; }
        else { this.selMonth++; }
    },

    get monthLabel() {
        return new Date(this.selYear, this.selMonth, 1)
            .toLocaleDateString('fr-FR', { month: 'long', year: 'numeric' });
    },
    get cells() {
        const dim = new Date(this.selYear, this.selMonth + 1, 0).getDate();
        const pad = (new Date(this.selYear, this.selMonth, 1).getDay() + 6) % 7;
        const arr = Array(pad).fill(null);
        for (let d = 1; d <= dim; d++) arr.push(d);
        while (arr.length % 7 !== 0) arr.push(null);
        return arr;
    },

    ds(y, m, d) {
        return y + '-' + String(m + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
    },
    dayEvts(y, m, d) {
        if (!d) return [];
        const s = this.ds(y, m, d);
        return this.events.filter(e => e.date_debut && s >= e.date_debut && s <= (e.date_fin || e.date_debut));
    },
    dayType(y, m, d) {
        const e = this.dayEvts(y, m, d);
        return e.length ? e[0].type : null;
    },
    dayLabel(y, m, d) {
        return this.dayEvts(y, m, d).map(e => e.label).join(' · ');
    },

    /* Band boundary detection */
    isFirst(y, m, d, idx) {
        if (!d) return false;
        const e = this.dayEvts(y, m, d);
        if (!e.length) return false;
        return this.ds(y, m, d) === e[0].date_debut;
    },
    isLast(y, m, d, idx) {
        if (!d) return false;
        const e = this.dayEvts(y, m, d);
        if (!e.length) return false;
        return this.ds(y, m, d) === (e[0].date_fin || e[0].date_debut);
    },
    bandClass(y, m, d, idx) {
        if (!d || !this.dayType(y, m, d)) return '';
        const col  = idx % 7;
        const type = this.dayType(y, m, d);

        /* Jours sans cours (Mer=2, Sam=5, Dim=6) — pas de bande pour les cours */
        if (type === 'classes' && (col === 2 || col === 5 || col === 6)) return '';

        const first = this.isFirst(y, m, d, idx);
        const last  = this.isLast(y, m, d, idx);
        const rowS  = col === 0;
        const rowE  = col === 6;

        /* Pour type classes : Mar(1) et Ven(4) terminent un segment (avant Mer/Sam) ;
           Lun(0) et Jeu(3) démarrent un segment (apres Dim/Mer). */
        const segEnd   = type === 'classes' && (col === 1 || col === 4);
        const segStart = type === 'classes' && (col === 0 || col === 3);

        const s = first || rowS || segStart;
        const e = last  || rowE || segEnd;
        if (s && e) return 'cal-band cal-band-solo';
        if (s)      return 'cal-band cal-band-start';
        if (e)      return 'cal-band cal-band-end';
        return 'cal-band cal-band-mid';
    },

    isToday(y, m, d) {
        if (!d) return false;
        const t = new Date();
        return d === t.getDate() && m === t.getMonth() && y === t.getFullYear();
    },

    COLORS: {
        classes:  { bg: 'rgba(109,40,217,0.10)',  txt: '#4C1D95', dot: '#7C3AED' },
        vacances: { bg: 'rgba(234,88,12,0.11)',   txt: '#7C2D12', dot: '#F97316' },
        conges:   { bg: 'rgba(14,165,233,0.11)',  txt: '#0C4A6E', dot: '#0EA5E9' },
        rentree:  { bg: 'rgba(5,150,105,0.11)',   txt: '#064E3B', dot: '#10B981' },
        ferie:    { bg: 'rgba(217,119,6,0.14)',   txt: '#78350F', dot: '#F59E0B' },
    },
    bg(t)  { return t && this.COLORS[t] ? this.COLORS[t].bg  : ''; },
    txt(t) { return t && this.COLORS[t] ? this.COLORS[t].txt : '#374151'; },
    dot(t) { return t && this.COLORS[t] ? this.COLORS[t].dot : '#E5E7EB'; },

    /* Year strip */
    get syMonths() {
        const sy = (new Date()).getMonth() >= 8 ? (new Date()).getFullYear() : (new Date()).getFullYear() - 1;
        const arr = [];
        for (let i = 0; i < 12; i++) {
            const m = (8 + i) % 12;
            arr.push({ month: m, year: m < 8 ? sy + 1 : sy });
        }
        return arr;
    },
    miniCells(y, m) {
        const dim = new Date(y, m + 1, 0).getDate();
        const pad = (new Date(y, m, 1).getDay() + 6) % 7;
        const arr = Array(pad).fill(null);
        for (let d = 1; d <= dim; d++) arr.push(d);
        return arr;
    },
    miniLabel(y, m) {
        return new Date(y, m, 1).toLocaleDateString('fr-FR', { month: 'short' }).replace('.','').toUpperCase();
    },
    isSel(y, m) { return y === this.selYear && m === this.selMonth; }
}">

{{-- ══ Header ═══════════════════════════════════════════════════════ --}}
<div class="flex items-center justify-between mb-5">
    <div>
        <p class="text-sm font-semibold text-gray-700">Année scolaire {{ $sy }}–{{ $syNext }}</p>
        <p class="text-xs text-gray-400 mt-0.5">{{ $allEvents->count() }} événement(s) au total</p>
    </div>
    <button @click="open = true"
            data-tooltip="Ajouter une période ou un jour férié"
            class="flex items-center gap-2 bg-violet-600 hover:bg-violet-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-[1.02] shadow-md shadow-violet-200/60">
        <i class="fi fi-sr-plus text-sm"></i>
        Nouvel événement
    </button>
</div>

{{-- ══ Year strip ════════════════════════════════════════════════════ --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-5">
    <div class="overflow-x-auto px-5 py-4 scrollbar-none" style="scrollbar-width:none;">
        <div class="flex gap-5 min-w-max items-end">

            {{-- Année label --}}
            <div class="flex-shrink-0 self-center pr-2 border-r border-gray-100 mr-1">
                <p class="text-[10px] font-black tracking-widest text-gray-300 uppercase writing-mode-vertical">
                    {{ $sy }}<br>{{ $syNext }}
                </p>
            </div>

            <template x-for="(md, i) in syMonths" :key="i">
                <button @click="goTo(md.year, md.month)"
                        class="flex-shrink-0 flex flex-col items-center gap-1.5 group transition-all duration-150 outline-none focus:outline-none"
                        :class="isSel(md.year, md.month) ? 'opacity-100' : 'opacity-35 hover:opacity-65'">

                    {{-- Month name --}}
                    <span class="text-[9px] font-black tracking-[0.18em] transition-colors leading-none"
                          :class="isSel(md.year, md.month) ? 'text-violet-600' : 'text-gray-400'"
                          x-text="miniLabel(md.year, md.month)"></span>

                    {{-- Mini dot grid --}}
                    <div class="grid grid-cols-7 gap-[2px]">
                        <template x-for="(day, j) in miniCells(md.year, md.month)" :key="j">
                            <div class="mini-dot transition-colors"
                                 :style="day ? ('background:' + dot(dayType(md.year, md.month, day))) : 'background:transparent'">
                            </div>
                        </template>
                    </div>

                    {{-- Selected underline --}}
                    <div class="h-[2px] w-full rounded-full transition-all"
                         :class="isSel(md.year, md.month) ? 'bg-violet-500' : 'bg-transparent'"></div>
                </button>
            </template>
        </div>
    </div>
</div>

{{-- ══ Calendrier ══════════════════════════════════════════════════════ --}}
<div class="space-y-5">
<div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- Month nav --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <button @click="prevMonth()"
                        class="w-9 h-9 rounded-xl bg-gray-50 hover:bg-violet-50 text-gray-400 hover:text-violet-600 flex items-center justify-center transition-all"
                        data-tooltip="Mois précédent">
                    <i class="fi fi-sr-angle-left text-xs"></i>
                </button>
                <h3 class="font-bold text-gray-800 text-base capitalize tracking-tight" x-text="monthLabel"></h3>
                <button @click="nextMonth()"
                        class="w-9 h-9 rounded-xl bg-gray-50 hover:bg-violet-50 text-gray-400 hover:text-violet-600 flex items-center justify-center transition-all"
                        data-tooltip="Mois suivant">
                    <i class="fi fi-sr-angle-right text-xs"></i>
                </button>
            </div>

            {{-- Day headers --}}
            <div class="cal-grid px-4 pt-3 pb-1">
                @foreach(['L','M','M','J','V','S','D'] as $i => $h)
                <div class="text-center pb-1"
                     style="font-size:10px; font-weight:800; letter-spacing:.14em; color:{{ $i >= 5 ? '#C9B8FF' : '#D1D5DB' }};">
                    {{ $h }}
                </div>
                @endforeach
            </div>

            {{-- Day grid — gap-0 for seamless bands --}}
            <div class="cal-grid px-4 pb-4">
                <template x-for="(day, idx) in cells" :key="idx">
                    <div class="cal-cell"
                         :title="day ? dayLabel(selYear, selMonth, day) : ''">

                        {{-- Period band --}}
                        <div x-show="day && dayType(selYear, selMonth, day)"
                             :class="bandClass(selYear, selMonth, day, idx)"
                             :style="'background:' + bg(dayType(selYear, selMonth, day))">
                        </div>

                        {{-- Today ring --}}
                        <div x-show="isToday(selYear, selMonth, day)"
                             class="absolute w-8 h-8 rounded-full ring-2 ring-violet-500 ring-offset-1 z-10 pointer-events-none">
                        </div>

                        {{-- Day number --}}
                        <span x-show="day" x-text="day"
                              class="relative z-20 select-none text-sm leading-none"
                              :class="isToday(selYear, selMonth, day) ? 'font-black' : (dayType(selYear, selMonth, day) ? 'font-semibold' : 'font-medium')"
                              :style="'color:' + (day ? txt(dayType(selYear, selMonth, day)) : 'transparent')">
                        </span>

                    </div>
                </template>
            </div>

            {{-- Legend --}}
            <div class="flex items-center gap-5 px-6 py-3 border-t border-gray-50 bg-gray-50/40 flex-wrap">
                @foreach([
                    'classes'  => ['Cours',            '#7C3AED'],
                    'vacances' => ['Vacances',          '#F97316'],
                    'conges'   => ['Congés',            '#0EA5E9'],
                    'rentree'  => ['Rentrée / Sortie',  '#10B981'],
                    'ferie'    => ['Jour férié',         '#F59E0B'],
                ] as $type => [$lbl, $clr])
                <div class="flex items-center gap-2">
                    <div class="w-5 h-3 rounded-md" style="background:{{ $clr }}1A; border: 1.5px solid {{ $clr }}40;"></div>
                    <span class="text-[11px] font-medium text-gray-500">{{ $lbl }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

{{-- ══ Liste unifiée ══════════════════════════════════════════════════════ --}}
@php
$typeConfig = [
    'classes'  => ['label' => 'Cours',    'color' => '#7C3AED', 'bg' => '#7C3AED18', 'ico' => 'fi-sr-book'],
    'vacances' => ['label' => 'Vacances', 'color' => '#F97316', 'bg' => '#F9731618', 'ico' => 'fi-sr-snowflake'],
    'conges'   => ['label' => 'Congés',   'color' => '#0EA5E9', 'bg' => '#0EA5E918', 'ico' => 'fi-sr-umbrella'],
    'rentree'  => ['label' => 'Rentrée',  'color' => '#10B981', 'bg' => '#10B98118', 'ico' => 'fi-sr-graduation-cap'],
    'ferie'    => ['label' => 'Férié',    'color' => '#F59E0B', 'bg' => '#F59E0B18', 'ico' => 'fi-sr-star'],
];
@endphp

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    {{-- En-tête --}}
    <div class="px-5 py-4 border-b border-gray-50 flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0">
            <i class="fi fi-sr-calendar text-violet-500 text-sm"></i>
        </div>
        <span class="font-bold text-gray-800 text-sm">Tous les événements</span>
        <span class="text-xs font-mono text-gray-300">{{ $allEvents->count() }}</span>

        {{-- Légende inline --}}
        <div class="flex items-center gap-3 ml-2">
            @foreach($typeConfig as $tc)
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide leading-none"
                  style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $tc['label'] }}</span>
            @endforeach
        </div>

        <button @click="open = true"
                class="ml-auto flex items-center gap-1.5 text-xs text-violet-500 hover:text-violet-700 font-semibold transition-colors">
            <i class="fi fi-sr-plus text-xs"></i> Ajouter
        </button>
    </div>

    {{-- Lignes --}}
    @forelse($allEvents as $event)
    @php $tc = $typeConfig[$event->type] ?? $typeConfig['classes']; @endphp
    <div class="group flex items-center gap-3 px-5 py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors"
         style="border-left: 3px solid {{ $tc['color'] }}44;">

        {{-- Badge type --}}
        <span class="flex-shrink-0 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide leading-none w-16 text-center"
              style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $tc['label'] }}</span>

        {{-- Icône --}}
        <div class="w-6 h-6 rounded-lg flex items-center justify-center flex-shrink-0"
             style="background:{{ $tc['bg'] }};">
            <i class="fi {{ $event->icone }} text-[10px]" style="color:{{ $tc['color'] }};"></i>
        </div>

        {{-- Label --}}
        <p class="font-semibold text-sm text-gray-800 flex-1 min-w-0 truncate">{{ $event->label }}</p>

        {{-- Dates --}}
        <div class="flex-shrink-0 text-xs text-right hidden sm:block">
            @if($event->date_debut)
                <span class="font-medium text-gray-600">{{ $event->date_debut->format('d/m/Y') }}</span>
                @if($event->date_fin && $event->date_fin->ne($event->date_debut))
                    <span class="text-gray-300 mx-1">→</span>
                    <span class="font-medium text-gray-600">{{ $event->date_fin->format('d/m/Y') }}</span>
                @endif
            @elseif($event->date_affichee)
                <span class="text-gray-500">{{ $event->date_affichee }}</span>
            @endif
            @if($event->duree && $event->duree !== '—')
                <span class="block text-gray-300 text-[11px]">{{ $event->duree }}</span>
            @endif
        </div>

        {{-- Ordre --}}
        <span class="flex-shrink-0 text-[10px] text-gray-300 font-mono w-6 text-center hidden lg:block">{{ $event->ordre }}</span>

        {{-- Actions --}}
        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
            <a href="{{ route('admin.calendrier.edit', $event) }}"
               class="w-7 h-7 rounded-lg bg-violet-50 hover:bg-violet-100 flex items-center justify-center transition-colors"
               data-tooltip="Modifier">
                <i class="fi fi-sr-pencil text-violet-600 text-[10px]"></i>
            </a>
            <form method="POST" action="{{ route('admin.calendrier.destroy', $event) }}"
                  onsubmit="return confirm('Supprimer « {{ addslashes($event->label) }} » ?')">
                @csrf @method('DELETE')
                <button class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors"
                        data-tooltip="Supprimer">
                    <i class="fi fi-sr-trash text-red-500 text-[10px]"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="py-16 text-center">
        <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3">
            <i class="fi fi-sr-calendar text-gray-200 text-2xl"></i>
        </div>
        <p class="text-gray-300 text-sm">Aucun événement configuré.</p>
        <button @click="open = true" class="mt-2 text-xs text-violet-500 hover:text-violet-700 font-semibold">+ Ajouter le premier</button>
    </div>
    @endforelse

</div>

</div>{{-- /space-y-5 --}}

{{-- ══ Modal Nouvel événement ════════════════════════════════════════ --}}
<x-admin.modal title="Nouvel événement" size="max-w-lg">
    @if($errors->any())
    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
        <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
        <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.calendrier.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Libellé <span class="text-red-400 normal-case font-normal">*</span></label>
            <input type="text" name="label" value="{{ old('label') }}" required
                   placeholder="Ex : VACANCES DE NOËL"
                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Type <span class="text-red-400 normal-case font-normal">*</span></label>
            <div class="grid grid-cols-5 gap-2">
                @foreach([
                    'classes'  => ['Cours',    'fi-sr-book',           'peer-checked:bg-violet-100 peer-checked:border-violet-400 peer-checked:text-violet-700 bg-violet-50 border-violet-100 text-violet-400'],
                    'vacances' => ['Vacances', 'fi-sr-snowflake',      'peer-checked:bg-orange-100 peer-checked:border-orange-400 peer-checked:text-orange-700 bg-orange-50 border-orange-100 text-orange-400'],
                    'conges'   => ['Congés',   'fi-sr-umbrella',       'peer-checked:bg-sky-100 peer-checked:border-sky-400 peer-checked:text-sky-700 bg-sky-50 border-sky-100 text-sky-400'],
                    'rentree'  => ['Rentrée',  'fi-sr-graduation-cap', 'peer-checked:bg-green-100 peer-checked:border-green-400 peer-checked:text-green-700 bg-green-50 border-green-100 text-green-500'],
                    'ferie'    => ['Férié',    'fi-sr-star',           'peer-checked:bg-amber-100 peer-checked:border-amber-400 peer-checked:text-amber-700 bg-amber-50 border-amber-100 text-amber-400'],
                ] as $val => [$lbl, $ico, $cls])
                <label class="cursor-pointer">
                    <input type="radio" name="type" value="{{ $val }}"
                           {{ old('type', 'classes') === $val ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="flex flex-col items-center gap-1.5 p-3 rounded-xl border-2 transition-all {{ $cls }}">
                        <i class="fi {{ $ico }} text-sm"></i>
                        <span class="text-[11px] font-semibold leading-none">{{ $lbl }}</span>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Date début</label>
                <input type="date" name="date_debut" value="{{ old('date_debut') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Date fin <span class="text-gray-300 normal-case font-normal tracking-normal">optionnel</span></label>
                <input type="date" name="date_fin" value="{{ old('date_fin') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Texte date <span class="text-gray-300 normal-case font-normal tracking-normal">libre</span></label>
                <input type="text" name="date_affichee" value="{{ old('date_affichee') }}"
                       placeholder="Vend. 19 déc. → Lun. 5 jan."
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Durée</label>
                <input type="text" name="duree" value="{{ old('duree') }}"
                       placeholder="16 j. · 2 sem."
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Icône Flaticon</label>
                <input type="text" name="icone" value="{{ old('icone', 'fi-sr-book') }}" required
                       placeholder="fi-sr-book"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 font-mono focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all placeholder-gray-300">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Ordre <span class="text-gray-300 normal-case font-normal tracking-normal">ex: 10, 20…</span></label>
                <input type="number" name="ordre" min="0" step="10" value="{{ old('ordre', 10) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-violet-300 focus:border-violet-400 transition-all">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
            <button type="button" @click="open = false"
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium transition-colors">
                Annuler
            </button>
            <button type="submit"
                    class="flex items-center gap-2 px-5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold transition-all hover:scale-[1.01] shadow-md shadow-violet-200/60">
                <i class="fi fi-sr-disk text-sm"></i>
                Créer
            </button>
        </div>
    </form>
</x-admin.modal>

</div>{{-- /x-data --}}
@endsection

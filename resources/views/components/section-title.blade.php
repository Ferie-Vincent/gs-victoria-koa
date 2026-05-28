{{--
    Section Title Component
    @param string $title    — Titre principal
    @param string $subtitle — Sous-titre (optionnel)
    @param string $align    — 'center' | 'left' | 'right' (default: 'center')
--}}
@props(['title', 'subtitle' => null, 'align' => 'center'])

@php
$alignClass = match($align) {
    'left'  => 'text-left items-start',
    'right' => 'text-right items-end',
    default => 'text-center items-center',
};
@endphp

<div class="flex flex-col gap-3 {{ $alignClass }}" data-aos="fade-up">
    <h2 class="font-display font-extrabold text-2xl md:text-4xl text-dark leading-tight">
        {!! $title !!}
    </h2>
    @if($subtitle)
    <p class="font-body text-gray-500 text-base md:text-lg max-w-2xl leading-relaxed" data-aos="fade-up" data-aos-delay="100">
        {{ $subtitle }}
    </p>
    @endif
    {{-- Ligne décorative --}}
    <div class="flex gap-1 mt-1" data-aos="zoom-in" data-aos-delay="150">
        <span class="h-1 w-8 rounded-full bg-primary"></span>
        <span class="h-1 w-4 rounded-full bg-accent-pink"></span>
        <span class="h-1 w-2 rounded-full bg-secondary"></span>
    </div>
</div>

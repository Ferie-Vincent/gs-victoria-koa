{{--
    Blob Shape SVG Separator
    @param string $fill — Couleur de remplissage (ex: '#F5F3FF', 'white')
    @param bool   $flip — Inverser horizontalement
--}}
@props(['fill' => '#F5F3FF', 'flip' => false])

<div aria-hidden="true" class="overflow-hidden leading-none {{ $flip ? '-scale-x-100' : '' }}" style="margin-bottom:-2px">
    <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="w-full">
        <path d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z" fill="{{ $fill }}"/>
    </svg>
</div>

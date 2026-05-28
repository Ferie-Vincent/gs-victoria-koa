{{-- Bouton Retour en haut — apparaît après 300px de scroll --}}
<button id="scroll-top-btn"
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Retour en haut de page"
        title="Retour en haut"
        class="fixed bottom-24 right-6 z-[9998] w-12 h-12 rounded-full bg-white border-2 border-primary
               flex items-center justify-center shadow-lg shadow-purple-200
               hover:bg-primary hover:text-white hover:scale-110
               transition-all duration-300
               opacity-0 pointer-events-none translate-y-4"
        style="color: #7C3AED;">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
    </svg>
</button>

@push('scripts')
<script>
(function () {
    const btn = document.getElementById('scroll-top-btn');
    if (!btn) return;

    const toggle = function () {
        if (window.scrollY > 300) {
            btn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
            btn.classList.add('opacity-100', 'translate-y-0');
        } else {
            btn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
            btn.classList.remove('opacity-100', 'translate-y-0');
        }
    };

    window.addEventListener('scroll', toggle, { passive: true });
    toggle(); // état initial
})();
</script>
@endpush

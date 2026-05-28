<a href="tel:{{ preg_replace('/[^+0-9]/', '', $site['telephone_1']) }}"
   class="fixed bottom-6 right-6 z-[9999] w-14 h-14 rounded-full bg-primary flex items-center justify-center animate-pulse-ring hover:scale-110 transition-transform duration-300 shadow-violet"
   aria-label="Nous appeler au {{ $site['telephone_1'] }}"
   title="Appelez-nous !">
    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
    </svg>
</a>

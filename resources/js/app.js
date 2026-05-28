// ═══════════════════════════════════════════════
// AOS — Animate On Scroll
// ═══════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once:     true,
            offset:   100,
            duration: 600,
            easing:   'ease-out-cubic',
        });
    }

    // ═══════════════════════════════════════════
    // Swiper — Témoignages
    // ═══════════════════════════════════════════
    if (typeof Swiper !== 'undefined' && document.querySelector('.swiper-testimonials')) {
        new Swiper('.swiper-testimonials', {
            loop:       true,
            autoplay:   { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            slidesPerView: 1,
            spaceBetween:  32,
            breakpoints: {
                768:  { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
            },
        });
    }

    // ═══════════════════════════════════════════
    // GLightbox — Galerie photos
    // ═══════════════════════════════════════════
    if (typeof GLightbox !== 'undefined' && document.querySelector('.glightbox')) {
        GLightbox({ selector: '.glightbox' });
    }

    // ═══════════════════════════════════════════
    // 3D Tilt universel — toutes les cards du site
    // ═══════════════════════════════════════════
    const TILT_MAX    = 15;    /* degrés max */
    const TILT_Z      = 18;    /* px translateZ */
    const TILT_SCALE  = 1.02;
    const SKIP_TAGS   = new Set(['BUTTON','A','INPUT','TEXTAREA','SELECT','FORM','NAV','HEADER','FOOTER']);

    function applyTilt(card, useWrapper) {
        if (useWrapper) {
            /* Wrapper float-card-wrap → perspective sur parent */
            const wrap = card.parentElement;
            if (wrap) {
                wrap.style.perspective    = '700px';
                wrap.style.transformStyle = 'preserve-3d';
            }
        }

        card.addEventListener('mousemove', e => {
            const r  = card.getBoundingClientRect();
            const px = (e.clientX - r.left)  / r.width  - 0.5;
            const py = (e.clientY - r.top)   / r.height - 0.5;
            const rx = -py * TILT_MAX;
            const ry =  px * TILT_MAX;
            const sx = -px * 18;
            const sy = Math.abs(py) * 10 + 18;
            const tf = useWrapper
                ? `rotateX(${rx}deg) rotateY(${ry}deg) translateZ(${TILT_Z}px) scale(${TILT_SCALE})`
                : `perspective(700px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(${TILT_Z}px) scale(${TILT_SCALE})`;
            card.style.transition = 'transform 0.08s ease-out, box-shadow 0.08s ease-out';
            card.style.transform  = tf;
            card.style.boxShadow  = `${sx}px ${sy}px 36px rgba(0,0,0,0.18)`;
            card.style.zIndex     = '10';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transition = 'transform 0.5s ease-out, box-shadow 0.5s ease-out';
            card.style.transform  = '';
            card.style.boxShadow  = '';
            card.style.zIndex     = '';
        });
    }

    /* 1. Float-card-wrap children (déjà wrappés) */
    const wrappedCards = new Set();
    document.querySelectorAll('.float-card-wrap').forEach(wrap => {
        const card = wrap.querySelector('.float-card-simple, .float-card');
        if (!card) return;
        applyTilt(card, true);
        wrappedCards.add(card);
    });

    /* 2. Tous les autres cards substantiels (rounded-3xl/2xl avec taille suffisante) */
    const candidates = document.querySelectorAll(
        'section [class*="rounded-3xl"], section [class*="rounded-2xl"], main [class*="rounded-3xl"], main [class*="rounded-2xl"]'
    );
    candidates.forEach(el => {
        if (wrappedCards.has(el))        return; /* déjà géré */
        if (SKIP_TAGS.has(el.tagName))   return; /* mauvais tag */
        if (el.dataset.noTilt !== undefined) return; /* exclu explicitement */
        if (el.closest('nav,header,footer,form,button,a')) return;
        const r = el.getBoundingClientRect();
        if (r.width < 200 || r.height < 80) return; /* trop petit = icône/badge */
        /* Éviter les wrappers multi-cards (grilles) */
        const gridChildren = el.querySelectorAll('[class*="rounded-3xl"], [class*="rounded-2xl"]');
        if (gridChildren.length > 2) return;
        applyTilt(el, false);
    });
});

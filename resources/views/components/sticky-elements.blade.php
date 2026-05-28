{{-- ─────────────────────────────────────────────────────────────────
     Éléments décoratifs flottants — style Kidza / école joyeuse
     Images issues de public/images/sticky/
     Uniquement sur les sections de contenu (pas le hero)
     ───────────────────────────────────────────────────────────── --}}
@push('scripts')
<script>
(function () {
    /* Attendre que le DOM soit complet */
    const run = function () {

        // Toutes les sections visibles (non-hero)
        const allSections = Array.from(document.querySelectorAll('section:not(.bg-hero)'));

        // Stickers avec position et section par index dans allSections
        const placements = [
            // section 0 = welcome (crème)
            { idx:0, img:'/images/sticky/flower.png',      top:'10%',    right:'2%',   size:75,  rot:12,  delay:'0s'   },
            { idx:0, img:'/images/sticky/download-2.png',  bottom:'12%', left:'1%',    size:50,  rot:-8,  delay:'1.8s' },

            // section 1 = values (bg-section-alt)
            { idx:1, img:'/images/sticky/butarfly.png',    top:'8%',     right:'1%',   size:60,  rot:15,  delay:'0.5s' },
            { idx:1, img:'/images/sticky/download-4.png',  bottom:'10%', left:'2%',    size:52,  rot:-10, delay:'2s'   },

            // section 2 = activities (bg-white)
            { idx:2, img:'/images/sticky/perasute.png',    top:'12%',    left:'1%',    size:65,  rot:-5,  delay:'1s'   },
            { idx:2, img:'/images/sticky/download-9.png',  bottom:'8%',  right:'2%',   size:48,  rot:8,   delay:'2.4s' },

            // section 3 = stats (fond jaune)
            { idx:3, img:'/images/sticky/download-3.png',  top:'15%',    left:'2%',    size:50,  rot:-12, delay:'0.3s' },
            { idx:3, img:'/images/sticky/download.png',    top:'20%',    right:'2%',   size:55,  rot:10,  delay:'1.5s' },

            // section 4 = classes-preview
            { idx:4, img:'/images/sticky/download-1.png',  top:'5%',     right:'1%',   size:60,  rot:6,   delay:'0.8s' },
            { idx:4, img:'/images/sticky/download-5.png',  bottom:'6%',  left:'1%',    size:55,  rot:-6,  delay:'2.2s' },

            // section 5 = enrollment-cta / how-to-enroll
            { idx:5, img:'/images/sticky/download-7.png',  top:'10%',    left:'2%',    size:58,  rot:-8,  delay:'0.6s' },
            { idx:5, img:'/images/sticky/download-6.png',  bottom:'15%', right:'3%',   size:42,  rot:18,  delay:'1.9s' },

            // section 6 = testimonials
            { idx:6, img:'/images/sticky/butarfly.png',    top:'8%',     right:'2%',   size:55,  rot:12,  delay:'1.1s' },
            { idx:6, img:'/images/sticky/flower.png',      bottom:'10%', left:'1%',    size:65,  rot:-5,  delay:'2.6s' },

            // section 7 = recent-news
            { idx:7, img:'/images/sticky/perasute.png',    top:'12%',    left:'2%',    size:58,  rot:-10, delay:'0.4s' },
            { idx:7, img:'/images/sticky/download-9.png',  bottom:'8%',  right:'2%',   size:48,  rot:8,   delay:'2.1s' },
        ];

        const animClasses = ['animate-float-1','animate-float-2','animate-float-3','animate-float-4'];

        placements.forEach(function (p, i) {
            const section = allSections[p.idx];
            if (!section) return;

            // Assurer position relative
            if (window.getComputedStyle(section).position === 'static') {
                section.style.position = 'relative';
            }

            const img = document.createElement('img');
            img.src = p.img;
            img.alt = '';
            img.setAttribute('aria-hidden', 'true');
            img.setAttribute('loading', 'lazy');
            img.draggable = false;

            const style = {
                position:      'absolute',
                width:         p.size + 'px',
                height:        'auto',
                pointerEvents: 'none',
                zIndex:        '2',
                opacity:       '0.75',
                transform:     'rotate(' + (p.rot || 0) + 'deg)',
                willChange:    'transform',
                userSelect:    'none',
                animationDelay: p.delay,
            };

            if (p.top    !== undefined) style.top    = p.top;
            if (p.bottom !== undefined) style.bottom = p.bottom;
            if (p.left   !== undefined) style.left   = p.left;
            if (p.right  !== undefined) style.right  = p.right;

            Object.assign(img.style, style);
            img.classList.add(animClasses[i % animClasses.length]);

            section.appendChild(img);
        });

        /* ── Bande enfants avant le footer ── */
        const footer = document.querySelector('footer');
        if (footer) {
            const band = document.createElement('div');
            Object.assign(band.style, {
                width:         '100%',
                textAlign:     'center',
                lineHeight:    '0',
                pointerEvents: 'none',
                userSelect:    'none',
                background:    'transparent',
            });
            const kids = document.createElement('img');
            kids.src     = '/images/sticky/download-13.png';
            kids.alt     = '';
            kids.setAttribute('aria-hidden', 'true');
            kids.setAttribute('loading', 'lazy');
            kids.draggable = false;
            Object.assign(kids.style, {
                width:    '100%',
                maxWidth: '900px',
                height:   'auto',
                display:  'inline-block',
            });
            band.appendChild(kids);
            footer.parentNode.insertBefore(band, footer);
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
})();
</script>
@endpush

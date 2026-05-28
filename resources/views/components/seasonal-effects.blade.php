@php
/*
 * Saisons européennes (hémisphère nord) — détection serveur
 */
$m = (int) date('n');
$d = (int) date('j');

if (($m == 12 && $d >= 21) || $m == 1 || $m == 2 || ($m == 3 && $d < 20)) {
    $season = 'winter';
} elseif (($m == 3 && $d >= 20) || $m == 4 || $m == 5 || ($m == 6 && $d < 21)) {
    $season = 'spring';
} elseif (($m == 6 && $d >= 21) || $m == 7 || $m == 8 || ($m == 9 && $d < 23)) {
    $season = 'summer';
} else {
    $season = 'autumn';
}
@endphp

{{-- Overlay particules --}}
<div id="seasonal-overlay"
     class="fixed inset-0 pointer-events-none overflow-hidden"
     style="z-index: 998;"
     aria-hidden="true"></div>

@push('head')
<style>
@keyframes seasonal-fall {
    0%   { transform: translateY(-30px) rotate(0deg);   opacity: 1; }
    80%  { opacity: 0.8; }
    100% { transform: translateY(105vh) rotate(720deg); opacity: 0; }
}
@keyframes seasonal-sway {
    0%, 100% { transform: translateX(0); }
    50%       { transform: translateX(28px); }
}
.s-particle {
    position: absolute;
    top: 0;
    pointer-events: none;
    will-change: transform;
}

/* Été — soleil héro */
@keyframes sun-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}
@keyframes sun-pulse {
    0%, 100% { opacity: .85; transform: scale(1); }
    50%       { opacity: 1;   transform: scale(1.06); }
}
#season-sun-rays { animation: sun-spin 20s linear infinite; }
#season-sun-core { animation: sun-pulse 3s ease-in-out infinite; }

/* Tournesols footer */
@keyframes flower-sway {
    0%, 100% { transform: rotate(-4deg) translateY(0); }
    50%       { transform: rotate(4deg)  translateY(-6px); }
}
.footer-flower { animation: flower-sway 3s ease-in-out infinite; transform-origin: bottom center; }
.footer-flower:nth-child(2) { animation-delay: .5s; }
.footer-flower:nth-child(3) { animation-delay: 1s; }
.footer-flower:nth-child(4) { animation-delay: 1.5s; }
.footer-flower:nth-child(5) { animation-delay: .3s; }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const season = '{{ $season }}';
    const overlay = document.getElementById('seasonal-overlay');

    /* ─── Config par saison ─────────────────────────────── */
    const configs = {
        winter: {
            count: 45,
            make() {
                const sz = Math.random() * 10 + 5;
                const d  = document.createElement('div');
                d.style.cssText = `
                    width:${sz}px;height:${sz}px;
                    background:rgba(255,255,255,.88);
                    border-radius:50%;
                    box-shadow:0 0 ${sz}px rgba(255,255,255,.6),0 0 ${sz*2}px rgba(200,220,255,.3);`;
                return d;
            }
        },
        spring: {
            count: 30,
            make() {
                const sz = Math.random() * 12 + 6;
                const colors = ['#FFB7C5','#FFC0CB','#FF85A2','#FFAEC0','#E8A0BF'];
                const c = colors[Math.floor(Math.random() * colors.length)];
                const d = document.createElement('div');
                d.style.cssText = `
                    width:${sz * 1.6}px;height:${sz}px;
                    background:${c};
                    border-radius:${Math.random() > .5 ? '50% 0 50% 0' : '0 50% 0 50%'};
                    opacity:.9;`;
                return d;
            }
        },
        summer: {
            count: 15,
            make() {
                const sz = Math.random() * 5 + 2;
                const d  = document.createElement('div');
                d.style.cssText = `
                    width:${sz}px;height:${sz}px;
                    background:rgba(251,191,36,.75);
                    border-radius:50%;
                    box-shadow:0 0 ${sz * 3}px rgba(251,191,36,.9);`;
                return d;
            }
        },
        autumn: {
            count: 25,
            make() {
                const emojis = ['🍂','🍁','🍃','🍂','🍁'];
                const sz     = Math.random() * 16 + 10;
                const d      = document.createElement('div');
                d.style.cssText = `font-size:${sz}px;line-height:1;`;
                d.textContent   = emojis[Math.floor(Math.random() * emojis.length)];
                return d;
            }
        }
    };

    /* ─── Génère les particules ─────────────────────────── */
    const cfg = configs[season];
    if (!cfg) return;

    for (let i = 0; i < cfg.count; i++) {
        const wrap = document.createElement('div');
        wrap.className = 's-particle';

        const inner = cfg.make();
        wrap.appendChild(inner);

        const left        = Math.random() * 100;
        const fallDur     = Math.random() * 9 + 6;   /* 6–15 s */
        const swayDur     = Math.random() * 3 + 2;   /* 2–5 s  */
        const delay       = -(Math.random() * fallDur); /* départ décalé */

        wrap.style.cssText = `
            position:absolute;
            left:${left}%;
            top:0;
            animation:
                seasonal-fall ${fallDur}s linear ${delay}s infinite,
                seasonal-sway ${swayDur}s ease-in-out ${delay}s infinite;
            pointer-events:none;`;

        overlay.appendChild(wrap);
    }

    /* ─── Été : soleil héro ─────────────────────────────── */
    if (season === 'summer') {
        const hero = document.querySelector('section.bg-hero, section[class*="bg-hero"]');
        if (hero) {
            hero.style.position = 'relative';
            const sun = document.createElement('div');
            sun.setAttribute('aria-hidden', 'true');
            sun.style.cssText = `
                position:absolute;top:24px;right:40px;
                width:90px;height:90px;
                pointer-events:none;z-index:5;`;
            /* Safe: SVG is fully static — no user input interpolated */
            const svgNS = 'http://www.w3.org/2000/svg';
            const rays  = document.createElementNS(svgNS, 'svg');
            rays.id = 'season-sun-rays';
            rays.setAttribute('width','90'); rays.setAttribute('height','90');
            rays.setAttribute('viewBox','0 0 90 90'); rays.setAttribute('fill','none');

            const addCircle = (r, stroke, dash) => {
                const c = document.createElementNS(svgNS,'circle');
                c.setAttribute('cx','45'); c.setAttribute('cy','45'); c.setAttribute('r', r);
                c.setAttribute('stroke', stroke); c.setAttribute('stroke-width','2');
                c.setAttribute('stroke-dasharray', dash);
                rays.appendChild(c);
            };
            addCircle('42','rgba(251,191,36,.35)','6 6');
            addCircle('32','rgba(251,191,36,.25)','4 8');
            for (let k = 0; k < 12; k++) {
                const a  = k * 30 * Math.PI / 180;
                const ln = document.createElementNS(svgNS,'line');
                ln.setAttribute('x1', 45 + 38 * Math.cos(a));
                ln.setAttribute('y1', 45 + 38 * Math.sin(a));
                ln.setAttribute('x2', 45 + 44 * Math.cos(a));
                ln.setAttribute('y2', 45 + 44 * Math.sin(a));
                ln.setAttribute('stroke','rgba(251,191,36,.5)');
                ln.setAttribute('stroke-width','2');
                ln.setAttribute('stroke-linecap','round');
                rays.appendChild(ln);
            }
            sun.appendChild(rays);

            const core = document.createElement('div');
            core.id = 'season-sun-core';
            Object.assign(core.style, {
                position:'absolute', top:'50%', left:'50%',
                width:'32px', height:'32px',
                transform:'translate(-50%,-50%)',
                background:'radial-gradient(circle, #FDE68A 40%, #FBBF24 100%)',
                borderRadius:'50%',
                boxShadow:'0 0 20px rgba(251,191,36,.6),0 0 40px rgba(251,191,36,.3)'
            });
            sun.appendChild(core);
            hero.appendChild(sun);
        }
    }

    /* ─── Été : tournesols footer ───────────────────────── */
    if (season === 'summer') {
        const footer = document.querySelector('footer');
        if (footer) {
            const flowerBar = document.createElement('div');
            flowerBar.setAttribute('aria-hidden', 'true');
            flowerBar.style.cssText = `
                position:absolute;bottom:0;left:0;right:0;
                display:flex;align-items:flex-end;justify-content:space-around;
                padding:0 5%;pointer-events:none;overflow:hidden;height:80px;`;

            /* Safe: all SVG attributes are numeric constants — no user input */
            const makeSunflower = (h, delay) => {
                const svg = document.createElementNS(svgNS, 'svg');
                svg.classList.add('footer-flower');
                svg.setAttribute('viewBox','0 0 40 70');
                svg.setAttribute('fill','none');
                svg.setAttribute('aria-hidden','true');
                svg.style.height = h + 'px';
                svg.style.animationDelay = delay + 's';

                const addEl = (tag, attrs) => {
                    const el = document.createElementNS(svgNS, tag);
                    Object.entries(attrs).forEach(([k, v]) => el.setAttribute(k, v));
                    svg.appendChild(el);
                };
                /* tige */
                addEl('rect',{x:'18',y:'30',width:'4',height:'40',rx:'2',fill:'#4ADE80'});
                /* feuille */
                addEl('ellipse',{cx:'12',cy:'48',rx:'9',ry:'5',fill:'#22C55E',transform:'rotate(-30 12 48)'});
                /* pétales */
                for (let k = 0; k < 8; k++) {
                    addEl('ellipse',{cx:'20',cy:'20',rx:'5',ry:'10',fill:'#FBBF24',
                        transform:`rotate(${k*45} 20 20) translate(0 -14)`,opacity:'.9'});
                }
                /* cœur */
                addEl('circle',{cx:'20',cy:'20',r:'9',fill:'#92400E'});
                addEl('circle',{cx:'20',cy:'20',r:'6',fill:'#78350F'});
                /* graines */
                [{cx:'17',cy:'18'},{cx:'20',cy:'17'},{cx:'23',cy:'18'},{cx:'22',cy:'21'},{cx:'18',cy:'22'}]
                    .forEach(p => addEl('circle',{...p,r:'1.2',fill:'#FDE68A'}));
                return svg;
            };

            [[60,0],[72,.4],[55,.8],[68,1.2],[62,.6]].forEach(([h, delay]) => {
                flowerBar.appendChild(makeSunflower(h, delay));
            });

            footer.style.position = 'relative';
            footer.style.paddingBottom = 'calc(80px + 4rem)'; /* espace pour les fleurs */
            footer.appendChild(flowerBar);
        }
    }
})();
</script>
@endpush

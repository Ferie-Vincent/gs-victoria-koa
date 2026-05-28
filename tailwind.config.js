/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ['"Baloo 2"', 'cursive'],
        body:    ['Nunito', 'sans-serif'],
      },
      colors: {
        primary:   '#7C3AED',
        'primary-light': '#A78BFA',
        secondary: '#F59E0B',
        accent: {
          pink:   '#EC4899',
          teal:   '#14B8A6',
          orange: '#F97316',
          green:  '#22C55E',
        },
        dark:      '#1E1B4B',
        'logo-glow': '#A855F7',
        'logo-deep': '#5B1A8A',
      },
      borderRadius: {
        '4xl': '2rem',
      },
      boxShadow: {
        violet: '0 10px 40px rgba(124, 58, 237, 0.2)',
        yellow: '0 10px 40px rgba(245, 158, 11, 0.2)',
        pink:   '0 10px 40px rgba(236, 72, 153, 0.2)',
        teal:   '0 10px 40px rgba(20, 184, 166, 0.2)',
      },
    },
  },
  plugins: [],
  safelist: [
    // scroll-top button — classes ajoutées dynamiquement via classList.add() en JS
    'opacity-100',
    'translate-y-0',
    // Témoignages : bg_color stocké en DB — valeurs possibles
    'bg-teal-500',
    'bg-violet-600',
    'bg-amber-500',
    'bg-pink-500',
    'bg-blue-600',
    'bg-orange-500',
    // Actualités : badge_bg stocké en DB — valeurs possibles
    'bg-orange-500',
    'bg-teal-600',
    'bg-pink-500',
    'bg-amber-500',
  ],
};

# CLAUDE.md — Groupe Scolaire VICTORIA-KOA

> **Fichier lu en priorité absolue par tout agent IA avant toute tâche.**
> Contient le contexte projet, les conventions, les contraintes, et le workflow BMAD.

---

## 🏫 Identité du projet

Site web **chaleureux et familial** du **Groupe Scolaire VICTORIA-KOA**, école maternelle et primaire à **Angré 9ème Tranche, Abidjan (Côte d'Ivoire)**.

**Ce que ce site n'est PAS :** un site institutionnel froid.
**Ce que ce site EST :** une présence web accueillante, colorée et joyeuse qui donne envie aux parents d'inscrire leurs enfants. Le ton est familial, bienveillant, enthousiaste. L'école est un deuxième foyer.

**Objectif principal :** Informer les parents (classes, horaires, fournitures, calendrier), inspirer confiance et faciliter les inscriptions.

---

## 🛠️ Stack technique (FTP-compatible)

> ⚠️ **Contrainte critique :** Hébergement mutualisé avec **accès FTP uniquement**. Pas de SSH, pas de Docker. Toutes les commandes build/install se font **en local** avant upload FTP.

| Couche | Technologie | Raison |
|---|---|---|
| Backend | **Laravel 12** (PHP 8.2+) | Framework PHP robuste, routes propres |
| Templates | **Blade** (natif Laravel) | Pas de build JS côté serveur requis |
| Interactivité | **Alpine.js v3** (CDN) | Légère, déclarative, zéro build |
| Style | **Tailwind CSS v3** (compilé en local) | Utility-first, design system cohérent |
| Animations scroll | **AOS v2** (CDN) | Animate On Scroll, zéro config |
| Slider | **Swiper.js v11** (CDN) | Témoignages + galerie |
| Lightbox | **GLightbox** (CDN) | Galerie photos |
| Icônes | **Heroicons** (inline SVG) | Léger, personnalisable |
| Polices | **Google Fonts** (CDN) | Nunito + Baloo 2 |
| Formulaire | **Laravel Mail** | Contact form vers direction@gsvictoriakoa.ci |
| PDF | Fichiers statiques `public/documents/` | Simples liens téléchargement |
| Maps | Google Maps iframe embed | Aucune API key nécessaire |

### Ce qui a changé vs version précédente

| Avant (❌ incompatible FTP) | Après (✅ compatible FTP) |
|---|---|
| Laravel 11 | Laravel 12 |
| React 18 + Inertia.js | Blade natif |
| Framer Motion | AOS + transitions CSS + Alpine.js |
| TypeScript + TSX | PHP Blade + Alpine.js |
| Vite build React | Vite build CSS uniquement (Tailwind) |

---

## ⚡ Workflow développement local

```bash
# Setup initial (une seule fois)
composer create-project laravel/laravel victoria-koa
cd victoria-koa
npm install

# Développement quotidien
php artisan serve          # Serveur Laravel local → http://127.0.0.1:8000
npm run dev                # Vite watch → compile Tailwind en live

# Avant chaque déploiement FTP
npm run build              # Génère public/build/ (CSS optimisé)
composer install --no-dev --optimize-autoloader
```

---

## 🚀 Déploiement FTP (procédure complète)

> Hébergement mutualisé, pas de SSH disponible.

### Préparer en local
```bash
npm run build
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Uploader via FTP
- **Tout le projet** sauf : `.env`, `node_modules/`, `.git/`
- **Inclure** : `vendor/`, `public/build/`, `storage/` (dossier vide avec `.gitkeep`)

### Config serveur (via cPanel / gestionnaire de fichiers)
1. Créer `.env` directement sur le serveur (copier `.env.example`, ajuster valeurs)
2. `APP_KEY` : générer localement avec `php artisan key:generate --show` et coller
3. `storage/` et `bootstrap/cache/` : chmod 775
4. Pointer le document root vers `public/`
5. **Storage link** : créer manuellement le symlink `public/storage → ../storage/app/public` via cPanel File Manager, ou utiliser un script PHP temporaire :
   ```php
   // deploy_helper.php (à supprimer après usage !)
   <?php symlink('../storage/app/public', 'storage'); echo 'OK';
   ```

---

## 📁 Structure du projet

```
victoria-koa/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ClassesController.php
│   │   ├── HorairesController.php
│   │   ├── FournituresController.php
│   │   ├── CalendrierController.php
│   │   ├── InscriptionController.php
│   │   ├── GalleriesController.php
│   │   ├── ActualitesController.php
│   │   └── ContactController.php
│   └── Mail/
│       └── ContactFormMail.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php          ← Layout principal
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── phone-button.blade.php
│   │   │   ├── page-banner.blade.php
│   │   │   ├── section-title.blade.php
│   │   │   └── blob-shape.blade.php
│   │   ├── home/
│   │   │   ├── hero.blade.php
│   │   │   ├── welcome.blade.php
│   │   │   ├── values.blade.php
│   │   │   ├── activities.blade.php
│   │   │   ├── enrollment-cta.blade.php
│   │   │   ├── stats.blade.php
│   │   │   ├── classes-preview.blade.php
│   │   │   ├── how-to-enroll.blade.php
│   │   │   ├── testimonials.blade.php
│   │   │   ├── recent-news.blade.php
│   │   │   └── contact-form.blade.php
│   │   └── pages/
│   │       ├── home.blade.php
│   │       ├── about.blade.php
│   │       ├── classes.blade.php
│   │       ├── horaires.blade.php
│   │       ├── fournitures.blade.php
│   │       ├── calendrier.blade.php
│   │       ├── inscription.blade.php
│   │       ├── galleries.blade.php
│   │       ├── actualites.blade.php
│   │       └── contact.blade.php
│   ├── css/
│   │   └── app.css                    ← Tailwind directives + custom CSS
│   └── js/
│       └── app.js                     ← Alpine.js init + AOS init + Swiper
├── public/
│   ├── documents/                     ← PDFs (voir structure ci-dessous)
│   └── images/
│       ├── logo.png
│       └── hero/
├── routes/
│   └── web.php
└── docs/                              ← Documentation BMAD
    ├── prd.md
    ├── architecture.md
    ├── DESIGN_SYSTEM.md
    ├── COMPONENTS.md
    ├── agents/
    │   └── README.md
    ├── stories/
    │   ├── EPIC-01-layout-global.md
    │   ├── EPIC-02-homepage.md
    │   ├── EPIC-03-pages-contenu.md
    │   ├── EPIC-04-contact-formulaire.md
    │   └── EPIC-05-galleries-actualites.md
    └── pages/
        ├── HOME.md
        └── SECONDARY_PAGES.md
```

---

## 🗺️ Routes (routes/web.php)

```php
Route::get('/',                    [HomeController::class,       'index'])->name('home');
Route::get('/a-propos',            [AboutController::class,      'index'])->name('about');
Route::get('/les-classes',         [ClassesController::class,    'index'])->name('classes');
Route::get('/les-horaires',        [HorairesController::class,   'index'])->name('horaires');
Route::get('/fournitures-scolaires',[FournituresController::class,'index'])->name('fournitures');
Route::get('/calendrier-scolaire', [CalendrierController::class, 'index'])->name('calendrier');
Route::get('/inscription',         [InscriptionController::class,'index'])->name('inscription');
Route::get('/galleries',           [GalleriesController::class,  'index'])->name('galleries');
Route::get('/actualites',          [ActualitesController::class, 'index'])->name('actualites');
Route::get('/contact',             [ContactController::class,    'index'])->name('contact');
Route::post('/contact',            [ContactController::class,    'send'])->name('contact.send');
```

---

## 🧩 Conventions de code

### Blade
- Layout principal : `@extends('layouts.app')` dans chaque page
- Composants réutilisables : `@include('components.xxx')` ou `<x-xxx />`
- Variables passées depuis le controller : `return view('pages.home', compact('data'))`
- Nommage vues : **kebab-case** (ex : `classes-preview.blade.php`)

### Alpine.js
- Déclaratif dans le HTML avec `x-data`, `x-show`, `x-bind`, `@event`
- Composants Alpine complexes définis dans `resources/js/app.js` via `Alpine.data('nom', () => {...})`
- Pas de build JS nécessaire pour les modifications simples (Alpine chargé depuis CDN)

### Tailwind CSS
- Variables CSS dans `resources/css/app.css`
- Compilation locale : `npm run build` avant FTP upload
- Classes utilitaires Tailwind en priorité sur CSS custom
- Responsive : `sm:` (640px) `md:` (768px) `lg:` (1024px) `xl:` (1280px)
- Arrondi minimum : `rounded-2xl` partout

### AOS (Animate On Scroll)
- Attributs HTML : `data-aos="fade-up"`, `data-aos-delay="100"`, `data-aos-duration="600"`
- Init dans `app.js` : `AOS.init({ once: true, offset: 100 })`
- Variantes : `fade-up`, `fade-right`, `fade-left`, `zoom-in`

---

## 📂 Structure PDFs (public/documents/)

```
public/documents/
├── fournitures/
│   ├── TPS-2025-2026.pdf
│   ├── PS-2025-2026.pdf
│   ├── MS-2025-2026.pdf
│   ├── GS-2025-2026.pdf
│   ├── CP-2025-2026.pdf
│   ├── CE1-2025-2026.pdf
│   ├── CE2-2025-2026.pdf
│   ├── CM1-2025-2026.pdf
│   └── CM2-2025-2026.pdf
├── inscriptions/
│   ├── fiche-inscription-maternelle-2025-2026.pdf
│   ├── fiche-inscription-primaire-2025-2026.pdf
│   ├── fiche-medicale.pdf
│   └── certificat-vaccination.pdf
└── calendrier/
    └── calendrier-scolaire-2025-2026.pdf
```

URL publique : `/documents/fournitures/TPS-2025-2026.pdf`

---

## 📞 Informations de l'école

| Info | Valeur |
|---|---|
| **Nom** | Groupe Scolaire VICTORIA-KOA |
| **Adresse** | Angré 9ème Tranche CNPS en haut, face Pâtisserie MARY'S, Abidjan |
| **GPS** | 92HH+H98, Voie Djibi, Abidjan |
| **Tél 1** | (+225) 07 67 48 55 94 |
| **Tél 2** | (+225) 01 43 23 84 82 |
| **Email direction** | direction@gsvictoriakoa.ci |
| **Email secondaire** | victoria-koa1965@gemail.com |
| **Facebook** | facebook.com/CM.VICTORIA.KOA/ |
| **Niveaux** | Maternelle : TPS, PS, MS, GS — Primaire : CP1, CP2, CE1, CE2, CM1, CM2 |

---

## 🤖 Workflow BMAD (Agents IA)

> Ce projet utilise la méthode **BMAD** (Breakthrough Method for Agile AI-Driven Development) pour orchestrer le travail des agents IA.

### Ordre de lecture des docs pour un agent
1. `CLAUDE.md` ← tu es ici (contexte global)
2. `docs/prd.md` ← exigences produit
3. `docs/architecture.md` ← décisions techniques
4. `docs/DESIGN_SYSTEM.md` ← palette, typo, animations
5. `docs/COMPONENTS.md` ← spec des composants Blade
6. `docs/pages/HOME.md` ou `docs/pages/SECONDARY_PAGES.md` ← contenu des pages
7. `docs/stories/EPIC-XX-xxx.md` ← story à implémenter

### Rôles des agents
| Agent | Responsabilité |
|---|---|
| **Orchestrateur** | Lit le PRD, sélectionne la prochaine story, assigne à l'agent |
| **Dev Frontend** | Implémente les vues Blade + Alpine.js + CSS |
| **Dev Backend** | Implémente les Controllers, Mail, routes |
| **QA** | Vérifie l'implémentation contre les critères d'acceptation |

### Règle critique pour tous les agents
- **Toujours vérifier** la story dans `docs/stories/` avant de coder
- **Ne jamais dévier** du design system sans mettre à jour `docs/DESIGN_SYSTEM.md`
- **Marquer la story** comme `[x] Done` après implémentation
- **Un agent = une story** — ne pas chevaucher les travaux

### Documentation BMAD complète → `docs/agents/README.md`

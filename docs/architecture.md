# Architecture technique — Groupe Scolaire VICTORIA-KOA

> **Décisions techniques définitives.** Tout agent IA doit respecter ces choix.
> Modifier ce fichier si une décision change, et justifier le changement.

---

## ⚠️ Contrainte principale : Hébergement FTP-only

L'école dispose d'un **hébergement mutualisé avec accès FTP uniquement**.

| Contrainte | Impact |
|---|---|
| Pas de SSH | Pas d'`artisan` ni `composer` sur le serveur |
| Pas de Docker | Stack serveur fixe (PHP + MySQL) |
| Pas de Node.js en production | Build Vite/Tailwind uniquement en local |
| FTP seul | Upload fichier par fichier ou par zip |

**Conséquence directe :** Toute technologie nécessitant un serveur Node.js ou une compilation en production est **exclue**. React + Inertia.js → éliminé.

---

## 🏗️ Décisions d'architecture

### ADR-01 — Framework backend : Laravel 12

**Décision :** Laravel 12 (PHP 8.2+)

**Raisons :**
- Routing propre, URL lisibles (`/les-classes`, `/inscription`)
- Blade = templates PHP natifs, zero build côté serveur
- Formulaire de contact + validation + envoi mail : trivial avec Laravel
- Déploiement : uploader `vendor/` (build local) puis FTP

**Alternative rejetée :** WordPress — trop lourd, base de données complexe, vulnérabilités.

---

### ADR-02 — Frontend : Blade + Alpine.js (pas de React)

**Décision :** Blade templates + Alpine.js v3 (CDN)

**Raisons :**
- Blade = PHP pur, aucun build JS pour les vues
- Alpine.js via CDN = zéro dépendance, zéro build
- Interactivité suffisante (dropdown, mobile menu, compteurs, transitions)
- Modifications possibles directement dans les `.blade.php` sans relancer Vite

**Alternative rejetée :** React + Inertia.js — nécessite Node.js en développement, build non déployable sur hébergement sans SSH.

---

### ADR-03 — CSS : Tailwind compilé en local

**Décision :** Tailwind CSS v3, compilé localement avec Vite, CSS uploadé via FTP

**Workflow :**
1. `npm run build` → génère `public/build/app.css` (Tailwind purgé + minifié)
2. FTP upload de `public/build/`
3. Le serveur sert le CSS statique compilé

**Alternative rejetée :** Tailwind CDN Play — ne purge pas les classes, fichier CSS 3MB+.

---

### ADR-04 — Animations : AOS (Animate On Scroll)

**Décision :** AOS v2 via CDN (`unpkg.com/aos`)

**Raisons :**
- Zéro build, zéro config serveur
- Attributs HTML simples (`data-aos="fade-up"`)
- Léger (11KB gzip)
- Suffisant pour fadeIn/slideUp au scroll

**Alternative rejetée :** Framer Motion — bibliothèque React uniquement.

---

### ADR-05 — Slider : Swiper.js CDN

**Décision :** Swiper.js v11 via CDN (témoignages)

**Raisons :** Mature, accessible, mobile-first.

---

### ADR-06 — Lightbox : GLightbox CDN

**Décision :** GLightbox v3 via CDN (galerie photos)

**Raisons :** Léger, accessible, zero dépendance.

---

### ADR-07 — PDFs : fichiers statiques dans `public/documents/`

**Décision :** PDFs dans `public/documents/` (pas dans `storage/`)

**Raisons :**
- Sur hébergement mutualisé, `php artisan storage:link` n'est pas garanti
- `public/documents/` est accessible directement sans symlink
- Upload FTP direct dans le bon dossier

**URL pattern :** `/documents/fournitures/TPS-2025-2026.pdf`

---

### ADR-08 — Base de données : MySQL (minimal)

**Décision :** MySQL fourni par l'hébergeur (cPanel). Utilisé uniquement si nécessaire pour les actualités ou la galerie. En v1, les données sont **hardcodées dans les vues Blade**.

**Raisons :**
- Pas de `php artisan migrate` disponible sans SSH → utiliser cPanel phpMyAdmin si besoin
- Site vitrine : les données changent rarement
- Simplifier le déploiement v1

**Migration vers DB dynamique :** possible en v2 si l'école veut gérer les actualités via un admin.

---

## 🗂️ Structure des dossiers clés

```
victoria-koa/
├── app/Http/Controllers/          ← 10 controllers (GET) + ContactController (GET + POST)
├── app/Mail/ContactFormMail.php   ← Envoi email formulaire contact
├── resources/
│   ├── views/                     ← Toutes les vues Blade
│   ├── css/app.css                ← Tailwind directives + variables CSS + animations custom
│   └── js/app.js                  ← Alpine.data() + AOS.init() + Swiper init
├── public/
│   ├── documents/                 ← PDFs (accès direct sans symlink)
│   ├── images/                    ← Images optimisées (WebP recommandé)
│   └── build/                     ← Généré par Vite (CSS compilé)
├── routes/web.php                 ← 11 routes (10 GET + 1 POST)
└── docs/                          ← Documentation BMAD
```

---

## 🚀 Procédure de déploiement FTP

### Pré-requis serveur
- PHP 8.2+ avec extensions : `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`
- MySQL 5.7+ (pour v2)
- `.htaccess` supporté (mod_rewrite activé)

### Checklist déploiement

```
[ ] 1. npm run build           → public/build/ généré
[ ] 2. composer install --no-dev --optimize-autoloader
[ ] 3. FTP upload : tout sauf .env, node_modules/, .git/
[ ] 4. Créer .env sur le serveur (copier .env.example)
[ ] 5. APP_KEY : générer en local (php artisan key:generate --show) → coller dans .env
[ ] 6. APP_ENV=production, APP_DEBUG=false dans .env
[ ] 7. chmod 775 : storage/, bootstrap/cache/
[ ] 8. Document root → pointer vers public/
[ ] 9. Tester : /  /contact  /documents/fournitures/TPS-2025-2026.pdf
```

### `.env` minimum pour production
```env
APP_NAME="GS VICTORIA-KOA"
APP_ENV=production
APP_KEY=base64:XXXXX
APP_DEBUG=false
APP_URL=https://www.gsvictoriakoa.ci

MAIL_MAILER=smtp
MAIL_HOST=smtp.hosteur.com   # à adapter selon l'hébergeur
MAIL_PORT=587
MAIL_USERNAME=direction@gsvictoriakoa.ci
MAIL_PASSWORD=SECRET
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=direction@gsvictoriakoa.ci
MAIL_FROM_NAME="GS VICTORIA-KOA"
```

---

## 🔒 Sécurité

| Mesure | Implémentation |
|---|---|
| CSRF | `@csrf` dans tous les formulaires (Laravel natif) |
| XSS | `{{ }}` Blade échappe automatiquement |
| Validation formulaire | `$request->validate([...])` dans ContactController |
| Rate limiting | `Route::middleware('throttle:10,1')` sur la route POST contact |
| `.env` protégé | Ne jamais uploader `.env` via FTP — créer directement sur serveur |
| `APP_DEBUG=false` | Obligatoire en production |

---

## 📈 Performance

| Optimisation | Méthode |
|---|---|
| Images | WebP, max 200KB/image, lazy loading natif HTML |
| CSS | Tailwind purgé par Vite (≈ 15-30KB en prod) |
| JS | Alpine.js CDN (15KB gzip), chargé en `defer` |
| Fonts | `rel="preconnect"` + `display=swap` |
| Cache Laravel | `php artisan view:cache` + `config:cache` + `route:cache` (si SSH disponible) |
| Pas de JS inutile | Pas de jQuery, pas de Bootstrap JS |

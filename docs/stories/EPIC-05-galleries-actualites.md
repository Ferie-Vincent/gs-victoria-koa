# EPIC-05 — Galerie & Actualités

> **Priorité :** 🟡 Normale (valorise la vie scolaire)
> **Agent :** Dev Frontend + Dev Backend
> **Dépend de :** EPIC-01 (layout terminé)

---

## Story 5.1 — Page Galerie Photos
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/galleries.blade.php`
- `app/Http/Controllers/GalleriesController.php`

**Critères d'acceptation :**
- [ ] Banner "Nos Galeries"
- [ ] Description intro (voir SECONDARY_PAGES.md)
- [ ] Filtres par catégorie (Alpine.js) : Toutes · Activités · Événements · Classes · Sorties
  ```html
  <div x-data="{ active: 'all' }" class="flex flex-wrap gap-3 justify-center mb-8">
    <button @click="active = 'all'" :class="active === 'all' ? 'bg-primary text-white' : 'bg-white'" class="px-4 py-2 rounded-full border transition-all">Toutes</button>
    <!-- ... autres catégories -->
  </div>
  ```
- [ ] Grille photos `grid-cols-2 md:grid-cols-3 lg:grid-cols-4`
- [ ] Chaque photo : `<a href="..." class="glightbox ...">` + `data-gallery="gallery-main"`
- [ ] Hover : `group-hover:scale-110 transition-transform duration-500`
- [ ] `data-aos="zoom-in"` avec délais décalés par tranche de 4
- [ ] GLightbox initialisé dans `app.js`
- [ ] Si aucune photo : message "Les photos arrivent bientôt ! 📸"

**Controller (v1 avec images statiques) :**
```php
public function index()
{
    // En v1 : photos statiques depuis public/images/gallery/
    // En v2 : depuis la base de données
    $photos = collect(glob(public_path('images/gallery/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))
        ->map(fn($path) => [
            'src'      => '/images/gallery/' . basename($path),
            'thumb'    => '/images/gallery/' . basename($path),
            'alt'      => 'Photo de l\'école VICTORIA-KOA',
            'category' => 'all',
        ])->values()->toArray();

    return view('pages.galleries', compact('photos'));
}
```

---

## Story 5.2 — Page Actualités
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/actualites.blade.php`
- `app/Http/Controllers/ActualitesController.php`

**Critères d'acceptation :**
- [ ] Banner "Actualités"
- [ ] Description intro
- [ ] Filtres par catégorie (Alpine.js) : Tous · Animation · Créatif · Création · Non classé
- [ ] Grid articles `grid-cols-1 md:grid-cols-2 lg:grid-cols-3`
- [ ] Chaque card article : image 16:9 `rounded-2xl`, badge catégorie overlay, date, titre, bouton "Lire →"
- [ ] Hover card : `hover:-translate-y-1 hover:shadow-violet transition-all duration-300`
- [ ] Hover image : `group-hover:scale-105 transition-transform duration-500`
- [ ] Filtres Alpine.js (masquer/afficher avec `x-show` selon catégorie active)
- [ ] `data-aos="fade-up"` avec délais 0/100/200 par ligne

**Controller (v1 avec articles hardcodés) :**
```php
public function index()
{
    $articles = [
        [
            'id'       => 1,
            'title'    => 'Galette des rois',
            'category' => 'Animation',
            'date'     => '9 avril 2023',
            'image'    => '/images/news/placeholder.jpg',
            'excerpt'  => 'Un moment de partage et de convivialité pour nos élèves...',
        ],
        [
            'id'       => 2,
            'title'    => 'Sortie au musée',
            'category' => 'Créatif',
            'date'     => '9 avril 2023',
            'image'    => '/images/news/placeholder.jpg',
            'excerpt'  => 'Découverte du patrimoine culturel ivoirien avec nos élèves...',
        ],
    ];

    return view('pages.actualites', compact('articles'));
}
```

---

## Story 5.3 — Images placeholder et assets de base
**Statut :** `[ ] Todo`

**Description :** S'assurer que les dossiers d'images existent avec des fichiers placeholder.

**Critères d'acceptation :**
- [ ] `public/images/` existe
- [ ] `public/images/gallery/` existe (même vide avec `.gitkeep`)
- [ ] `public/images/news/placeholder.jpg` : image colorée générique (1200×675px minimum)
- [ ] `public/images/hero/illustration.svg` : illustration SVG enfants ou placeholder coloré
- [ ] `public/documents/` existe avec sous-dossiers `fournitures/`, `inscriptions/`, `calendrier/`
- [ ] Chaque dossier PDF a un fichier `README.txt` ou `.gitkeep` pour indiquer où placer les PDFs

**Note pour les PDFs :**
> Les PDFs réels seront fournis par l'école. En attendant, les liens pointent vers les bons chemins mais les fichiers n'existent pas encore. Ajouter un gestionnaire 404 pour les PDFs manquants affichant un message "Document en cours de préparation".

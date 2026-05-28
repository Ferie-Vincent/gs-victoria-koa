# EPIC-02 — Homepage

> **Priorité :** 🔴 Critique (page principale du site)
> **Agent :** Dev Frontend
> **Dépend de :** EPIC-01 (layout global terminé)
> **Référence contenu :** `docs/pages/HOME.md`

---

## Story 2.1 — Hero Section
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/hero.blade.php`

**Critères d'acceptation :**
- [ ] Section `min-h-screen` avec `.bg-hero` (gradient violet → rose)
- [ ] Overlay SVG pointillés blancs opacity 0.1
- [ ] Bulles flottantes (`@include('components.floating-bubbles')`)
- [ ] Layout 2 colonnes (`lg:grid-cols-2`) : texte gauche, illustration droite
- [ ] Titre H1 "Bienvenue à" (blanc, Baloo 2 extrabold)
- [ ] Span "VICTORIA-KOA" couleur `#F59E0B` (jaune)
- [ ] 2 paragraphes descriptifs (voir HOME.md §1)
- [ ] Bouton principal "En savoir plus →" (fond blanc, texte violet, `rounded-full`)
- [ ] Bouton secondaire "Nous contacter" (outlined blanc, `rounded-full`)
- [ ] Indication scroll (chevron bas animé en CSS `bounce`)
- [ ] Nuages SVG animés (CSS `translateX` infini)
- [ ] Mobile : illustration en haut, texte en bas (ou texte seul)
- [ ] Illustration placeholder SVG ou image `public/images/hero/illustration.svg`

---

## Story 2.2 — Section Mot de Bienvenue
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/welcome.blade.php`

**Critères d'acceptation :**
- [ ] Fond `#FEFCE8` (crème)
- [ ] Layout 2 colonnes : image/logo gauche, texte droite
- [ ] `@include('components.section-title', ['title' => 'Mot de Bienvenue sur le site', 'align' => 'left'])`
- [ ] 6 paragraphes du mot de bienvenue (voir HOME.md §2) avec étoile colorée avant chaque
- [ ] Trait coloré 60px sous le titre (violet, `rounded-full`, h-1)
- [ ] `data-aos="fade-right"` sur la colonne image, `data-aos="fade-left"` sur le texte

---

## Story 2.3 — Section Nos Valeurs
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/values.blade.php`

**Critères d'acceptation :**
- [ ] Fond gradient lavande `#F5F3FF`
- [ ] `@include('components.section-title', ['title' => 'Nos Valeurs', 'align' => 'center'])`
- [ ] 3 cards en `grid grid-cols-1 md:grid-cols-3`
- [ ] Card 1 : ⚡ "Le Dynamisme" (violet), Card 2 : 🎯 "La Persévérance" (jaune), Card 3 : 🤝 "L'Esprit d'Équipe" (turquoise)
- [ ] Chaque card : fond blanc, `rounded-3xl`, ombre colorée selon thème
- [ ] Icône dans cercle coloré en haut
- [ ] Hover : `hover:-translate-y-2 hover:shadow-violet transition-all duration-300`
- [ ] `data-aos="fade-up"` avec `data-aos-delay` 0/100/200

**Contenu :** voir `docs/pages/HOME.md` §3

---

## Story 2.4 — Section Nos Activités
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/activities.blade.php`

**Critères d'acceptation :**
- [ ] Fond blanc avec blob violet transparent en background
- [ ] Titre + sous-titre centrés (voir HOME.md §4)
- [ ] 5 badges colorés géants : 💃 Danse, 🥋 Karaté, 🎹 Piano, 🏊 Natation, 🎭 Théâtre
- [ ] Chaque badge : fond coloré doux, texte foncé, `rounded-full`, grande taille, `px-6 py-3`
- [ ] Flex wrap centré pour les badges
- [ ] `data-aos="zoom-in"` avec délais croissants sur chaque badge
- [ ] Texte CTA + bouton "Cliquez ici →" → `/inscription`

---

## Story 2.5 — CTA Inscription
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/enrollment-cta.blade.php`

**Critères d'acceptation :**
- [ ] Fond gradient violet → indigo (`bg-hero`)
- [ ] Titre + sous-titre blancs centrés (voir HOME.md §5)
- [ ] 2 cards blanches côte à côte (`rounded-2xl`)
- [ ] Card 1 : Fiche Maternelle (TPS, PS, MS, GS) + bouton "⬇ Télécharger"
- [ ] Card 2 : Fiche Primaire (CP1→CM2) + bouton "⬇ Télécharger"
- [ ] Liens PDF : `href="/documents/inscriptions/fiche-inscription-maternelle-2025-2026.pdf"` (etc.)
- [ ] Attributs `download` et `target="_blank"` sur les liens PDF

---

## Story 2.6 — Section Nos Chiffres (Stats)
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/stats.blade.php`

**Critères d'acceptation :**
- [ ] Fond `#FEF9C3` (jaune pâle)
- [ ] 4 colonnes `grid grid-cols-2 lg:grid-cols-4`
- [ ] Compteur animé Alpine.js + `x-intersect` sur chaque stat
- [ ] Stats : 10+ ans, 12 classes, 350+ élèves, 25 enseignants (voir HOME.md §6)
- [ ] Chiffre en Baloo 2 extrabold `text-5xl text-primary`
- [ ] Icône dans cercle coloré au-dessus
- [ ] `data-aos="fade-up"` sur chaque stat

**Référence Alpine.js :** `docs/DESIGN_SYSTEM.md` → section Compteur animé

---

## Story 2.7 — Aperçu Classes
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/classes-preview.blade.php`

**Critères d'acceptation :**
- [ ] Fond blanc
- [ ] Header : titre à gauche + lien "Voir toutes les classes →" à droite
- [ ] Grid `grid-cols-2 md:grid-cols-3 lg:grid-cols-5`
- [ ] 10 cards (TPS à CM2) avec code, nom, pastille cycle (violet/orange)
- [ ] Hover : fond coloré + apparition bouton "Voir fournitures →"
- [ ] `data-aos="fade-up"` avec délais décalés
- [ ] Séparateur visuel Maternelle / Primaire

**Données et couleurs :** voir `docs/COMPONENTS.md` → classes-preview

---

## Story 2.8 — Comment S'inscrire (Timeline)
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/how-to-enroll.blade.php`

**Critères d'acceptation :**
- [ ] Fond `#EDE9FE` (lavande)
- [ ] Titre "Comment inscrire votre enfant ?" centré
- [ ] Timeline 2 étapes avec ligne pointillée verticale (CSS border-dashed)
- [ ] Étape 1 : numéro dans cercle violet, titre, liste documents
- [ ] Étape 2 : numéro dans cercle jaune, titre, texte
- [ ] Bouton "Plus d'information →" → `/inscription`
- [ ] `data-aos="fade-up"` sur chaque étape

**Contenu :** voir `docs/pages/HOME.md` §8

---

## Story 2.9 — Témoignages (Swiper)
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/testimonials.blade.php`

**Critères d'acceptation :**
- [ ] Fond blanc
- [ ] Swiper.js avec classe `swiper-testimonials`
- [ ] Autoplay 4000ms, boucle, pagination points cliquables
- [ ] Breakpoints : 1 slide mobile, 2 tablette, 3 desktop
- [ ] 4 témoignages (voir COMPONENTS.md → home/testimonials.blade.php)
- [ ] Chaque card : guillemets décoratifs (violet opacity 0.15), 5 étoiles jaunes, avatar initiales coloré, nom + rôle

---

## Story 2.10 — Actualités Récentes
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/recent-news.blade.php`

**Critères d'acceptation :**
- [ ] Fond `#F5F3FF`
- [ ] Titre centré
- [ ] 2 cards articles côte à côte
- [ ] Chaque card : image 16:9, badge catégorie coloré, date, titre, "Lire →"
- [ ] Hover : zoom image + card lift (`hover:-translate-y-1`)
- [ ] Images : placeholders colorés si aucune photo disponible
- [ ] `data-aos="fade-up"` avec délais 0/100

**Données :** voir `docs/pages/HOME.md` §10

---

## Story 2.11 — Mini Formulaire de Contact
**Statut :** `[x] Done`

**Fichier :** `resources/views/home/contact-form.blade.php`

**Critères d'acceptation :**
- [ ] Fond gradient violet foncé + pattern pointillés SVG
- [ ] Titre "Nous contacter" + sous-titre blancs
- [ ] Card blanche centrée `max-w-lg rounded-3xl shadow-violet`
- [ ] Champs : name, email, phone (pas de textarea ici — mini formulaire)
- [ ] Bouton "✉ Envoyer le message" violet full-width `rounded-full`
- [ ] `@csrf` présent, `method="POST"`, `action="{{ route('contact.send') }}"`
- [ ] Message flash succès affiché si `session('success')`
- [ ] Erreurs de validation affichées si `$errors->any()`
- [ ] Adresse de l'école affichée sous la card (texte blanc)

**Référence :** `docs/COMPONENTS.md` → Formulaire de contact

---

## Story 2.12 — Page Home assemblée
**Statut :** `[x] Done`

**Fichier :** `resources/views/pages/home.blade.php`

**Critères d'acceptation :**
- [ ] `@extends('layouts.app')`
- [ ] `@section('title', 'Accueil')`
- [ ] Les 11 sections dans le bon ordre via `@include`
- [ ] Séparateurs blob SVG entre les sections au changement de fond (optionnel)
- [ ] Page se charge sans erreur

**Controller :**
```php
// HomeController.php
public function index() {
    return view('pages.home');
}
```

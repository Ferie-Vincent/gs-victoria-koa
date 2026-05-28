# EPIC-03 — Pages de contenu

> **Priorité :** 🟠 Haute (pages les plus consultées par les parents)
> **Agent :** Dev Frontend + Dev Backend
> **Dépend de :** EPIC-01 (layout terminé)
> **Référence contenu :** `docs/pages/SECONDARY_PAGES.md`

---

## Story 3.1 — Page Les Classes
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/classes.blade.php`
- `app/Http/Controllers/ClassesController.php`

**Critères d'acceptation :**
- [ ] `@include('components.page-banner', ['title' => 'Les classes', 'breadcrumb' => 'Accueil / Les classes'])`
- [ ] Bloc TPS : titre + icône 🌱, 3 paragraphes, box conseils fond jaune
- [ ] Sous-section "Espace d'Éveil Aménagé" : 4 paragraphes
- [ ] Bloc Maternelle : titre + icône 🌸, 2 paragraphes
- [ ] Bloc Élémentaire : titre + icône 🎓, texte intro + 2 features cards
- [ ] Réutilisation de la grille de classes (même data que `home/classes-preview`)
- [ ] CTA final : "Comment inscrire votre enfant ?" + bouton → `/inscription`
- [ ] Animations `data-aos` sur chaque bloc
- [ ] Controller retourne : `return view('pages.classes')`

**Contenu complet :** `docs/pages/SECONDARY_PAGES.md` → Classes.tsx

---

## Story 3.2 — Page Les Horaires
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/horaires.blade.php`
- `app/Http/Controllers/HorairesController.php`

**Critères d'acceptation :**
- [ ] Banner "Les horaires"
- [ ] Titre "Les horaires de cours" + sous-titre
- [ ] 2 cards côte à côte (`md:grid-cols-2`)
- [ ] Card 1 (fond violet clair) : 📅 Jours de cours, Lun/Mar/Jeu/Ven, 7h45–11h45 / 13h45–15h45, accueil dès 7h30
- [ ] Card 2 (fond gris clair) : 🌙 Jours sans cours, Mer/Sam/Dim, message repos
- [ ] `data-aos="fade-right"` card 1, `data-aos="fade-left"` card 2

**Contenu :** `docs/pages/SECONDARY_PAGES.md` → Horaires

---

## Story 3.3 — Page Fournitures Scolaires
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/fournitures.blade.php`
- `app/Http/Controllers/FournituresController.php`

**Critères d'acceptation :**
- [ ] Banner "Fournitures scolaires"
- [ ] Titre + sous-titre (voir SECONDARY_PAGES.md)
- [ ] Grid `grid-cols-1 md:grid-cols-2 lg:grid-cols-3`, 9 cards
- [ ] Chaque card : icône 🎒 dans cercle coloré, code niveau, nom complet, bouton "⬇ Télécharger"
- [ ] Liens PDF : `/documents/fournitures/XXX-2025-2026.pdf` avec `download` + `target="_blank"`
- [ ] Couleurs distinctes par niveau (voir COMPONENTS.md)
- [ ] `data-aos="fade-up"` avec délais croissants (0, 50, 100, 150…)
- [ ] Controller passe la liste des niveaux à la vue

```php
// FournituresController.php
public function index() {
    $levels = [
        ['code' => 'TPS', 'name' => 'Toute Petite Section',           'pdf' => 'TPS-2025-2026.pdf', 'color' => 'purple'],
        ['code' => 'PS',  'name' => 'Petite Section',                  'pdf' => 'PS-2025-2026.pdf',  'color' => 'violet'],
        ['code' => 'MS',  'name' => 'Moyenne Section',                 'pdf' => 'MS-2025-2026.pdf',  'color' => 'pink'],
        ['code' => 'GS',  'name' => 'Grande Section',                  'pdf' => 'GS-2025-2026.pdf',  'color' => 'yellow'],
        ['code' => 'CP',  'name' => 'Cours Préparatoire (CP1 & CP2)', 'pdf' => 'CP-2025-2026.pdf',   'color' => 'orange'],
        ['code' => 'CE1', 'name' => 'Cours Élémentaire 1ère année',   'pdf' => 'CE1-2025-2026.pdf',  'color' => 'teal'],
        ['code' => 'CE2', 'name' => 'Cours Élémentaire 2ème année',   'pdf' => 'CE2-2025-2026.pdf',  'color' => 'green'],
        ['code' => 'CM1', 'name' => 'Cours Moyen 1ère année',         'pdf' => 'CM1-2025-2026.pdf',  'color' => 'blue'],
        ['code' => 'CM2', 'name' => 'Cours Moyen 2ème année',         'pdf' => 'CM2-2025-2026.pdf',  'color' => 'red'],
    ];
    return view('pages.fournitures', compact('levels'));
}
```

---

## Story 3.4 — Page Calendrier Scolaire
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/calendrier.blade.php`
- `app/Http/Controllers/CalendrierController.php`

**Critères d'acceptation :**
- [ ] Banner "Calendrier scolaire"
- [ ] Bouton PDF en haut : "📥 Télécharger le calendrier complet 2025-2026" → `/documents/calendrier/calendrier-scolaire-2025-2026.pdf`
- [ ] Grand tableau stylisé (`rounded-3xl`, ombre colorée, fond blanc)
- [ ] Titre tableau "CALENDRIER SCOLAIRE 2025 – 2026" (Baloo 2, centré)
- [ ] 11 lignes du calendrier avec styles différents (RENTRÉE jaune, CLASSES violet, VACANCES orange)
- [ ] Box jours fériés fond orange doux `#FFF7ED` avec liste des jours fériés
- [ ] `data-aos="fade-up"` sur le tableau et la box

**Données complètes :** `docs/pages/SECONDARY_PAGES.md` → Calendrier

---

## Story 3.5 — Page Inscription
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/inscription.blade.php`
- `app/Http/Controllers/InscriptionController.php`

**Critères d'acceptation :**
- [ ] Banner "Inscription"
- [ ] Titre + sous-titre (voir SECONDARY_PAGES.md)
- [ ] BLOC 1 : 2 cards fiches renseignement côte à côte (Maternelle + Primaire)
- [ ] BLOC 2 : 3 cards documents supplémentaires (fiche inscription, médicale, vaccination)
- [ ] BLOC 3 : Timeline procédure (2 étapes, même style que `how-to-enroll`)
- [ ] Tous les liens PDF avec `download` + `target="_blank"`
- [ ] `data-aos` sur chaque bloc

---

## Story 3.6 — Page À propos
**Statut :** `[ ] Todo`

**Fichiers :**
- `resources/views/pages/about.blade.php`
- `app/Http/Controllers/AboutController.php`

**Critères d'acceptation :**
- [ ] Banner "À propos"
- [ ] Sections suggérées (développer librement) :
  - Notre histoire
  - Notre équipe
  - Notre pédagogie
  - Nos locaux
  - CTA Inscription
- [ ] Ton chaleureux et familial (pas de jargon administratif)
- [ ] `data-aos` sur chaque section
- [ ] Cohérence visuelle avec les autres pages

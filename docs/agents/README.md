# BMAD — Guide des agents IA

> **BMAD** (Breakthrough Method for Agile AI-Driven Development)
> Adapté au projet GS VICTORIA-KOA.

Ce fichier explique comment les agents IA doivent se comporter sur ce projet pour travailler de façon cohérente, précise et non-redondante.

---

## 🔁 Workflow général

```
1. LIRE  → CLAUDE.md + docs/prd.md + docs/architecture.md
2. CHOISIR → Une story non commencée dans docs/stories/
3. LIRE  → La story complète (contexte, critères d'acceptation)
4. LIRE  → Les docs de référence cités dans la story
5. CODER → Implémenter uniquement ce que la story demande
6. VÉRIFIER → Checklist dans la story
7. MARQUER → [x] Done dans la story + commit message clair
```

**Règle d'or :** Un agent implémente **une story à la fois**. Jamais plusieurs en parallèle sans coordination explicite.

---

## 👥 Rôles des agents

### 🎯 Agent Orchestrateur
**Quand l'utiliser :** Pour planifier le sprint, sélectionner la prochaine story à implémenter, résoudre un conflit entre agents.

**Responsabilités :**
- Lit le PRD et le statut de toutes les stories
- Décide quelle story traiter en priorité (dépendances, criticité)
- Délègue à l'agent approprié
- Vérifie la cohérence entre les livraisons

**Ne fait PAS de code directement.**

---

### 🎨 Agent Dev Frontend
**Quand l'utiliser :** Implémentation des vues Blade, composants, CSS, Alpine.js, animations AOS.

**Stack maîtrisée :**
- Laravel Blade (templates, `@extends`, `@include`, `@foreach`, `@if`)
- Alpine.js v3 (directives `x-data`, `x-show`, `x-bind`, `@event`, `x-transition`)
- Tailwind CSS v3 (classes utilitaires, config)
- AOS (attributs `data-aos`, config init)
- Swiper.js + GLightbox

**Docs de référence :**
- `docs/DESIGN_SYSTEM.md` ← couleurs, typo, animations
- `docs/COMPONENTS.md` ← spec des composants
- `docs/pages/HOME.md` ← contenu sections home
- `docs/pages/SECONDARY_PAGES.md` ← contenu pages secondaires

**Règles importantes :**
- Respecter le design system à la lettre (couleurs, arrondis, ombres)
- Utiliser `data-aos` et non `x-transition` pour les animations scroll
- Jamais de JavaScript vanilla hors Alpine.js (sauf Swiper/GLightbox)
- Images avec `loading="lazy"` partout
- Tout texte avec le bon ton (familial, chaleureux — voir PRD)

---

### ⚙️ Agent Dev Backend
**Quand l'utiliser :** Implémentation des Controllers, routes, Mail, validation, config Laravel.

**Stack maîtrisée :**
- Laravel 12 (routing, controllers, validation, Mail)
- Blade data passing (`return view('pages.home', compact('data'))`)
- Laravel Mail (ContactFormMail)
- `.env` et config

**Règles importantes :**
- Chaque Controller GET retourne une vue : `return view('pages.xxx', [...])`
- Validation stricte dans ContactController
- Rate limiting sur la route POST `/contact`
- Toujours vérifier que les chemins PDFs correspondent à `public/documents/`

---

### 🔍 Agent QA
**Quand l'utiliser :** Après implémentation d'une story, pour vérifier la conformité.

**Checklist systématique :**
```
[ ] La page se charge sans erreur (PHP, Blade)
[ ] Le design correspond au design system (couleurs, polices, arrondis)
[ ] Les animations AOS se déclenchent au scroll
[ ] Responsive : testé à 375px (mobile) et 1280px (desktop)
[ ] Tous les liens internes fonctionnent
[ ] Les PDFs sont téléchargeables
[ ] Le formulaire de contact valide et envoie
[ ] Pas de texte "institutionnel" — ton chaleureux partout
[ ] Accessibilité : images avec alt, boutons avec aria-label
[ ] Pas de console errors JavaScript
```

---

## 📂 Structure des stories

```
docs/stories/
├── EPIC-01-layout-global.md        ← Layout, Navbar, Footer, Phone button
├── EPIC-02-homepage.md             ← Les 11 sections de la homepage
├── EPIC-03-pages-contenu.md        ← Classes, Horaires, Fournitures, Calendrier, Inscription
├── EPIC-04-contact-formulaire.md   ← Page Contact + mini-formulaire home
└── EPIC-05-galleries-actualites.md ← Galerie photos + page Actualités
```

Chaque epic contient des **stories individuelles** avec :
- `[ ]` Todo / `[~]` En cours / `[x]` Done
- Description de ce qui est à faire
- Critères d'acceptation précis
- Références vers les docs de contenu

---

## 📋 Convention de commit

```
feat(navbar): implémente sticky scroll + dropdown Vie Scolaire
feat(hero): section hero avec bulles flottantes et CTA
feat(stats): compteurs animés Alpine.js + x-intersect
fix(contact): correction validation email
style(footer): ajustement couleurs colonnes
```

---

## 🔄 Mise à jour de ce fichier

Si un agent prend une **décision qui dévie de l'architecture**, il doit :
1. Mettre à jour `docs/architecture.md` avec un nouveau ADR numéroté
2. Expliquer la raison
3. Signaler le changement dans le commit message avec `[arch]`

---

## 💡 Conseils pour les agents

**Avant de coder :**
- Relire la section design du composant dans COMPONENTS.md
- Vérifier les couleurs exactes dans DESIGN_SYSTEM.md
- Vérifier le contenu textuel dans HOME.md ou SECONDARY_PAGES.md

**Pendant le code :**
- Écrire le Blade proprement, une section à la fois
- Alpine.js inline dans les attributs HTML pour les cas simples
- Alpine.data() dans app.js pour les composants complexes

**Après le code :**
- Relire les critères d'acceptation de la story
- Vérifier la cohérence avec les autres pages déjà implémentées
- Marquer `[x]` dans la story

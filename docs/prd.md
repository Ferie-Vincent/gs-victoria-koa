# PRD — Groupe Scolaire VICTORIA-KOA

> **Document :** Product Requirements Document
> **Version :** 1.0
> **Statut :** Approuvé — référence pour tous les agents IA

---

## 🎯 Vision

Offrir au Groupe Scolaire VICTORIA-KOA une **présence web chaleureuse, moderne et efficace** qui donne instantanément envie aux parents d'Abidjan d'inscrire leurs enfants.

Le site doit transmettre **3 émotions** en moins de 5 secondes :
1. **Confiance** — cette école est sérieuse et bienveillante
2. **Joie** — mes enfants y seront heureux
3. **Facilité** — toutes les infos sont là, l'inscription est simple

---

## 👨‍👩‍👧 Personas utilisateurs

### Persona 1 — Maman Adjoua (cible principale)
- Mère de 2 enfants (3 et 6 ans), Cocody, Abidjan
- Cherche une école proche, sérieuse, avec une bonne ambiance
- Visite le site sur **mobile** (smartphone Android)
- Veut savoir : les classes proposées, les horaires, les frais d'inscription, comment contacter l'école
- Sensible aux témoignages d'autres parents et aux photos

### Persona 2 — Papa Seydou (secondaire)
- Père actif, visite le site le soir depuis son ordinateur
- Veut télécharger les listes de fournitures et le calendrier scolaire
- Cherche le numéro de téléphone rapidement

### Persona 3 — Visiteur de passage
- Référent d'un enfant, oncle/tante, grand-parent
- Veut trouver l'adresse et prendre contact

---

## ✅ Exigences fonctionnelles

### MUST HAVE (priorité absolue)

| ID | Fonctionnalité | Page |
|---|---|---|
| F01 | Hero section accueillante avec CTA inscription | Home |
| F02 | Présentation des valeurs de l'école (Dynamisme, Persévérance, Esprit d'équipe) | Home |
| F03 | Aperçu et liste complète des classes (TPS→CM2) | Home + /les-classes |
| F04 | Téléchargement des listes de fournitures par niveau (9 PDFs) | /fournitures-scolaires |
| F05 | Calendrier scolaire 2025-2026 affiché + téléchargeable | /calendrier-scolaire |
| F06 | Horaires de cours clairement affichés | /les-horaires |
| F07 | Procédure d'inscription + téléchargement fiches | /inscription |
| F08 | Formulaire de contact (envoi email à direction@gsvictoriakoa.ci) | /contact + Home |
| F09 | Numéro de téléphone accessible en 1 clic (bouton flottant) | Partout |
| F10 | Responsive mobile-first (majorité des visites sur mobile) | Partout |

### SHOULD HAVE (important)

| ID | Fonctionnalité | Page |
|---|---|---|
| F11 | Galerie photos de l'école et des activités | /galleries |
| F12 | Section actualités/événements | /actualites |
| F13 | Témoignages de parents | Home |
| F14 | Carte Google Maps + adresse | /contact |
| F15 | Page À propos (histoire de l'école, équipe, pédagogie) | /a-propos |
| F16 | Animations scroll agréables (AOS) | Partout |
| F17 | Stats animées (10 ans, 12 classes, 350+ élèves, 25 enseignants) | Home |

### NICE TO HAVE (si le temps le permet)

| ID | Fonctionnalité |
|---|---|
| F18 | Filtres par catégorie sur la page actualités |
| F19 | Filtres sur la galerie |
| F20 | Section activités périscolaires détaillée (Danse, Karaté, Piano, Natation, Théâtre) |

---

## ❌ Hors périmètre (v1)

- Espace parent connecté / authentification
- Paiement des frais en ligne
- Blog avec administration
- Système de notation ou réservation
- Multilingue (anglais ou autres langues)
- Application mobile native

---

## 📱 Exigences non fonctionnelles

| Critère | Cible |
|---|---|
| **Performance** | Lighthouse score ≥ 85 (mobile) |
| **Accessibilité** | WCAG 2.1 AA (contrastes, labels, alt) |
| **SEO** | Balises meta description, OG tags, sitemap.xml |
| **Compatibilité** | Chrome, Firefox, Safari, Edge — iOS Safari, Chrome Android |
| **Déploiement** | FTP uniquement (hébergement mutualisé) |
| **Langues** | Français uniquement |
| **Chargement** | Images optimisées, lazy loading, CSS/JS minifiés |

---

## 🗺️ Sitemap

```
/                           → Accueil (Home)
/a-propos                   → À propos
/les-classes                → Les classes
/les-horaires               → Les horaires
/fournitures-scolaires      → Fournitures
/calendrier-scolaire        → Calendrier
/inscription                → Inscription
/galleries                  → Galerie photos
/actualites                 → Actualités
/contact                    → Contact
```

---

## 🎨 Ton éditorial

> ⚠️ **Ce site n'est PAS un site institutionnel.** Il parle aux parents avec chaleur.

| Utiliser | Éviter |
|---|---|
| "Vos enfants" | "Les élèves" (trop froid) |
| "Venez nous rejoindre !" | "Veuillez prendre contact" |
| "Un endroit où vos enfants s'épanouissent" | "Un établissement scolaire agréé" |
| "Notre famille VICTORIA-KOA" | "Notre institution" |
| "Inscrivez votre enfant dès aujourd'hui" | "Les inscriptions sont ouvertes" |
| Exclamations, emojis modérés, titres chaleureux | Jargon administratif |

---

## 📊 Critères de succès

- Tous les 10 liens de navigation fonctionnent
- Les 9 PDFs de fournitures sont téléchargeables
- Le formulaire de contact envoie un email à direction@gsvictoriakoa.ci
- Le site s'affiche correctement sur iPhone 12 et Samsung Galaxy A
- Toutes les animations AOS se déclenchent correctement au scroll
- Le bouton téléphone flottant est visible sur toutes les pages

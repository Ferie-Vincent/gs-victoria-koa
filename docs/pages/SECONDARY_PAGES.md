# Pages Secondaires

> Toutes les pages secondaires partagent le composant `PageBanner.tsx` en haut (voir `docs/COMPONENTS.md`).

---

## 📚 Classes.tsx — `/les-classes`

**Banner :** titre "Les classes"

---

### Bloc 1 — La Toute Petite Section (TPS)

**Titre :** "La Toute Petite Section — Un lieu d'éveil unique"  
**Icône :** 🌱

```
"La Toute Petite Section de L'ÉCOLE VICTORIA-KOA est un lieu
d'intégration douce vers la maternelle, un lieu chaleureux et sécurisant."

"L'ÉCOLE VICTORIA-KOA accueille les enfants à partir de deux ans
et leur offre, ainsi qu'à leurs parents, une transition douce et
rassurante entre la maison et l'école."

"Un maximum de 25 enfants par classe et l'attention bienveillante
de deux professionnelles de la petite enfance permettent de mettre
en place des routines rassurantes."
```

**Box conseils** (fond jaune doux `#FEF9C3`, icône 💡, `rounded-2xl`) :
- Privilégiez des chaussures que votre enfant sait mettre seul(e).
- Pensez à marquer les vêtements et aussi les chaussures.
- Bonbons, billes, bijoux, parapluies et casques sont interdits.

---

### Bloc 2 — Un Espace d'Éveil Aménagé

**Titre :** "Un Espace d'Éveil Aménagé" — icône 🏠

```
"Découvrez notre TPS conçue pour être un environnement sécurisé
et stimulant où l'enfant apprend en jouant."

"La classe est équipée de matériel pédagogique varié (livres,
jeux de construction, puzzles) accessibles sur des étagères basses."

"Le coin lecture invite au calme et à l'imagination, éveille
l'amour de la lecture et familiarise les enfants avec les livres."

"Le coin Arts Plastiques est équipé de chevalets et de divers
matériaux pour stimuler l'expression libre et la motricité fine."
```

---

### Bloc 3 — La Maternelle

**Titre :** "La Maternelle" — icône 🌸

```
"Nos classes de maternelle n'accueillent pas plus de 25 enfants
âgés de 2 à 5 ans, dans un cadre familial et chaleureux."

"La PS, MS et GS sont orchestrées par des maîtresses expérimentées
qui s'assurent de la qualité de l'apprentissage en respectant le
socle commun de connaissances requis par l'Éducation Nationale française."
```

---

### Bloc 4 — L'Élémentaire

**Titre :** "L'Élémentaire" — icône 🎓

```
"L'apprentissage que l'ÉCOLE VICTORIA-KOA propose au cycle
élémentaire assure l'acquisition des instruments fondamentaux :
lire, écrire, compter et respecter autrui."
```

**Feature 1 — "Une pédagogie différenciée et inclusive" 🎯**
- Des groupes de niveaux
- Des outils numériques pour rendre les apprentissages ludiques
- Un suivi individualisé de chaque élève

**Feature 2 — "Une école ouverte sur le monde" 🌍**
- Des projets pédagogiques en lien avec l'actualité
- Des sorties scolaires pour découvrir le patrimoine culturel
- Des échanges avec d'autres écoles pour l'ouverture d'esprit

---

### Bloc 5 — Grille des classes (réutilisation de ClassesPreview)

Même grille que la section 7 de la homepage, avec en plus les boutons PDF fournitures visibles directement (pas uniquement au hover).

---

### CTA final

```
"Comment inscrire votre enfant ?"
Bouton : "Voir maintenant →" → /inscription
```

---

## ⏰ Horaires.tsx — `/les-horaires`

**Banner :** titre "Les horaires"

**Titre :** "Les horaires de cours"  
**Sous-titre :** "Nos horaires de cours sont les suivants :"

### 2 cards côte à côte

**Card 1 — Fond violet clair (`bg-purple-50`), bordure violette :**

```
Icône : 📅
Titre : "Jours de cours"
Jours : Lundi, Mardi, Jeudi, Vendredi
━━━━━━━━━━━━━━━━━━━━━━━━
🌅 Matin       : 7h45 – 11h45
☀️ Après-midi  : 13h45 – 15h45
━━━━━━━━━━━━━━━━━━━━━━━━
ℹ️ Les élèves sont accueillis dès 7h30
```

**Card 2 — Fond gris clair (`bg-gray-50`), bordure grise :**

```
Icône : 🌙
Titre : "Jours sans cours"
Jours : Mercredi, Samedi, Dimanche
━━━━━━━━━━━━━━━━━━━━━━━━
"Pas de cours — Profitez du repos bien mérité !"
```

---

## 📦 Fournitures.tsx — `/fournitures-scolaires`

**Banner :** titre "Fournitures scolaires"

**Titre :** "Liste des fournitures scolaires 2025-2026"  
**Sous-titre :** "Téléchargez la liste de fournitures de votre classe"

### Grid 3 colonnes (desktop) / 2 (tablette) / 1 (mobile)

9 cards, une par niveau :

```typescript
const levels = [
  { code: 'TPS', name: 'Toute Petite Section',             pdf: 'fournitures/TPS-2025-2026.pdf',  color: '#7C3AED' },
  { code: 'PS',  name: 'Petite Section',                   pdf: 'fournitures/PS-2025-2026.pdf',   color: '#A78BFA' },
  { code: 'MS',  name: 'Moyenne Section',                  pdf: 'fournitures/MS-2025-2026.pdf',   color: '#EC4899' },
  { code: 'GS',  name: 'Grande Section',                   pdf: 'fournitures/GS-2025-2026.pdf',   color: '#F59E0B' },
  { code: 'CP',  name: 'Cours Préparatoire (CP1 & CP2)',   pdf: 'fournitures/CP-2025-2026.pdf',   color: '#F97316' },
  { code: 'CE1', name: 'Cours Élémentaire 1ère année',     pdf: 'fournitures/CE1-2025-2026.pdf',  color: '#14B8A6' },
  { code: 'CE2', name: 'Cours Élémentaire 2ème année',     pdf: 'fournitures/CE2-2025-2026.pdf',  color: '#22C55E' },
  { code: 'CM1', name: 'Cours Moyen 1ère année',           pdf: 'fournitures/CM1-2025-2026.pdf',  color: '#3B82F6' },
  { code: 'CM2', name: 'Cours Moyen 2ème année',           pdf: 'fournitures/CM2-2025-2026.pdf',  color: '#EF4444' },
];
```

**Chaque card :**
- Icône 🎒 dans un cercle de la couleur du niveau
- Code en grand (`font-display text-2xl font-bold`)
- Nom complet
- Bouton "⬇ Télécharger la liste" → `/storage/documents/${pdf}` (target `_blank`, download)
- Animation stagger à l'apparition

---

## 📅 Calendrier.tsx — `/calendrier-scolaire`

**Banner :** titre "Calendrier scolaire"

### Bouton téléchargement

```
📥 "Télécharger le calendrier complet 2025-2026"
→ /storage/documents/calendrier/calendrier-scolaire-2025-2026.pdf
```

### Grand tableau stylisé

**Titre tableau :** "CALENDRIER SCOLAIRE 2025 – 2026"  
Design : fond blanc, `rounded-3xl`, ombre colorée, lignes alternées

| COURS / VACANCES | DATE | DURÉE |
|---|---|---|
| 🏫 RENTRÉE DES CLASSES | Lundi 01 septembre 2025 | — |
| 📖 CLASSES | — | 07 Semaines |
| 🍂 VACANCES DE TOUSSAINT | Vend. 17 Oct. → Lun. 03 Nov. 2025 | 16 Jours |
| 📖 CLASSES | — | 7 Semaines |
| 🎄 VACANCES DE NOËL | Vend. 19 Déc. 2025 → Lun. 05 Jan. 2026 | 16 Jours |
| 📖 CLASSES | — | 7 Semaines |
| ❄️ VACANCES DE FÉVRIER | Vend. 20 Fév. → Lun. 09 Mars 2026 | 16 Jours |
| 📖 CLASSES | — | 7 Semaines |
| 🌸 VACANCES D'AVRIL | Vend. 24 Avr. → Lun. 11 Mai 2026 | 16 Jours |
| 📖 CLASSES | — | 7 Semaines |
| ☀️ SORTIE DES CLASSES | Élèves : 26 juin 2026 / Enseignants : 03 juil. 2026 | — |

**Style des lignes :**
- Lignes "CLASSES" : fond `bg-purple-50`, texte violet
- Lignes "VACANCES" : fond `bg-orange-50`, texte orange
- Ligne "RENTRÉE" et "SORTIE" : fond `bg-yellow-50`, texte jaune foncé, **bold**

### Box jours fériés

Fond orange doux `#FFF7ED`, bordure orange, `rounded-2xl`, icône 🎉

**Titre :** "Ajoutés aux congés les journées suivantes :"

```
• Toussaint            : Samedi 01 novembre 2025
• Fête de la paix      : 15 novembre 2025
• Noël                 : Jeudi 25 décembre 2025
• Saint-Sylvestre      : Jeudi 01 janvier 2026
• Lundi de pâques      : 06 Avril 2026
• Fête du travail      : Vendredi 1 Mai 2026
• Ascension            : Jeudi 14 Mai 2026
• Lundi de pentecôte   : 25 juin 2026

Et quatre (4) fêtes musulmanes :
• Fête de Maouloud
• Jour après Nuit du destin
(dates variables selon le calendrier islamique)
```

---

## 📝 Inscription.tsx — `/inscription`

**Banner :** titre "Inscription"

**Titre :** "Inscription au G.S. Victoria-Koa"  
**Sous-titre :** "Toutes les informations à votre portée pour inscrire votre enfant"

---

### BLOC 1 — Fiches renseignement (2 cards côte à côte)

```typescript
const mainForms = [
  {
    icon: '📋',
    title: 'Fiche Renseignement Maternelle',
    subtitle: 'TPS, PS, MS, GS',
    href: '/storage/documents/inscriptions/fiche-inscription-maternelle-2025-2026.pdf',
  },
  {
    icon: '📋',
    title: 'Fiche Renseignement Primaire',
    subtitle: 'CP1, CP2, CE1, CE2, CM1, CM2',
    href: '/storage/documents/inscriptions/fiche-inscription-primaire-2025-2026.pdf',
  },
];
```

---

### BLOC 2 — Autres documents (3 cards en row)

```typescript
const extraDocs = [
  {
    icon: '📄',
    title: "Fiche d'inscription",
    href: '/storage/documents/inscriptions/fiche-inscription-maternelle-2025-2026.pdf',
  },
  {
    icon: '🏥',
    title: 'Fiche médicale',
    href: '/storage/documents/inscriptions/fiche-medicale.pdf',
  },
  {
    icon: '💉',
    title: 'Certificat de vaccination',
    href: '/storage/documents/inscriptions/certificat-vaccination.pdf',
  },
];
```

---

### BLOC 3 — Procédure d'inscription (timeline verticale)

Même style que `HowToEnroll.tsx` (homepage section 8), mais plus développée.

**Étape 1 — icône 📃 :**  
"Documents à fournir"

L'école vous fournira une liste des documents à fournir :
- Acte de naissance de l'enfant
- Certificat de vaccination
- 04 photos d'identité de l'enfant
- Les frais d'inscription

**Étape 2 — icône 📝 :**  
"Remplir le formulaire"  
"L'école vous fournira un formulaire d'inscription à remplir et à retourner avec les documents nécessaires."

---

## 🖼️ Galleries.tsx — `/galleries`

**Banner :** titre "Nos Galeries"

**Description :**
> "Découvrez les moments forts de la vie scolaire au Groupe Scolaire VICTORIA-KOA à travers notre galerie photos."

**Filtres par catégorie** (pills colorées) :
- Toutes · Activités · Événements · Classes · Sorties

**PhotoGrid** : utiliser le composant `PhotoGrid.tsx`
- Les photos proviennent des props Inertia passées par `GalleriesController`
- Lightbox au clic sur une photo

---

## 📰 Actualites.tsx — `/actualites`

**Banner :** titre "Actualités"

**Description :**  
> "Restez informés des dernières nouvelles et événements du Groupe Scolaire VICTORIA-KOA."

**Filtres :** Tous · Animation · Créatif · Création · Non classé

**Grid 3 colonnes** d'articles (même format que `RecentNews.tsx` mais avec plus d'articles).

---

## 📞 Contact.tsx — `/contact`

**Banner :** titre "Contact"

**Layout 2 colonnes :**

**Colonne gauche — Informations :**
- Carte Google Maps (iframe embed)
- Adresse : Angré 9ème Tranche CNPS en haut, en face de la Pâtisserie MARY'S, Abidjan
- Coordonnées GPS : 92HH+H98, Voie Djibi, Abidjan
- 📞 (+225) 07 67 48 55 94
- 📞 (+225) 01 43 23 84 82
- ✉️ direction@gsvictoriakoa.ci
- ✉️ victoria-koa1965@gemail.com

**Colonne droite — Formulaire complet :**
- `name` — "Votre nom complet"
- `email` — "votre@email.com"
- `phone` — "+225 XX XX XX XX"
- `message` — "Votre message..." (textarea, min 4 lignes)
- Bouton : "✉ Envoyer le message"

Soumission via `router.post(route('contact.send'), formData)`.  
Afficher le message flash de succès/erreur après soumission.

---

## 📄 About.tsx — `/a-propos`

**Banner :** titre "À propos"

> Page à développer librement — présentation de l'école, son histoire depuis 1965, son équipe, sa pédagogie, ses valeurs. Reprendre et développer les éléments du mot de bienvenue de la homepage.

**Sections suggérées :**
1. Notre histoire (fondation, valeurs fondatrices)
2. Notre équipe dirigeante
3. Notre pédagogie
4. Nos locaux et équipements
5. CTA Inscription

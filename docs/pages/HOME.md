# Page Accueil — Home.tsx

> 11 sections dans l'ordre d'affichage. Chaque section est un composant distinct dans `components/home/`.

---

## Section 1 — HeroSection.tsx (plein écran, 100vh)

### Design
- Fond : gradient diagonal `#7C3AED` → `#EC4899` + overlay SVG de petits points/étoiles blancs (opacity 0.1)
- Layout 2 colonnes : texte à gauche (col 7/12), illustration à droite (col 5/12)
- Mobile : une colonne, illustration au-dessus

### Éléments animés (Framer Motion)
1. **Bulles colorées flottantes** en background (jaune `#F59E0B`, turquoise `#14B8A6`, rose `#EC4899`) — float infinie
2. **Titre "Bienvenue à"** — fadeIn depuis le bas, délai 0.1s
3. **"VICTORIA-KOA"** — typewriter lettre par lettre, couleur `#F59E0B` (jaune), délai 0.3s
4. **Sous-titres** — fadeIn avec délais croissants (0.6s, 0.8s)
5. **Boutons CTA** — bounce + apparition à 0.9s
6. **Illustration SVG enfants** — float douce (monte/descend 15px)
7. **Nuages SVG** — dérive lente de gauche à droite
8. **Badge "⭐ École certifiée"** — rotation oscillante `-3deg` → `3deg` infinie

### Contenu textuel
```
H1 : "Bienvenue à"
H1 span (jaune, Baloo 2 extrabold) : "VICTORIA-KOA"

P : "Nous avons un programme unique qui aide chaque enfant à
     s'adapter rapidement et à se sentir chez lui."

P : "Nous aidons également chaque enfant à trouver sa propre voie."
```

### Boutons
- **CTA principal** : "En savoir plus →" — grand, fond blanc, texte violet, `rounded-full`
- **CTA secondaire** : "Nous contacter" — outlined blanc, `rounded-full`
- Lien CTA → `/a-propos` | Lien contact → `/contact`

### Indicateur scroll
- Petite flèche `ChevronDown` (Lucide) animée en `y: [0, 8, 0]` infinie, centrée en bas

---

## Section 2 — WelcomeSection.tsx

### Design
- Fond : `#FEFCE8` (crème)
- Layout 2 colonnes : image/logo à gauche, texte à droite
- Séparateur coloré sous le titre : trait violet 60px, `rounded-full`, hauteur 4px
- Petite icône étoile (⭐ ou SVG) avant chaque paragraphe, couleur alternée (violet, jaune, rose…)

### Contenu
```
Titre : "Mot de Bienvenue sur le site"

Paragraphe 1 :
"Bienvenue dans notre école victoria-koa où l'esprit d'équipe
et l'esprit famille est au cœur de tout ce que nous faisons."

Paragraphe 2 :
"Ici les enfants grandissent ensemble, apprennent des uns
des autres et tissent des liens forts qui durent toute une vie."

Paragraphe 3 :
"Nous sommes fiers de notre équipe enseignante, passionnée,
dévouée et de nos élèves motivés qui travaillent ensemble
pour atteindre l'excellence."

Paragraphe 4 :
"Notre école est un endroit où nous nous efforçons de créer
un environnement d'apprentissage stimulant et accueillant,
où chaque élève unique et valorisé peut grandir et s'épanouir."

Paragraphe 5 :
"Nous sommes à votre écoute et sommes impatients de partager
cette aventure éducative avec vous !"

Paragraphe 6 :
"Bonne visite sur ce site web conçu pour vous donner un aperçu
de notre vie scolaire. Vous y trouverez nos convictions éducatives
ainsi que nos activités et événements."
```

---

## Section 3 — ValuesSection.tsx

### Design
- Fond : gradient lavande `#F5F3FF`
- Titre centré avec confettis SVG décoratifs autour
- 3 cards en row (desktop) / 1 colonne (mobile)
- Cards : fond blanc, `rounded-3xl`, ombre colorée selon la card
- Icône grande dans un cercle coloré en haut de card
- Hover : `translateY(-8px)` + ombre plus prononcée
- Animation stagger (délai 0.1s entre chaque card)

### Données des cards

```typescript
const values = [
  {
    icon: '⚡',
    color: '#7C3AED',      // violet
    shadowColor: 'rgba(124,58,237,0.2)',
    title: 'Le Dynamisme',
    text: "Un mot avec beaucoup de sens, le dynamisme permet aux élèves de surmonter toute épreuve, d'aller au-delà de leurs limites et de donner le meilleur d'eux-mêmes chaque jour.",
  },
  {
    icon: '🎯',
    color: '#F59E0B',      // jaune/orange
    shadowColor: 'rgba(245,158,11,0.2)',
    title: 'La Persévérance',
    text: "Une qualité essentielle qui consiste à persister dans ses efforts et à braver tout obstacle pour atteindre ses objectifs, quelles que soient les difficultés rencontrées.",
  },
  {
    icon: '🤝',
    color: '#14B8A6',      // turquoise
    shadowColor: 'rgba(20,184,166,0.2)',
    title: "L'Esprit d'Équipe",
    text: "À Victoria-Koa, l'esprit d'équipe est une valeur fondamentale que nous inculquons aux élèves afin de les préparer à la vie collective et professionnelle.",
  },
];
```

---

## Section 4 — ActivitiesSection.tsx

### Design
- Fond blanc avec grande forme blob violet clair en arrière-plan (opacity 0.15)
- Titre + sous-titre centrés
- Activités affichées en **badges/pills géants** colorés avec icône + texte
- Badges disposés en flex wrap centré, animation stagger `scale` au scroll
- CTA en dessous

### Contenu

**Titre :** "Nos Activités"

**Sous-titre :**
> "Victoria-Koa propose à vos enfants une variété d'activités périscolaires pour enrichir leur expérience. De la découverte artistique au sport, nos programmes sont conçus pour favoriser l'épanouissement de chaque enfant."

```typescript
const activities = [
  { icon: '💃', label: 'Danse',    bgColor: '#FCE7F3', textColor: '#9D174D' },
  { icon: '🥋', label: 'Karaté',   bgColor: '#FFEDD5', textColor: '#9A3412' },
  { icon: '🎹', label: 'Piano',    bgColor: '#EDE9FE', textColor: '#5B21B6' },
  { icon: '🏊', label: 'Natation', bgColor: '#CCFBF1', textColor: '#0F766E' },
  { icon: '🎭', label: 'Théâtre',  bgColor: '#FEF9C3', textColor: '#854D0E' },
];
```

**CTA :**
- Texte : "Découvrez la liste des tarifs et le planning des cours"
- Bouton : "Cliquez ici →" → lien `/inscription`

---

## Section 5 — EnrollmentCTA.tsx

### Design
- Fond : gradient violet → indigo foncé (`#7C3AED` → `#1E1B4B`)
- Coins décorés de shapes géométriques colorés (SVG)
- 2 cards de téléchargement côte à côte sur fond blanc, `rounded-2xl`

### Contenu

**Titre (blanc) :** "S'inscrire au Groupe Scolaire VICTORIA-KOA"

**Sous-titre (blanc/opacity 0.85) :** "Toutes les informations à votre portée pour inscrire votre enfant"

```typescript
const enrollmentCards = [
  {
    icon: '📋',
    title: 'Fiche Renseignement Maternelle',
    subtitle: 'Toute Petite Section, PS, MS, GS',
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

Bouton des cards : "⬇ Télécharger" — `download` attribute, target `_blank`

---

## Section 6 — StatsSection.tsx

### Design
- Fond : jaune doux `#FEF9C3` avec confettis SVG
- 4 items en row (desktop) / 2×2 (mobile)
- Chaque stat : icône circulaire colorée + grand chiffre animé + label
- Chiffres : compteur `0 → valeur` au scroll (voir `AnimatedCounter.tsx`)
- Police chiffres : `font-display` (Baloo 2) extrabold

```typescript
const stats = [
  { value: 10,  suffix: '+', label: "ans d'Expériences", icon: '🏫', color: '#7C3AED' },
  { value: 12,  suffix: '',  label: 'Classes',            icon: '📚', color: '#F59E0B' },
  { value: 350, suffix: '+', label: 'Élèves',             icon: '👧', color: '#EC4899' },
  { value: 25,  suffix: '',  label: 'Enseignants',        icon: '👩‍🏫', color: '#14B8A6' },
];
```

---

## Section 7 — ClassesPreview.tsx

### Design
- Fond blanc
- Header : titre + lien "Voir toutes les classes →" (droite)
- Grid : 5 colonnes desktop / 2 colonnes mobile / 3 tablette
- Cards compactes, `rounded-2xl`
- Pastille couleur selon cycle : violet = maternelle, orange = primaire
- Sigle en grand (`font-display text-3xl`)
- Nom complet en dessous
- Hover : fond coloré + bouton "Voir fournitures →"

```typescript
const classes = [
  // Maternelle
  { code: 'TPS', name: 'Toute Petite Section ou Passerelle', cycle: 'maternelle', pdfPath: 'fournitures/TPS-2025-2026.pdf' },
  { code: 'PS',  name: 'Petite Section',                    cycle: 'maternelle', pdfPath: 'fournitures/PS-2025-2026.pdf'  },
  { code: 'MS',  name: 'Moyenne Section',                   cycle: 'maternelle', pdfPath: 'fournitures/MS-2025-2026.pdf'  },
  { code: 'GS',  name: 'Grande Section',                    cycle: 'maternelle', pdfPath: 'fournitures/GS-2025-2026.pdf'  },
  // Primaire
  { code: 'CP1', name: 'Cours Préparatoire 1ère année',     cycle: 'primaire',   pdfPath: 'fournitures/CP-2025-2026.pdf'  },
  { code: 'CP2', name: 'Cours Préparatoire 2ème année',     cycle: 'primaire',   pdfPath: 'fournitures/CP-2025-2026.pdf'  },
  { code: 'CE1', name: 'Cours Élémentaire 1ère année',      cycle: 'primaire',   pdfPath: 'fournitures/CE1-2025-2026.pdf' },
  { code: 'CE2', name: 'Cours Élémentaire 2ème année',      cycle: 'primaire',   pdfPath: 'fournitures/CE2-2025-2026.pdf' },
  { code: 'CM1', name: 'Cours Moyen 1ère année',            cycle: 'primaire',   pdfPath: 'fournitures/CM1-2025-2026.pdf' },
  { code: 'CM2', name: 'Cours Moyen 2ème année',            cycle: 'primaire',   pdfPath: 'fournitures/CM2-2025-2026.pdf' },
];
```

Couleurs cycle :
- `maternelle` → `bg-purple-100 text-purple-700 border-purple-200`
- `primaire` → `bg-orange-100 text-orange-700 border-orange-200`

---

## Section 8 — HowToEnroll.tsx

### Design
- Fond lavande `#EDE9FE`
- Timeline verticale avec ligne pointillée
- Numéros d'étapes dans des cercles colorés (violet, jaune)
- Animation : étapes apparaissent en cascade

### Contenu

**Titre :** "Comment inscrire votre enfant ?"

**Étape 1 — icône 📃, couleur violet :**
> "Documents à fournir"

Documents :
- Acte de naissance de l'enfant
- Certificat de vaccination
- 04 photos d'identité de l'enfant
- Les frais d'inscription

**Étape 2 — icône 📝, couleur jaune :**
> "Remplir le formulaire"
>
> "L'école vous fournira un formulaire d'inscription à remplir et à retourner avec les documents nécessaires."

**Bouton :** "Plus d'information →" → `/inscription`

---

## Section 9 — TestimonialsSlider.tsx

### Design
- Fond blanc
- **Swiper.js** : `autoplay={{ delay: 4000 }}`, `pagination={{ clickable: true }}`, `loop: true`
- Cards : fond `#F9F7FF`, `rounded-3xl`, guillemets géants décoratifs (violet opacity 0.15)
- Avatar : cercle coloré avec initiales (pas de vraie photo)
- Étoiles : 5 étoiles jaunes `⭐`

### Données

```typescript
const testimonials = [
  {
    quote: "Mon fils est épanoui depuis qu'il est à Victoria-Koa. Les enseignants sont attentionnés et l'ambiance est vraiment familiale. Je recommande cette école à tous les parents !",
    author: 'Mme Koné Adjoua',
    role: "maman d'Ange, CP1",
    initials: 'KA',
    avatarColor: '#7C3AED',
  },
  {
    quote: "Nous avons choisi Victoria-Koa pour la qualité de l'enseignement et nous n'avons pas été déçus. Ma fille a fait d'énormes progrès en lecture et en mathématiques.",
    author: 'M. Traoré Seydou',
    role: 'papa de Fatoumata, CE1',
    initials: 'TS',
    avatarColor: '#F59E0B',
  },
  {
    quote: "L'équipe pédagogique est vraiment dévouée. Le suivi individualisé de chaque enfant est remarquable. On se sent vraiment écouté en tant que parent.",
    author: 'Mme Bamba Aminata',
    role: 'maman de Junior, MS',
    initials: 'BA',
    avatarColor: '#EC4899',
  },
  {
    quote: "Victoria-Koa c'est bien plus qu'une école, c'est une famille. Mon enfant pleure quand il ne peut pas y aller ! Les activités périscolaires sont fantastiques.",
    author: 'M. Coulibaly Ibrahim',
    role: 'papa de Youssouf, GS',
    initials: 'CI',
    avatarColor: '#14B8A6',
  },
];
```

---

## Section 10 — RecentNews.tsx

### Design
- Fond `#F5F3FF`
- Titre centré + filtres en pills colorées (animation active)
- 2 cards articles côte à côte
- Card : image 16:9 en haut (`rounded-2xl`), badge catégorie en overlay, date, titre, bouton "Lire →"
- Hover : zoom image doux (`scale(1.05)`) + card lift

### Données

**Filtres (pills) :**
```
Tous  •  Animation  •  Créatif  •  Création  •  Non classé
```

**Articles :**
```typescript
const articles = [
  {
    id: 1,
    title: 'Galette des rois',
    category: 'Animation',
    date: '9 avril 2023',
    image: '/images/news/galette-des-rois.jpg',
  },
  {
    id: 2,
    title: 'Sortie au musée',
    category: 'Créatif',
    date: '9 avril 2023',
    image: '/images/news/sortie-musee.jpg',
  },
];
```

---

## Section 11 — ContactForm.tsx (mini formulaire)

### Design
- Fond : gradient violet foncé avec pattern pointillés SVG
- Card blanche centrée (`max-w-lg`), `rounded-3xl`, ombre colorée
- Champs avec floating labels (label monte au focus/filled)
- Bouton "Envoyer" violet full-width, `rounded-full`
- Gestion flash message depuis Inertia (`usePage().props.flash.success`)

### Contenu

**Titre (blanc) :** "Nous contacter"

**Sous-titre (blanc/opacity 0.85) :** "Une question ? Nous vous répondons rapidement."

**Champs du formulaire :**
- `name` — label "Votre nom complet"
- `email` — label "votre@email.com"
- `phone` — label "+225 XX XX XX XX"
- Bouton : "✉ Envoyer le message"

**Info adresse (sous la card, texte blanc) :**
- 📍 Angré 9ème Tranche CNPS en haut, en face de la Pâtisserie MARY'S
- 📍 92HH+H98, Voie Djibi, Abidjan

**Soumission :** `router.post('/contact', formData)` via `@inertiajs/react`

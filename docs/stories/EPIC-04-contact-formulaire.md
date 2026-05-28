# EPIC-04 — Formulaire de Contact

> **Priorité :** 🟠 Haute (fonctionnalité critique pour les parents)
> **Agent :** Dev Backend + Dev Frontend
> **Dépend de :** EPIC-01 (layout terminé)

---

## Story 4.1 — Route et Controller Contact
**Statut :** `[ ] Todo`

**Fichier :** `app/Http/Controllers/ContactController.php`

**Critères d'acceptation :**
- [ ] Méthode `index()` : `return view('pages.contact')`
- [ ] Méthode `send(Request $request)` avec validation :
  - `name` : required, string, max 255
  - `email` : required, email, max 255
  - `phone` : nullable, string, max 20
  - `message` : required, string, min 10, max 2000
- [ ] Envoi email via `Mail::to('direction@gsvictoriakoa.ci')->send(new ContactFormMail($data))`
- [ ] Redirect back avec flash : `return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondons rapidement !')`
- [ ] En cas d'erreur mail : `return back()->with('error', 'Erreur lors de l\'envoi. Merci de réessayer ou d\'appeler directement.')`

**Route :**
```php
Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send')
    ->middleware('throttle:10,1');  // max 10 envois / minute
```

---

## Story 4.2 — Mailable ContactFormMail
**Statut :** `[ ] Todo`

**Fichier :** `app/Mail/ContactFormMail.php`

**Critères d'acceptation :**
- [ ] Constructor reçoit `array $data` (name, email, phone, message)
- [ ] Subject : `"[GS VICTORIA-KOA] Nouveau message de {$data['name']}"`
- [ ] Reply-To : email de l'expéditeur
- [ ] Vue email : `resources/views/emails/contact.blade.php`
- [ ] La vue email est en HTML propre avec : nom, email, téléphone, message, date d'envoi

**`resources/views/emails/contact.blade.php` :**
```html
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Nouveau message</title></head>
<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
  <div style="background: #7C3AED; padding: 20px; border-radius: 8px 8px 0 0;">
    <h1 style="color: white; margin: 0; font-size: 20px;">🏫 GS VICTORIA-KOA</h1>
    <p style="color: #E9D5FF; margin: 4px 0 0;">Nouveau message depuis le site</p>
  </div>
  <div style="background: #f9f9f9; padding: 24px; border-radius: 0 0 8px 8px;">
    <p><strong>Nom :</strong> {{ $data['name'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Téléphone :</strong> {{ $data['phone'] ?? 'Non renseigné' }}</p>
    <hr style="border: 1px solid #e5e7eb;">
    <p><strong>Message :</strong></p>
    <p style="background: white; padding: 16px; border-radius: 8px; border-left: 4px solid #7C3AED;">
      {{ $data['message'] }}
    </p>
    <p style="color: #9ca3af; font-size: 12px;">Envoyé le {{ now()->format('d/m/Y à H:i') }}</p>
  </div>
</body>
</html>
```

---

## Story 4.3 — Page Contact complète
**Statut :** `[ ] Todo`

**Fichier :** `resources/views/pages/contact.blade.php`

**Critères d'acceptation :**
- [ ] Banner "Contact"
- [ ] Layout 2 colonnes (`lg:grid-cols-2`)
- [ ] **Colonne gauche** :
  - [ ] Carte Google Maps iframe (coordonnées 92HH+H98, Voie Djibi, Abidjan)
  - [ ] Adresse complète avec icône 📍
  - [ ] 2 numéros de téléphone cliquables (`tel:`)
  - [ ] 2 emails cliquables (`mailto:`)
- [ ] **Colonne droite** : formulaire complet
  - [ ] Champs : name, email, phone, message (textarea 4 lignes min)
  - [ ] Floating labels (label monte quand le champ est focus/rempli — Alpine.js)
  - [ ] `@csrf`, `method="POST"`, `action="{{ route('contact.send') }}"`
  - [ ] Bouton "✉ Envoyer le message" violet `rounded-full`
  - [ ] Affichage flash `session('success')` : box verte
  - [ ] Affichage flash `session('error')` : box rouge
  - [ ] Erreurs de validation Blade : `@error('name')..@enderror`
- [ ] `data-aos="fade-right"` colonne gauche, `data-aos="fade-left"` colonne droite

**Floating labels Alpine.js :**
```html
<div
  x-data="{ focused: false, filled: false }"
  class="relative"
>
  <label
    :class="(focused || filled) ? '-top-2 text-xs text-primary' : 'top-3 text-gray-400'"
    class="absolute left-3 transition-all duration-200 pointer-events-none"
  >Votre nom complet</label>
  <input
    type="text"
    name="name"
    @focus="focused = true"
    @blur="focused = false; filled = $event.target.value.length > 0"
    class="w-full border rounded-2xl px-3 pt-5 pb-2 focus:outline-none focus:ring-2 focus:ring-primary"
    value="{{ old('name') }}"
  />
</div>
```

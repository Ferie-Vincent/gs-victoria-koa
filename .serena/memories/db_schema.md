# DB Schema

## Models (app/Models/)

| Model | Table | Key fields |
|---|---|---|
| `User` | `users` | name, email, password (admin users only) |
| `Actualite` | `actualites` | title, slug, content, excerpt, image, images (JSON), published_at, is_published |
| `Temoignage` | `temoignages` | author, role, content, rating, is_active |
| `ContactMessage` | `contact_messages` | name, email, phone, subject, message, read_at |
| `CalendrierEvent` | `calendrier_events` | title, description, date_start, date_end, type, color |
| `Setting` | `settings` | key, value (key-value store for site settings) |

## Notes
- No public user accounts — DB users = admin panel only
- Actualites support multiple images (JSON column `images`)
- Settings is a flat key/value table (accessed via `Setting::get('key')` pattern)
- CalendrierEvents added `date_start`/`date_end` columns in migration `2026_05_28_000001`
- ContactMessages use `read_at` (nullable timestamp) to track read status

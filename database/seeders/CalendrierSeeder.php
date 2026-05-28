<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalendrierEvent;

class CalendrierSeeder extends Seeder
{
    public function run(): void
    {
        CalendrierEvent::truncate();

        $events = [
            // ── Périodes scolaires ──────────────────────────────────────────────
            ['label' => 'RENTRÉE DES CLASSES',  'type' => 'rentree',  'ordre' => 10,
             'date_debut' => '2025-09-01', 'date_fin' => '2025-09-01',
             'date_affichee' => 'Lundi 01 septembre 2025', 'duree' => null,
             'icone' => 'fi-sr-school'],

            ['label' => 'CLASSES',               'type' => 'classes',  'ordre' => 20,
             'date_debut' => '2025-09-01', 'date_fin' => '2025-10-17',
             'date_affichee' => 'Lun. 01 sept. → Vend. 17 oct. 2025', 'duree' => '7 sem.',
             'icone' => 'fi-sr-book'],

            ['label' => 'VACANCES DE TOUSSAINT', 'type' => 'vacances', 'ordre' => 30,
             'date_debut' => '2025-10-18', 'date_fin' => '2025-11-02',
             'date_affichee' => 'Vend. 17 oct. → Lun. 03 nov. 2025', 'duree' => '16 j.',
             'icone' => 'fi-sr-leaf'],

            ['label' => 'CLASSES',               'type' => 'classes',  'ordre' => 40,
             'date_debut' => '2025-11-03', 'date_fin' => '2025-12-19',
             'date_affichee' => 'Lun. 03 nov. → Vend. 19 déc. 2025', 'duree' => '7 sem.',
             'icone' => 'fi-sr-book'],

            ['label' => 'VACANCES DE NOËL',      'type' => 'vacances', 'ordre' => 50,
             'date_debut' => '2025-12-20', 'date_fin' => '2026-01-04',
             'date_affichee' => 'Vend. 19 déc. 2025 → Lun. 05 jan. 2026', 'duree' => '16 j.',
             'icone' => 'fi-sr-snowflake'],

            ['label' => 'CLASSES',               'type' => 'classes',  'ordre' => 60,
             'date_debut' => '2026-01-05', 'date_fin' => '2026-02-20',
             'date_affichee' => 'Lun. 05 jan. → Vend. 20 fév. 2026', 'duree' => '7 sem.',
             'icone' => 'fi-sr-book'],

            ['label' => 'VACANCES DE FÉVRIER',   'type' => 'vacances', 'ordre' => 70,
             'date_debut' => '2026-02-21', 'date_fin' => '2026-03-08',
             'date_affichee' => 'Vend. 20 fév. → Lun. 09 mars 2026', 'duree' => '16 j.',
             'icone' => 'fi-sr-wind'],

            ['label' => 'CLASSES',               'type' => 'classes',  'ordre' => 80,
             'date_debut' => '2026-03-09', 'date_fin' => '2026-04-24',
             'date_affichee' => 'Lun. 09 mars → Vend. 24 avr. 2026', 'duree' => '7 sem.',
             'icone' => 'fi-sr-book'],

            ['label' => "VACANCES D'AVRIL",      'type' => 'vacances', 'ordre' => 90,
             'date_debut' => '2026-04-25', 'date_fin' => '2026-05-10',
             'date_affichee' => 'Vend. 24 avr. → Lun. 11 mai 2026', 'duree' => '16 j.',
             'icone' => 'fi-sr-flower'],

            ['label' => 'CLASSES',               'type' => 'classes',  'ordre' => 100,
             'date_debut' => '2026-05-11', 'date_fin' => '2026-07-03',
             'date_affichee' => 'Lun. 11 mai → Vend. 03 juil. 2026', 'duree' => '8 sem.',
             'icone' => 'fi-sr-book'],

            ['label' => 'SORTIE DES CLASSES',    'type' => 'rentree',  'ordre' => 110,
             'date_debut' => '2026-07-03', 'date_fin' => '2026-07-03',
             'date_affichee' => 'Vendredi 03 juillet 2026', 'duree' => null,
             'icone' => 'fi-sr-graduation-cap'],

            // ── Jours fériés ────────────────────────────────────────────────────
            ['label' => 'Toussaint',           'type' => 'ferie', 'ordre' => 120,
             'date_debut' => '2025-11-01', 'date_fin' => '2025-11-01',
             'date_affichee' => '1er novembre 2025', 'duree' => null, 'icone' => 'fi-sr-star'],

            ['label' => 'Fête de la paix',     'type' => 'ferie', 'ordre' => 130,
             'date_debut' => '2025-11-15', 'date_fin' => '2025-11-15',
             'date_affichee' => '15 novembre 2025', 'duree' => null, 'icone' => 'fi-sr-star'],

            ['label' => 'Noël',                'type' => 'ferie', 'ordre' => 140,
             'date_debut' => '2025-12-25', 'date_fin' => '2025-12-25',
             'date_affichee' => '25 décembre 2025', 'duree' => null, 'icone' => 'fi-sr-snowflake'],

            ['label' => "Jour de l'An",        'type' => 'ferie', 'ordre' => 150,
             'date_debut' => '2026-01-01', 'date_fin' => '2026-01-01',
             'date_affichee' => '1er janvier 2026', 'duree' => null, 'icone' => 'fi-sr-star'],

            ['label' => 'Lundi de Pâques',     'type' => 'ferie', 'ordre' => 160,
             'date_debut' => '2026-04-06', 'date_fin' => '2026-04-06',
             'date_affichee' => '6 avril 2026', 'duree' => null, 'icone' => 'fi-sr-flower'],

            ['label' => 'Fête du Travail',     'type' => 'ferie', 'ordre' => 170,
             'date_debut' => '2026-05-01', 'date_fin' => '2026-05-01',
             'date_affichee' => '1er mai 2026', 'duree' => null, 'icone' => 'fi-sr-star'],

            ['label' => 'Ascension',           'type' => 'ferie', 'ordre' => 180,
             'date_debut' => '2026-05-14', 'date_fin' => '2026-05-14',
             'date_affichee' => '14 mai 2026', 'duree' => null, 'icone' => 'fi-sr-star'],

            ['label' => 'Lundi de Pentecôte',  'type' => 'ferie', 'ordre' => 190,
             'date_debut' => '2026-05-25', 'date_fin' => '2026-05-25',
             'date_affichee' => '25 mai 2026', 'duree' => null, 'icone' => 'fi-sr-star'],
        ];

        foreach ($events as $e) {
            CalendrierEvent::create($e);
        }
    }
}

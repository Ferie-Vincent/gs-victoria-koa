<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Setting;
use App\Models\Temoignage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'direction@gsvictoriakoa.ci'],
            ['name' => 'Direction', 'password' => Hash::make('Victoria2025!')]
        );

        // ── Actualités ────────────────────────────────────────────
        if (Actualite::count() === 0) {
            $articles = [
                ['titre' => 'Journée sportive 2026', 'categorie' => 'Sport', 'badge_bg' => 'bg-orange-500',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_112222-scaled.jpg',
                 'extrait' => "Nos élèves ont participé à une magnifique journée sportive pleine d'enthousiasme et de bonne humeur."],
                ['titre' => 'Célébration en uniforme', 'categorie' => 'Événement', 'badge_bg' => 'bg-violet-600',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_113121-scaled.jpg',
                 'extrait' => "Une belle occasion pour nos élèves de montrer leur fierté d'appartenir à la grande famille Victoria-Koa."],
                ['titre' => 'Nos élèves rayonnent', 'categorie' => 'Événement', 'badge_bg' => 'bg-teal-600',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_113135-scaled.jpg',
                 'extrait' => "Des sourires, de l'énergie et beaucoup de fierté — nos élèves ont brillé lors de cette journée spéciale."],
                ['titre' => 'Activités de groupe', 'categorie' => 'Animation', 'badge_bg' => 'bg-pink-500',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_110459-scaled.jpg',
                 'extrait' => "Des activités collaboratives qui renforcent les liens entre élèves et développent l'esprit d'équipe."],
                ['titre' => 'Moments de partage', 'categorie' => 'Animation', 'badge_bg' => 'bg-blue-600',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_110148-scaled.jpg',
                 'extrait' => "Des instants précieux capturés lors de nos activités scolaires, témoins de la joie de vivre à l'école."],
                ['titre' => 'Nos élèves à l\'honneur', 'categorie' => 'Créatif', 'badge_bg' => 'bg-amber-500',
                 'date_publication' => '2026-01-28', 'image' => '/images/gallery/20260128_112704-scaled.jpg',
                 'extrait' => "Les créations et travaux de nos élèves sont exposés fièrement lors des journées portes ouvertes."],
                ['titre' => 'Portraits de notre école', 'categorie' => 'Événement', 'badge_bg' => 'bg-violet-600',
                 'date_publication' => '2023-04-09', 'image' => '/images/gallery/CV5I0165-scaled.jpg',
                 'extrait' => "Des portraits officiels qui témoignent de la belle diversité et de la vitalité de notre communauté scolaire."],
                ['titre' => 'Galette des rois', 'categorie' => 'Animation', 'badge_bg' => 'bg-orange-500',
                 'date_publication' => '2023-04-09', 'image' => '/images/gallery/CV5I0191-scaled.jpg',
                 'extrait' => "Un moment de partage et de convivialité pour nos élèves autour de la tradition de la galette des rois."],
                ['titre' => 'Sortie au musée', 'categorie' => 'Créatif', 'badge_bg' => 'bg-teal-600',
                 'date_publication' => '2023-04-09', 'image' => '/images/gallery/CV5I0202-scaled.jpg',
                 'extrait' => "Découverte du patrimoine culturel ivoirien avec nos élèves lors d'une sortie pédagogique enrichissante."],
            ];
            foreach ($articles as $a) {
                Actualite::create(array_merge($a, ['publie' => true]));
            }
        }

        // ── Témoignages ───────────────────────────────────────────
        if (Temoignage::count() === 0) {
            $temoignages = [
                ['nom_parent' => 'Mme Koné Adjoua', 'role_parent' => "Maman d'Ange, CP1", 'initiales' => 'KA',
                 'bg_color' => 'bg-violet-600', 'note' => 5,
                 'texte' => "Mon fils est épanoui depuis qu'il est à Victoria-Koa. Les enseignants sont attentionnés et l'ambiance est vraiment familiale. Je recommande cette école à tous les parents !"],
                ['nom_parent' => 'M. Traoré Seydou', 'role_parent' => 'Papa de Fatoumata, CE1', 'initiales' => 'TS',
                 'bg_color' => 'bg-amber-500', 'note' => 5,
                 'texte' => "Nous avons choisi Victoria-Koa pour la qualité de l'enseignement et nous n'avons pas été déçus. Ma fille a fait d'énormes progrès en lecture et en mathématiques."],
                ['nom_parent' => 'Mme Bamba Aminata', 'role_parent' => 'Maman de Junior, MS', 'initiales' => 'BA',
                 'bg_color' => 'bg-pink-500', 'note' => 5,
                 'texte' => "L'équipe pédagogique est vraiment dévouée. Le suivi individualisé de chaque enfant est remarquable. On se sent vraiment écouté en tant que parent."],
                ['nom_parent' => 'M. Coulibaly Ibrahim', 'role_parent' => 'Papa de Youssouf, GS', 'initiales' => 'CI',
                 'bg_color' => 'bg-teal-500', 'note' => 5,
                 'texte' => "Victoria-Koa c'est bien plus qu'une école, c'est une famille. Mon enfant pleure quand il ne peut pas y aller ! Les activités périscolaires sont fantastiques."],
            ];
            foreach ($temoignages as $t) {
                Temoignage::create(array_merge($t, ['publie' => true]));
            }
        }

        // ── Settings ──────────────────────────────────────────────
        $defaults = [
            ['cle' => 'telephone_1',    'valeur' => '(+225) 07 67 48 55 94', 'groupe' => 'contact'],
            ['cle' => 'telephone_2',    'valeur' => '(+225) 01 43 23 84 82', 'groupe' => 'contact'],
            ['cle' => 'email_direction','valeur' => 'direction@gsvictoriakoa.ci', 'groupe' => 'contact'],
            ['cle' => 'email_secondaire','valeur' => 'victoria-koa1965@gmail.com', 'groupe' => 'contact'],
            ['cle' => 'facebook_url',   'valeur' => 'https://www.facebook.com/CM.VICTORIA.KOA/', 'groupe' => 'contact'],
            ['cle' => 'adresse',        'valeur' => 'Angré 9ème Tranche CNPS en haut, face Pâtisserie MARY\'S, Abidjan', 'groupe' => 'localisation'],
            ['cle' => 'gps',            'valeur' => '92HH+H98, Voie Djibi, Abidjan', 'groupe' => 'localisation'],
            ['cle' => 'rentree_date',          'valeur' => '09-01',                          'groupe' => 'ecole'],
            ['cle' => 'inscription_ouverte',   'valeur' => 'Inscriptions ouvertes',          'groupe' => 'ecole'],
            ['cle' => 'horaire_jours',         'valeur' => 'Lundi · Mardi · Jeudi · Vendredi','groupe' => 'horaires'],
            ['cle' => 'horaire_matin_debut',   'valeur' => '7h45',                           'groupe' => 'horaires'],
            ['cle' => 'horaire_matin_fin',     'valeur' => '11h45',                          'groupe' => 'horaires'],
            ['cle' => 'horaire_apm_debut',     'valeur' => '13h45',                          'groupe' => 'horaires'],
            ['cle' => 'horaire_apm_fin',       'valeur' => '15h45',                          'groupe' => 'horaires'],
            ['cle' => 'horaire_accueil',       'valeur' => '7h30',                           'groupe' => 'horaires'],
            ['cle' => 'horaire_jours_fermes',  'valeur' => 'Mercredi · Samedi · Dimanche',   'groupe' => 'horaires'],
        ];
        foreach ($defaults as $s) {
            Setting::firstOrCreate(['cle' => $s['cle']], ['valeur' => $s['valeur'], 'groupe' => $s['groupe']]);
        }
    }
}

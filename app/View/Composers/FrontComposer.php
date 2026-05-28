<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

/**
 * Injects common site settings into every front-end view that extends layouts.app.
 * One DB query per page (all settings fetched once via pluck).
 */
class FrontComposer
{
    public function compose(View $view): void
    {
        // Load all settings in one query, keyed by `cle`
        $all = Setting::pluck('valeur', 'cle');

        $view->with('site', [
            'telephone_1'       => $all->get('telephone_1',       '(+225) 07 67 48 55 94'),
            'telephone_2'       => $all->get('telephone_2',       '(+225) 01 43 23 84 82'),
            'email_direction'   => $all->get('email_direction',   'direction@gsvictoriakoa.ci'),
            'email_secondaire'  => $all->get('email_secondaire',  'victoria-koa1965@gmail.com'),
            'facebook_url'      => $all->get('facebook_url',      'https://facebook.com/CM.VICTORIA.KOA/'),
            'adresse'           => $all->get('adresse',           'Angré 9ème Tranche CNPS en haut, face Pâtisserie MARY\'S, Abidjan'),
            'gps'               => $all->get('gps',               '92HH+H98, Voie Djibi, Abidjan'),
            'inscription_ouverte' => filter_var($all->get('inscription_ouverte', '1'), FILTER_VALIDATE_BOOLEAN),
            'annee_scolaire'    => Setting::schoolYear(),
        ]);
    }
}

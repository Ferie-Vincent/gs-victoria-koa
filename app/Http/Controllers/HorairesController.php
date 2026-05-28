<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class HorairesController extends Controller
{
    public function index()
    {
        $horaires = [
            'jours'        => Setting::get('horaire_jours',        'Lundi · Mardi · Jeudi · Vendredi'),
            'matin_debut'  => Setting::get('horaire_matin_debut',  '7h45'),
            'matin_fin'    => Setting::get('horaire_matin_fin',    '11h45'),
            'apm_debut'    => Setting::get('horaire_apm_debut',    '13h45'),
            'apm_fin'      => Setting::get('horaire_apm_fin',      '15h45'),
            'accueil'      => Setting::get('horaire_accueil',      '7h30'),
            'jours_fermes' => Setting::get('horaire_jours_fermes', 'Mercredi · Samedi · Dimanche'),
        ];

        return view('pages.horaires', compact('horaires'));
    }
}

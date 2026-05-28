<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class FournituresController extends Controller
{
    public function index()
    {
        $annee = Setting::schoolYear();

        $levels = [
            ['code' => 'TPS', 'name' => 'Toute Petite Section',            'pdf' => "TPS-{$annee}.pdf",  'color' => '#7C3AED', 'bg' => '#EDE9FE', 'cycle' => 'Maternelle'],
            ['code' => 'PS',  'name' => 'Petite Section',                   'pdf' => "PS-{$annee}.pdf",   'color' => '#DB2777', 'bg' => '#FCE7F3', 'cycle' => 'Maternelle'],
            ['code' => 'MS',  'name' => 'Moyenne Section',                  'pdf' => "MS-{$annee}.pdf",   'color' => '#0F766E', 'bg' => '#CCFBF1', 'cycle' => 'Maternelle'],
            ['code' => 'GS',  'name' => 'Grande Section',                   'pdf' => "GS-{$annee}.pdf",   'color' => '#D97706', 'bg' => '#FEF9C3', 'cycle' => 'Maternelle'],
            ['code' => 'CP',  'name' => 'Cours Préparatoire (CP1 & CP2)',   'pdf' => "CP-{$annee}.pdf",   'color' => '#F97316', 'bg' => '#FFEDD5', 'cycle' => 'Primaire'],
            ['code' => 'CE1', 'name' => 'Cours Élémentaire 1ère année',    'pdf' => "CE1-{$annee}.pdf",  'color' => '#14B8A6', 'bg' => '#CCFBF1', 'cycle' => 'Primaire'],
            ['code' => 'CE2', 'name' => 'Cours Élémentaire 2ème année',    'pdf' => "CE2-{$annee}.pdf",  'color' => '#9333EA', 'bg' => '#F3E8FF', 'cycle' => 'Primaire'],
            ['code' => 'CM1', 'name' => 'Cours Moyen 1ère année',          'pdf' => "CM1-{$annee}.pdf",  'color' => '#1D4ED8', 'bg' => '#DBEAFE', 'cycle' => 'Primaire'],
            ['code' => 'CM2', 'name' => 'Cours Moyen 2ème année',          'pdf' => "CM2-{$annee}.pdf",  'color' => '#0369A1', 'bg' => '#E0F2FE', 'cycle' => 'Primaire'],
        ];

        return view('pages.fournitures', compact('levels', 'annee'));
    }
}

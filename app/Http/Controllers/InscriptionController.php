<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class InscriptionController extends Controller
{
    public function index()
    {
        $annee = Setting::schoolYear();
        return view('pages.inscription', compact('annee'));
    }
}

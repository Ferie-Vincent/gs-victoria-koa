<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('groupe')->orderBy('cle')->get()->groupBy('groupe');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate(['settings' => 'array']);

        $allowed = [
            'telephone_1', 'telephone_2', 'email_direction', 'email_secondaire',
            'facebook_url', 'adresse', 'gps', 'rentree_date', 'inscription_ouverte',
            'horaire_jours', 'horaire_accueil', 'horaire_matin_debut', 'horaire_matin_fin',
            'horaire_apm_debut', 'horaire_apm_fin', 'horaire_jours_fermes',
        ];

        foreach ($request->input('settings', []) as $key => $value) {
            if (in_array($key, $allowed, true)) {
                Setting::set($key, $value);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres enregistrés.');
    }
}

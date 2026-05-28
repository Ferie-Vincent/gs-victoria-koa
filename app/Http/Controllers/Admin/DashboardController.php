<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Temoignage;
use App\Models\ContactMessage;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'nbActualites'      => Actualite::count(),
            'nbTemoignages'     => Temoignage::count(),
            'nbMessages'        => ContactMessage::count(),
            'nbNonLus'          => ContactMessage::where('lu', false)->count(),
            'recentActualites'  => Actualite::orderByDesc('date_publication')->limit(4)->get(),
            'recentMessages'    => ContactMessage::orderByDesc('created_at')->limit(5)->get(),
            'inscriptionOuverte'=> filter_var(Setting::get('inscription_ouverte', '1'), FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}

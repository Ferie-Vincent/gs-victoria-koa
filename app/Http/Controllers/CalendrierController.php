<?php

namespace App\Http\Controllers;

use App\Models\CalendrierEvent;
use App\Models\Setting;

class CalendrierController extends Controller
{
    public function index()
    {
        $annee  = Setting::schoolYear();
        $rows   = CalendrierEvent::orderBy('ordre')->where('type', '!=', 'ferie')->get();
        $feries = CalendrierEvent::orderBy('ordre')->where('type', 'ferie')->get();

        return view('pages.calendrier', compact('annee', 'rows', 'feries'));
    }
}

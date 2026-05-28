<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Temoignage;

class HomeController extends Controller
{
    public function index()
    {
        $recentNews = Actualite::publie()
            ->orderByDesc('date_publication')
            ->limit(3)
            ->get();

        $temoignages = Temoignage::publie()
            ->orderBy('id')
            ->get();

        return view('pages.home', compact('recentNews', 'temoignages'));
    }
}

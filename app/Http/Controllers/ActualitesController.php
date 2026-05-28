<?php

namespace App\Http\Controllers;

use App\Models\Actualite;

class ActualitesController extends Controller
{
    public function index()
    {
        $articles = Actualite::publie()
            ->orderByDesc('date_publication')
            ->get();

        $categories = $articles->pluck('categorie')->unique()->sort()->values()->toArray();

        return view('pages.actualites', compact('articles', 'categories'));
    }

    public function show(Actualite $actualite)
    {
        abort_unless($actualite->publie, 404);

        $autres = Actualite::publie()
            ->where('id', '!=', $actualite->id)
            ->orderByDesc('date_publication')
            ->limit(3)
            ->get();

        return view('pages.actualite-detail', compact('actualite', 'autres'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public function index()
    {
        // Catégories par pattern de nom de fichier
        $categoryMap = [
            'CV5I'       => 'pro',      // Photos pro 2023 (photographe)
            '20260128'   => 'vie',      // Journée scolaire janvier 2026
        ];

        $photos = collect(glob(public_path('images/gallery/*.{jpg,jpeg,png,webp}'), GLOB_BRACE))
            ->map(function ($path) use ($categoryMap) {
                $basename = basename($path);
                $category = 'all';
                foreach ($categoryMap as $pattern => $cat) {
                    if (str_starts_with($basename, $pattern)) {
                        $category = $cat;
                        break;
                    }
                }
                return [
                    'src'      => '/images/gallery/' . $basename,
                    'thumb'    => '/images/gallery/' . $basename,
                    'alt'      => "Photo de l'école GS Victoria-Koa",
                    'category' => $category,
                ];
            })
            ->sortBy('src')
            ->values()
            ->toArray();

        // Only expose categories that actually have photos
        $categories = collect($photos)
            ->pluck('category')
            ->filter(fn($c) => $c !== 'all')
            ->unique()
            ->values()
            ->toArray();

        return view('pages.galleries', compact('photos', 'categories'));
    }
}

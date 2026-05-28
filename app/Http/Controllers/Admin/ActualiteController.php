<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::orderByDesc('date_publication')->paginate(15);
        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        return redirect()->route('admin.actualites.index', ['create' => 1]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'            => 'required|string|max:255',
            'categorie'        => 'required|string|max:100',
            'badge_bg'         => 'required|string|max:100',
            'date_publication' => 'required|date',
            'extrait'          => 'required|string|max:500',
            'contenu'          => 'nullable|string',
            'publie'           => 'boolean',
            'photos'           => 'nullable|array|max:10',
            'photos.*'         => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['publie'] = $request->has('publie');
        $data['images'] = $this->uploadPhotos($request, []);

        // Première photo devient l'image principale (legacy)
        $data['image'] = $data['images'][0] ?? null;

        unset($data['photos']);
        Actualite::create($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité créée.');
    }

    public function edit(Actualite $actualite)
    {
        return redirect()->route('admin.actualites.index', ['edit_id' => $actualite->id]);
    }

    public function update(Request $request, Actualite $actualite)
    {
        $data = $request->validate([
            'titre'            => 'required|string|max:255',
            'categorie'        => 'required|string|max:100',
            'badge_bg'         => 'required|string|max:100',
            'date_publication' => 'required|date',
            'extrait'          => 'required|string|max:500',
            'contenu'          => 'nullable|string',
            'publie'           => 'boolean',
            'keep_images'      => 'nullable|array',
            'keep_images.*'    => 'string',
            'photos'           => 'nullable|array|max:10',
            'photos.*'         => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['publie'] = $request->has('publie');

        // Photos conservées + nouvelles uploadées
        $kept    = $request->input('keep_images', []);
        $newOnes = $this->uploadPhotos($request, []);
        $data['images'] = array_values(array_merge($kept, $newOnes));

        // Supprimer du disque les photos retirées
        $removed = array_diff($actualite->all_photos, $data['images']);
        foreach ($removed as $path) {
            $abs = public_path($path);
            if (File::exists($abs)) File::delete($abs);
        }

        $data['image'] = $data['images'][0] ?? null;
        unset($data['photos'], $data['keep_images']);

        $actualite->update($data);
        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        // Supprime les photos du disque
        foreach ($actualite->all_photos as $path) {
            $abs = public_path($path);
            if (File::exists($abs)) File::delete($abs);
        }

        $actualite->delete();
        return redirect()->route('admin.actualites.index')->with('success', 'Actualité supprimée.');
    }

    private function uploadPhotos(Request $request, array $existing): array
    {
        if (! $request->hasFile('photos')) return $existing;

        $dir = public_path('images/actualites');
        File::ensureDirectoryExists($dir);

        $paths = $existing;
        foreach ($request->file('photos') as $photo) {
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move($dir, $filename);
            $paths[] = '/images/actualites/' . $filename;
        }
        return $paths;
    }
}

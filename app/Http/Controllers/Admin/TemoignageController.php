<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::orderByDesc('created_at')->paginate(15);
        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return redirect()->route('admin.temoignages.index', ['create' => 1]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_parent'  => 'required|string|max:255',
            'role_parent' => 'required|string|max:255',
            'initiales'   => 'required|string|max:5',
            'bg_color'    => 'required|string|max:100',
            'texte'       => 'required|string',
            'note'        => 'required|integer|min:1|max:5',
            'publie'      => 'boolean',
        ]);
        $data['publie'] = $request->has('publie');

        Temoignage::create($data);
        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage créé.');
    }

    public function edit(Temoignage $temoignage)
    {
        return redirect()->route('admin.temoignages.index', ['edit_id' => $temoignage->id]);
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $request->validate([
            'nom_parent'  => 'required|string|max:255',
            'role_parent' => 'required|string|max:255',
            'initiales'   => 'required|string|max:5',
            'bg_color'    => 'required|string|max:100',
            'texte'       => 'required|string',
            'note'        => 'required|integer|min:1|max:5',
            'publie'      => 'boolean',
        ]);
        $data['publie'] = $request->has('publie');

        $temoignage->update($data);
        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();
        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage supprimé.');
    }
}

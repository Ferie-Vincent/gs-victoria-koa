<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendrierEvent;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    public function index()
    {
        $allEvents  = CalendrierEvent::orderBy('ordre')->get();
        $eventsJson = CalendrierEvent::orderBy('date_debut')->get()->map(fn($e) => [
            'id'         => $e->id,
            'label'      => $e->label,
            'type'       => $e->type,
            'date_debut' => $e->date_debut?->format('Y-m-d'),
            'date_fin'   => $e->date_fin?->format('Y-m-d'),
            'icone'      => $e->icone,
        ]);
        return view('admin.calendrier.index', compact('allEvents', 'eventsJson'));
    }

    public function create()
    {
        $event = new CalendrierEvent();
        return view('admin.calendrier.form', compact('event'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'         => 'required|string|max:255',
            'date_debut'    => 'nullable|date',
            'date_fin'      => 'nullable|date|after_or_equal:date_debut',
            'date_affichee' => 'nullable|string|max:255',
            'duree'         => 'nullable|string|max:50',
            'type'          => 'required|in:classes,vacances,conges,rentree,ferie',
            'icone'         => 'required|string|max:100',
            'ordre'         => 'required|integer|min:0',
        ]);

        CalendrierEvent::create($data);

        return redirect()->route('admin.calendrier.index')
            ->with('success', 'Événement ajouté au calendrier.');
    }

    public function edit(CalendrierEvent $calendrier)
    {
        return view('admin.calendrier.form', ['event' => $calendrier]);
    }

    public function update(Request $request, CalendrierEvent $calendrier)
    {
        $data = $request->validate([
            'label'         => 'required|string|max:255',
            'date_debut'    => 'nullable|date',
            'date_fin'      => 'nullable|date|after_or_equal:date_debut',
            'date_affichee' => 'nullable|string|max:255',
            'duree'         => 'nullable|string|max:50',
            'type'          => 'required|in:classes,vacances,conges,rentree,ferie',
            'icone'         => 'required|string|max:100',
            'ordre'         => 'required|integer|min:0',
        ]);

        $calendrier->update($data);

        return redirect()->route('admin.calendrier.index')
            ->with('success', 'Événement mis à jour.');
    }

    public function destroy(CalendrierEvent $calendrier)
    {
        $calendrier->delete();
        return redirect()->route('admin.calendrier.index')
            ->with('success', 'Événement supprimé.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    // Document definitions — code => [label, path, filename]
    private function catalogue(): array
    {
        $annee = Setting::schoolYear();
        $anneeInsc = Setting::schoolYear();

        return [
            'fournitures' => [
                'label' => 'Fournitures scolaires',
                'items' => [
                    ['code' => 'TPS', 'label' => 'Toute Petite Section (TPS)', 'file' => "TPS-{$annee}.pdf", 'dir' => 'fournitures'],
                    ['code' => 'PS',  'label' => 'Petite Section (PS)',          'file' => "PS-{$annee}.pdf",  'dir' => 'fournitures'],
                    ['code' => 'MS',  'label' => 'Moyenne Section (MS)',         'file' => "MS-{$annee}.pdf",  'dir' => 'fournitures'],
                    ['code' => 'GS',  'label' => 'Grande Section (GS)',          'file' => "GS-{$annee}.pdf",  'dir' => 'fournitures'],
                    ['code' => 'CP',  'label' => 'Cours Préparatoire (CP1+CP2)', 'file' => "CP-{$annee}.pdf",  'dir' => 'fournitures'],
                    ['code' => 'CE1', 'label' => 'CE1',                          'file' => "CE1-{$annee}.pdf", 'dir' => 'fournitures'],
                    ['code' => 'CE2', 'label' => 'CE2',                          'file' => "CE2-{$annee}.pdf", 'dir' => 'fournitures'],
                    ['code' => 'CM1', 'label' => 'CM1',                          'file' => "CM1-{$annee}.pdf", 'dir' => 'fournitures'],
                    ['code' => 'CM2', 'label' => 'CM2',                          'file' => "CM2-{$annee}.pdf", 'dir' => 'fournitures'],
                ],
            ],
            'inscriptions' => [
                'label' => 'Inscription',
                'items' => [
                    ['code' => 'insc-mat',  'label' => 'Fiche inscription Maternelle', 'file' => "fiche-inscription-maternelle-{$anneeInsc}.pdf", 'dir' => 'inscriptions'],
                    ['code' => 'insc-prim', 'label' => 'Fiche inscription Primaire',   'file' => "fiche-inscription-primaire-{$anneeInsc}.pdf",   'dir' => 'inscriptions'],
                    ['code' => 'medical',   'label' => 'Fiche médicale',               'file' => 'fiche-medicale.pdf',                           'dir' => 'inscriptions'],
                    ['code' => 'vaccin',    'label' => 'Certificat de vaccination',    'file' => 'certificat-vaccination.pdf',                   'dir' => 'inscriptions'],
                ],
            ],
            'calendrier' => [
                'label' => 'Calendrier scolaire',
                'items' => [
                    ['code' => 'calendrier', 'label' => "Calendrier scolaire {$anneeInsc}", 'file' => "calendrier-scolaire-{$anneeInsc}.pdf", 'dir' => 'calendrier'],
                ],
            ],
        ];
    }

    public function index()
    {
        $catalogue = $this->catalogue();

        // Augment each item with file status
        foreach ($catalogue as &$group) {
            foreach ($group['items'] as &$item) {
                $path = public_path('documents/' . $item['dir'] . '/' . $item['file']);
                $item['exists']  = File::exists($path);
                $item['size']    = $item['exists'] ? $this->humanSize(File::size($path)) : null;
                $item['updated'] = $item['exists'] ? date('d/m/Y', File::lastModified($path)) : null;
                $item['url']     = '/documents/' . $item['dir'] . '/' . $item['file'];
            }
        }
        unset($group, $item);

        return view('admin.documents.index', compact('catalogue'));
    }

    public function upload(Request $request, string $code)
    {
        $request->validate(['pdf' => 'required|file|mimes:pdf|max:10240']);

        // Find the item by code
        $found = null;
        foreach ($this->catalogue() as $group) {
            foreach ($group['items'] as $item) {
                if ($item['code'] === $code) { $found = $item; break 2; }
            }
        }

        if (! $found) abort(404);

        $dir = public_path('documents/' . $found['dir']);
        File::ensureDirectoryExists($dir);

        $request->file('pdf')->move($dir, basename($found['file']));

        return redirect()->route('admin.documents.index')
            ->with('success', "PDF « {$found['label']} » mis à jour.");
    }

    private function humanSize(int $bytes): string
    {
        if ($bytes < 1024) return $bytes . ' o';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' Ko';
        return round($bytes / 1048576, 1) . ' Mo';
    }
}

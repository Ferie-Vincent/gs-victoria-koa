<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendrierEvent extends Model
{
    protected $fillable = [
        'label', 'date_debut', 'date_fin', 'date_affichee', 'duree', 'type', 'icone', 'ordre',
    ];

    protected $casts = [
        'ordre'      => 'integer',
        'date_debut' => 'date',
        'date_fin'   => 'date',
    ];

    /** Styles Tailwind par type */
    public function getStylesAttribute(): array
    {
        return match($this->type) {
            'vacances' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-800', 'badge' => 'bg-orange-100 text-orange-700'],
            'conges'   => ['bg' => 'bg-sky-50',    'text' => 'text-sky-800',    'badge' => 'bg-sky-100 text-sky-700'],
            'rentree'  => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-800', 'badge' => 'bg-yellow-100 text-yellow-700'],
            'ferie'    => ['bg' => 'bg-amber-50',  'text' => 'text-amber-900',  'badge' => 'bg-amber-100 text-amber-700'],
            default    => ['bg' => 'bg-purple-50', 'text' => 'text-purple-800', 'badge' => 'bg-purple-100 text-purple-700'],
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    protected $fillable = [
        'nom_parent', 'role_parent', 'initiales', 'bg_color', 'texte', 'note', 'publie',
    ];

    protected $casts = [
        'publie' => 'boolean',
        'note'   => 'integer',
    ];

    public function scopePublie($query)
    {
        return $query->where('publie', true);
    }
}

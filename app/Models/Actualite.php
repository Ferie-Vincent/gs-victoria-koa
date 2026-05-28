<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    protected $fillable = [
        'titre', 'categorie', 'badge_bg', 'date_publication',
        'image', 'images', 'extrait', 'contenu', 'publie',
    ];

    protected $casts = [
        'date_publication' => 'date',
        'publie'           => 'boolean',
        'images'           => 'array',
    ];

    /** Toutes les photos (images[] + image legacy fusionnées, sans doublons) */
    public function getAllPhotosAttribute(): array
    {
        $multi  = $this->images ?? [];
        $legacy = $this->image ? [$this->image] : [];
        return array_values(array_unique(array_merge($multi, $legacy)));
    }

    public function scopePublie($query)
    {
        return $query->where('publie', true);
    }

    public function getDateFormatteAttribute(): string
    {
        return $this->date_publication->translatedFormat('j F Y');
    }
}

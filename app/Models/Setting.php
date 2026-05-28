<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['cle', 'valeur', 'groupe'];

    public static function get(string $key, string $default = ''): string
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            return static::where('cle', $key)->value('valeur') ?? $default;
        });
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['cle' => $key], ['valeur' => $value]);
        Cache::forget("setting_{$key}");
    }

    /**
     * Returns the current school year (e.g. "2025-2026") computed automatically
     * from the "rentree_date" setting (format MM-DD, default 09-01).
     *
     * After the rentrée date  → YYYY / YYYY+1
     * Before the rentrée date → YYYY-1 / YYYY
     */
    public static function schoolYear(): string
    {
        $raw = static::get('rentree_date', '09-01'); // MM-DD
        [$month, $day] = array_map('intval', explode('-', $raw . '-01'));

        $today = Carbon::today();
        $rentreeThisYear = Carbon::create($today->year, $month, $day);

        if ($today->gte($rentreeThisYear)) {
            return $today->year . '-' . ($today->year + 1);
        }

        return ($today->year - 1) . '-' . $today->year;
    }
}

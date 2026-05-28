<?php

namespace Tests\Unit;

use App\Models\Actualite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ActualiteTest extends TestCase
{
    use RefreshDatabase;

    private function makeActualite(array $attrs = []): Actualite
    {
        return new Actualite(array_merge([
            'titre'            => 'Titre test',
            'categorie'        => 'Vie scolaire',
            'badge_bg'         => 'bg-blue-100',
            'date_publication' => '2025-09-15',
            'extrait'          => 'Un extrait de test.',
            'publie'           => true,
        ], $attrs));
    }

    // ─── getDateFormatteAttribute() ───────────────────────────────────
    // Note : attribut accessible via ->date_formatte (un seul 'e' final)

    public function test_date_formatte_returns_non_empty_string(): void
    {
        $actualite = $this->makeActualite(['date_publication' => '2025-09-15']);
        $actualite->save();

        $formatted = $actualite->fresh()->date_formatte;

        $this->assertIsString($formatted);
        $this->assertNotEmpty($formatted);
    }

    public function test_date_formatte_contains_year(): void
    {
        $actualite = $this->makeActualite(['date_publication' => '2025-09-15']);
        $actualite->save();

        $this->assertStringContainsString('2025', $actualite->fresh()->date_formatte);
    }

    public function test_date_formatte_contains_day(): void
    {
        $actualite = $this->makeActualite(['date_publication' => '2025-09-15']);
        $actualite->save();

        $this->assertStringContainsString('15', $actualite->fresh()->date_formatte);
    }

    // ─── Formatage direct (utilisé dans les vues) ─────────────────────

    public function test_date_publication_can_be_formatted_for_views(): void
    {
        $actualite = $this->makeActualite(['date_publication' => '2025-09-15']);
        $actualite->save();

        $formatted = $actualite->fresh()->date_publication->format('j F Y');

        $this->assertIsString($formatted);
        $this->assertStringContainsString('15', $formatted);
        $this->assertStringContainsString('2025', $formatted);
    }

    // ─── scopePublie() ────────────────────────────────────────────────

    public function test_scope_publie_returns_only_published(): void
    {
        Actualite::create($this->makeActualite(['publie' => true])->toArray());
        Actualite::create($this->makeActualite(['publie' => false])->toArray());

        $results = Actualite::publie()->get();

        $this->assertCount(1, $results);
        $this->assertTrue((bool) $results->first()->publie);
    }

    public function test_scope_publie_returns_empty_when_none_published(): void
    {
        Actualite::create($this->makeActualite(['publie' => false])->toArray());

        $this->assertCount(0, Actualite::publie()->get());
    }

    public function test_scope_publie_returns_all_when_all_published(): void
    {
        Actualite::create($this->makeActualite()->toArray());
        Actualite::create($this->makeActualite(['titre' => 'Deuxième'])->toArray());

        $this->assertCount(2, Actualite::publie()->get());
    }

    // ─── Casts ────────────────────────────────────────────────────────

    public function test_publie_is_cast_to_boolean(): void
    {
        $actualite = $this->makeActualite(['publie' => true]);
        $actualite->save();

        $fresh = Actualite::find($actualite->id);

        $this->assertIsBool($fresh->publie);
    }

    public function test_date_publication_is_cast_to_carbon(): void
    {
        $actualite = $this->makeActualite(['date_publication' => '2025-09-15']);
        $actualite->save();

        $fresh = Actualite::find($actualite->id);

        $this->assertInstanceOf(Carbon::class, $fresh->date_publication);
    }
}

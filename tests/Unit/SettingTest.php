<?php

namespace Tests\Unit;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    // ─── schoolYear() ─────────────────────────────────────────────────

    public function test_school_year_returns_current_next_when_after_rentree(): void
    {
        Carbon::setTestNow('2025-09-15'); // après la rentrée (01 sept par défaut)

        $this->assertSame('2025-2026', Setting::schoolYear());
    }

    public function test_school_year_returns_prev_current_when_before_rentree(): void
    {
        Carbon::setTestNow('2025-06-01'); // avant la rentrée

        $this->assertSame('2024-2025', Setting::schoolYear());
    }

    public function test_school_year_on_exact_rentree_date_counts_as_after(): void
    {
        Carbon::setTestNow('2025-09-01'); // le jour J

        $this->assertSame('2025-2026', Setting::schoolYear());
    }

    public function test_school_year_respects_custom_rentree_date_setting(): void
    {
        Setting::set('rentree_date', '10-01'); // rentrée le 1er octobre
        Cache::flush();

        Carbon::setTestNow('2025-09-15'); // avant le 1er octobre

        $this->assertSame('2024-2025', Setting::schoolYear());
    }

    public function test_school_year_after_custom_rentree_date(): void
    {
        Setting::set('rentree_date', '10-01');
        Cache::flush();

        Carbon::setTestNow('2025-10-02'); // après le 1er octobre

        $this->assertSame('2025-2026', Setting::schoolYear());
    }

    // ─── get() / set() ────────────────────────────────────────────────

    public function test_get_returns_default_when_key_missing(): void
    {
        $result = Setting::get('inexistant', 'valeur_defaut');

        $this->assertSame('valeur_defaut', $result);
    }

    public function test_get_returns_value_from_database(): void
    {
        Setting::create(['cle' => 'telephone_1', 'valeur' => '0700000000']);

        $this->assertSame('0700000000', Setting::get('telephone_1', 'fallback'));
    }

    public function test_set_creates_new_setting(): void
    {
        Setting::set('nouvelle_cle', 'nouvelle_valeur');

        $this->assertDatabaseHas('settings', [
            'cle'    => 'nouvelle_cle',
            'valeur' => 'nouvelle_valeur',
        ]);
    }

    public function test_set_updates_existing_setting(): void
    {
        Setting::create(['cle' => 'email_direction', 'valeur' => 'old@example.com']);

        Setting::set('email_direction', 'new@example.com');

        $this->assertDatabaseCount('settings', 1);
        $this->assertDatabaseHas('settings', ['valeur' => 'new@example.com']);
    }

    public function test_set_invalidates_cache(): void
    {
        Setting::set('telephone_1', 'premiere_valeur');
        Setting::get('telephone_1'); // charge dans le cache

        Setting::set('telephone_1', 'deuxieme_valeur');

        $this->assertSame('deuxieme_valeur', Setting::get('telephone_1'));
    }
}

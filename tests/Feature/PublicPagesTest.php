<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('publicRoutes')]
    public function test_public_page_returns_200(string $route): void
    {
        $response = $this->get(route($route));

        $response->assertStatus(200);
    }

    public static function publicRoutes(): array
    {
        return [
            'accueil'      => ['home'],
            'à propos'     => ['about'],
            'classes'      => ['classes'],
            'horaires'     => ['horaires'],
            'fournitures'  => ['fournitures'],
            'calendrier'   => ['calendrier'],
            'inscription'  => ['inscription'],
            'galeries'     => ['galleries'],
            'actualités'   => ['actualites'],
            'contact'      => ['contact'],
        ];
    }

    public function test_home_page_contains_school_name(): void
    {
        $response = $this->get(route('home'));

        $response->assertSee('VICTORIA');
    }
}

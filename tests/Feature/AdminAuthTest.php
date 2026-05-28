<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'email'    => 'admin@gsvictoriakoa.ci',
            'password' => Hash::make('secret123'),
        ], $overrides));
    }

    // ─── Accès page login ────────────────────────────────────────────

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_is_redirected_from_login_page(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    // ─── Authentification ────────────────────────────────────────────

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $this->createAdmin();

        $response = $this->post(route('admin.login.post'), [
            'email'    => 'admin@gsvictoriakoa.ci',
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->createAdmin();

        $response = $this->post(route('admin.login.post'), [
            'email'    => 'admin@gsvictoriakoa.ci',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_fails_with_unknown_email(): void
    {
        $response = $this->post(route('admin.login.post'), [
            'email'    => 'inconnu@example.com',
            'password' => 'secret123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_requires_email_field(): void
    {
        $response = $this->post(route('admin.login.post'), [
            'password' => 'secret123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // ─── Déconnexion ─────────────────────────────────────────────────

    public function test_admin_can_logout(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)
             ->post(route('admin.logout'));

        $this->assertGuest();
    }

    public function test_logout_redirects_to_login_page(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
                         ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
    }

    // ─── Protection des routes ────────────────────────────────────────

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_messages_index_requires_authentication(): void
    {
        $response = $this->get(route('admin.messages.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_actualites_index_requires_authentication(): void
    {
        $response = $this->get(route('admin.actualites.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }
}

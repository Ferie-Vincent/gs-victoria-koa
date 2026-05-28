<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMessagesTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create();
    }

    private function createMessage(array $overrides = []): ContactMessage
    {
        return ContactMessage::create(array_merge([
            'nom'       => 'Coulibaly Binta',
            'email'     => 'binta@example.com',
            'telephone' => null,
            'sujet'     => 'Question horaires',
            'message'   => 'Quels sont les horaires de la maternelle ?',
            'lu'        => false,
        ], $overrides));
    }

    // ─── Liste des messages ───────────────────────────────────────────

    public function test_messages_list_displays_messages(): void
    {
        $this->createMessage(['nom' => 'Traoré Fatou']);

        $response = $this->actingAs($this->admin())
                         ->get(route('admin.messages.index'));

        $response->assertStatus(200);
        $response->assertSee('Traoré Fatou');
    }

    public function test_messages_list_is_empty_when_no_messages(): void
    {
        $response = $this->actingAs($this->admin())
                         ->get(route('admin.messages.index'));

        $response->assertStatus(200);
    }

    // ─── Détail d'un message ──────────────────────────────────────────

    public function test_viewing_message_marks_it_as_read(): void
    {
        $message = $this->createMessage(['lu' => false]);

        $this->actingAs($this->admin())
             ->get(route('admin.messages.show', $message));

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'lu' => true,
        ]);
    }

    public function test_message_show_displays_content(): void
    {
        $message = $this->createMessage(['sujet' => 'Sujet test unique']);

        $response = $this->actingAs($this->admin())
                         ->get(route('admin.messages.show', $message));

        $response->assertStatus(200);
        $response->assertSee('Sujet test unique');
    }

    public function test_show_returns_404_for_nonexistent_message(): void
    {
        $response = $this->actingAs($this->admin())
                         ->get(route('admin.messages.show', 9999));

        $response->assertStatus(404);
    }

    // ─── Suppression ──────────────────────────────────────────────────

    public function test_admin_can_delete_message(): void
    {
        $message = $this->createMessage();

        $this->actingAs($this->admin())
             ->delete(route('admin.messages.destroy', $message));

        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_delete_redirects_to_index_with_success(): void
    {
        $message = $this->createMessage();

        $response = $this->actingAs($this->admin())
                         ->delete(route('admin.messages.destroy', $message));

        $response->assertRedirect(route('admin.messages.index'));
        $response->assertSessionHas('success');
    }

    public function test_delete_returns_404_for_nonexistent_message(): void
    {
        $response = $this->actingAs($this->admin())
                         ->delete(route('admin.messages.destroy', 9999));

        $response->assertStatus(404);
    }

    // ─── Protection ───────────────────────────────────────────────────

    public function test_guest_cannot_delete_message(): void
    {
        $message = $this->createMessage();

        $this->delete(route('admin.messages.destroy', $message));

        $this->assertDatabaseHas('contact_messages', ['id' => $message->id]);
    }
}

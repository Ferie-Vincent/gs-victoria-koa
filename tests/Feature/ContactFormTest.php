<?php

namespace Tests\Feature;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    private array $validPayload = [
        'name'    => 'Koné Aminata',
        'email'   => 'aminata@example.com',
        'phone'   => '07 00 00 00 00',
        'sujet'   => 'Inscription CP1',
        'message' => 'Bonjour, je souhaite inscrire mon fils pour la rentrée prochaine.',
    ];

    public function test_valid_submission_saves_message_in_database(): void
    {
        Mail::fake();

        $this->post(route('contact.send'), $this->validPayload);

        $this->assertDatabaseHas('contact_messages', [
            'nom'   => 'Koné Aminata',
            'email' => 'aminata@example.com',
            'sujet' => 'Inscription CP1',
        ]);
    }

    public function test_valid_submission_sends_email_to_school(): void
    {
        Mail::fake();

        $this->post(route('contact.send'), $this->validPayload);

        Mail::assertSent(ContactFormMail::class, function ($mail) {
            return $mail->hasTo('direction@gsvictoriakoa.ci');
        });
    }

    public function test_valid_submission_redirects_with_success_message(): void
    {
        Mail::fake();

        $response = $this->post(route('contact.send'), $this->validPayload);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_phone_is_optional(): void
    {
        Mail::fake();

        $payload = $this->validPayload;
        unset($payload['phone']);

        $response = $this->post(route('contact.send'), $payload);

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_messages', ['telephone' => null]);
    }

    public function test_missing_name_fails_validation(): void
    {
        $payload = $this->validPayload;
        unset($payload['name']);

        $response = $this->post(route('contact.send'), $payload);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_invalid_email_fails_validation(): void
    {
        $payload = array_merge($this->validPayload, ['email' => 'not-an-email']);

        $response = $this->post(route('contact.send'), $payload);

        $response->assertSessionHasErrors('email');
    }

    public function test_message_too_short_fails_validation(): void
    {
        $payload = array_merge($this->validPayload, ['message' => 'Court']);

        $response = $this->post(route('contact.send'), $payload);

        $response->assertSessionHasErrors('message');
    }

    public function test_message_too_long_fails_validation(): void
    {
        $payload = array_merge($this->validPayload, ['message' => str_repeat('a', 2001)]);

        $response = $this->post(route('contact.send'), $payload);

        $response->assertSessionHasErrors('message');
    }

    public function test_mail_failure_does_not_prevent_db_save(): void
    {
        Mail::shouldReceive('to')->andThrow(new \Exception('SMTP error'));

        $this->post(route('contact.send'), $this->validPayload);

        $this->assertDatabaseHas('contact_messages', ['email' => 'aminata@example.com']);
    }

    public function test_new_message_is_marked_unread_by_default(): void
    {
        Mail::fake();

        $this->post(route('contact.send'), $this->validPayload);

        $this->assertDatabaseHas('contact_messages', ['lu' => false]);
    }
}

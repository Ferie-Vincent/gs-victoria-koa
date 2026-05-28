<?php

namespace Tests\Unit;

use App\Mail\ContactFormMail;
use Illuminate\Mail\Mailables\Address;
use Tests\TestCase;

class ContactFormMailTest extends TestCase
{
    private array $data = [
        'name'    => 'Koné Aminata',
        'email'   => 'aminata@example.com',
        'phone'   => '07 00 00 00 00',
        'sujet'   => 'Inscription CP1',
        'message' => 'Bonjour, je souhaite inscrire mon fils.',
    ];

    // ─── Envelope (sujet + reply-to) ──────────────────────────────────

    public function test_subject_contains_school_name(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertStringContainsString('GS VICTORIA-KOA', $mail->envelope()->subject);
    }

    public function test_subject_contains_sender_name(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertStringContainsString('Koné Aminata', $mail->envelope()->subject);
    }

    public function test_reply_to_uses_sender_email(): void
    {
        $mail = new ContactFormMail($this->data);

        $replyTo = $mail->envelope()->replyTo;

        $this->assertCount(1, $replyTo);
        $this->assertInstanceOf(Address::class, $replyTo[0]);
        $this->assertSame('aminata@example.com', $replyTo[0]->address);
    }

    public function test_reply_to_uses_sender_name(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertSame('Koné Aminata', $mail->envelope()->replyTo[0]->name);
    }

    public function test_subject_changes_with_different_sender(): void
    {
        $mail = new ContactFormMail(array_merge($this->data, ['name' => 'Traoré Binta']));

        $this->assertStringContainsString('Traoré Binta', $mail->envelope()->subject);
    }

    // ─── Content (vue) ────────────────────────────────────────────────

    public function test_content_uses_contact_view(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertSame('emails.contact', $mail->content()->view);
    }

    // ─── Data exposée à la vue ────────────────────────────────────────

    public function test_data_is_accessible_as_public_property(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertSame($this->data, $mail->data);
    }

    public function test_data_preserves_all_fields(): void
    {
        $mail = new ContactFormMail($this->data);

        $this->assertArrayHasKey('name', $mail->data);
        $this->assertArrayHasKey('email', $mail->data);
        $this->assertArrayHasKey('sujet', $mail->data);
        $this->assertArrayHasKey('message', $mail->data);
    }
}

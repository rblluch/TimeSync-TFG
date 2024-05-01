<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de registro',
        );
    }

    /**
     * Get the message content definition.
     */
    /* public function content(): Content
    {
        return new Content(
            markdown: 'emails.registration',
            data: [
                'url' => config('app.url') . '/confirm-registration/' . $this->token,
            ],
        );
    } */

    /**
 * Get the message content definition.
 */
    public function content(): Content
    {
        return (new Content)
            ->markdown('emails.registration')
            ->with('url', config('app.url') . '/confirm-registration/' . $this->token);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

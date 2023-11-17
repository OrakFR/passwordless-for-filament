<?php

namespace BrunoPincaro\PasswordlessForFilament\Mail;

use BrunoPincaro\PasswordlessForFilament\PasswordlessForFilamentMagicLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PasswordlessForFilamentMagicLinkVerification extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $email, public PasswordlessForFilamentMagicLink $magicLink)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('passwordless-for-filament::passwordless-for-filament.mail.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'passwordless-for-filament::emails.magic-link.verification',
            with: [
                'email' => $this->email,
                'url' => $this->magicLink->getUrl(),
                'expiry' => $this->magicLink->getExpiry(),
            ],
        );
    }
}
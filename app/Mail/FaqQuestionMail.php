<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FaqQuestionMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama;
    public string $email;
    public string $pertanyaan;

    public function __construct(
        string $nama,
        string $email,
        string $pertanyaan
    ) {
        $this->nama = $nama;
        $this->email = $email;
        $this->pertanyaan = $pertanyaan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pertanyaan Baru dari Website PPMPP',
            replyTo: [
                $this->email => $this->nama,
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.faq-question',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

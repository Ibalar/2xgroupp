<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequest $contactRequest
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая заявка со страницы контактов - 2xGroupp',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-form',
            with: [
                'name' => $this->contactRequest->name,
                'phone' => $this->contactRequest->phone,
                'email' => $this->contactRequest->email,
                'message' => $this->contactRequest->message,
                'created_at' => $this->contactRequest->created_at,
            ],
        );
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;


class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
   public function __construct(public Contact $contact)
{
}

public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Nouveau message de contact : ' . $this->contact->subject,
    );
}

public function content(): Content
{
    return new Content(
        view: 'emails.contact-message',
    );
}
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Enrollment;


class EnrollmentConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Enrollment $enrollment)
{
}

public function envelope(): Envelope
{
    return new Envelope(
        subject: 'Confirmation de votre inscription',
    );
}

public function content(): Content
{
    return new Content(
        view: 'emails.enrollment-confirmed',
    );
}
}

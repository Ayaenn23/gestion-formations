<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\TrainingSession;
use App\Models\User;



class SessionReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public TrainingSession $session,
        public User $user
    ) {}
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rappel : Votre session commence bientôt !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.session-reminder',
        );
    }
}

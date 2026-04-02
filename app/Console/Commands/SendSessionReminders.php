<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TrainingSession;
use App\Mail\SessionReminderMail;
use Illuminate\Support\Facades\Mail;

class SendSessionReminders extends Command
{
    protected $signature = 'sessions:send-reminders';
    protected $description = 'Envoie un rappel email aux participants 2 jours avant leur session';

    public function handle(): void
    {
        // Récupère toutes les sessions qui commencent dans exactement 2 jours
        $sessions = TrainingSession::whereDate('start_date', now()->addDays(2)->toDateString())
            ->with('enrollments.user', 'formation')
            ->get();

        foreach ($sessions as $session) {
            foreach ($session->enrollments as $enrollment) {
                // Seulement les inscriptions confirmées
                if ($enrollment->statut->value === 'confirmée') {
                    Mail::to($enrollment->user->email)
                        ->send(new SessionReminderMail($session, $enrollment->user));
                }
            }
        }

        $this->info('Rappels envoyés pour ' . $sessions->count() . ' session(s).');
    }
}

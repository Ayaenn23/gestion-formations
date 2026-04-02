<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Chaque jour à 8h du matin → envoie les rappels
        $schedule->command('sessions:send-reminders')->dailyAt('08:00');

        // Chaque nuit à minuit → archive les formations terminées
        $schedule->command('formations:archive-completed')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

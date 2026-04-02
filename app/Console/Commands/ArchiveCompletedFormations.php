<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Formation;
use App\Models\TrainingSession;
use App\Enums\FormationStatus;

class ArchiveCompletedFormations extends Command
{
    protected $signature = 'formations:archive-completed';
    protected $description = 'Archive automatiquement les formations dont toutes les sessions sont terminées';

    public function handle(): void
    {
        // Récupère les formations publiées
        $formations = Formation::where('statut', FormationStatus::Publie->value)
            ->with('trainingSessions')
            ->get();

        $archived = 0;

        foreach ($formations as $formation) {
            // Si toutes les sessions sont terminées ou annulées
            $allDone = $formation->trainingSessions->isNotEmpty() &&
                $formation->trainingSessions->every(function ($session) {
                    return in_array($session->statut, ['terminée', 'annulée']);
                });

            if ($allDone) {
                $formation->update(['statut' => FormationStatus::Archive->value]);
                $archived++;
            }
        }

        $this->info("$archived formation(s) archivée(s) automatiquement.");
    }
}

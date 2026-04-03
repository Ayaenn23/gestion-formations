<?php

namespace Database\Factories;

use App\Models\TrainingSession;
use App\Models\User;
use App\Enums\EnrollmentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        $statut = fake()->randomElement(EnrollmentStatus::cases())->value;

        return [
            'user_id'             => User::inRandomOrder()->first()->id,
            'training_session_id' => TrainingSession::inRandomOrder()->first()->id,
            'enrollment_ref'      => 'ENR-' . strtoupper(Str::random(8)),
            'statut'              => $statut,
            'note'                => fake()->optional()->sentence(),
            'confirmation_date'   => $statut === 'confirmée' ? now() : null,
            'cancellation_date'   => $statut === 'annulée' ? now() : null,
        ];
    }
}

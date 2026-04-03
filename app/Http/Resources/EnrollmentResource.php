<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'enrollment_ref' => $this->enrollment_ref,
            'statut'         => $this->statut->value,
            'note'           => $this->note,
            'confirmation_date'  => $this->confirmation_date,
            'cancellation_date'  => $this->cancellation_date,
            'session'        => [
                'id'         => $this->trainingSession->id ?? null,
                'start_date' => $this->trainingSession->start_date ?? null,
                'formation'  => $this->trainingSession->formation->titre_fr ?? null,
            ],
        ];
    }
}

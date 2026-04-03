<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'titre_fr'             => $this->titre_fr,
            'titre_en'             => $this->titre_en,
            'slug_fr'              => $this->slug_fr,
            'slug_en'              => $this->slug_en,
            'description_courte_fr'=> $this->description_courte_fr,
            'description_courte_en'=> $this->description_courte_en,
            'prix'                 => $this->prix ? format_price($this->prix) : null,
            'duree'                => $this->duree,
            'niveau'               => $this->niveau,
            'statut'               => $this->statut->value,
            'date_publication'     => $this->date_publication,
            'categorie'            => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}

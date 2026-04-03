<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FormationResource;
use App\Models\Formation;

class FormationController extends Controller
{
    // GET /api/formations
    public function index()
    {
        $formations = Formation::where('statut', 'publié')
            ->with('category')
            ->get();

        return FormationResource::collection($formations);
    }

    // GET /api/formations/{slug}
    public function show(string $slug)
    {
        $formation = Formation::where('slug_fr', $slug)
            ->orWhere('slug_en', $slug)
            ->with('category', 'trainingSessions')
            ->firstOrFail();

        return new FormationResource($formation);
    }
}

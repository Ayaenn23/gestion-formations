<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;
use App\Models\TrainingSession;
use App\Enums\EnrollmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    // GET /api/enrollments (inscriptions du participant connecté)
    public function index(Request $request)
    {
        $enrollments = Enrollment::where('user_id', $request->user()->id)
            ->with('trainingSession.formation')
            ->get();

        return EnrollmentResource::collection($enrollments);
    }

    // POST /api/enrollments (créer une inscription)
    public function store(Request $request)
    {
        $request->validate([
            'training_session_id' => 'required|exists:training_sessions,id',
        ]);

        // Vérifie si déjà inscrit
        $exists = Enrollment::where('user_id', $request->user()->id)
            ->where('training_session_id', $request->training_session_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Vous êtes déjà inscrit à cette session.'
            ], 422); // 422 = données incorrectes
        }

        $enrollment = Enrollment::create([
            'user_id'             => $request->user()->id,
            'training_session_id' => $request->training_session_id,
            'enrollment_ref'      => 'ENR-' . strtoupper(Str::random(8)),
            'statut'              => EnrollmentStatus::EnAttente->value,
        ]);

        return new EnrollmentResource($enrollment->load('trainingSession.formation'));
    }
}

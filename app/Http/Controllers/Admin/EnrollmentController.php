<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\TrainingSession;
use App\Models\User;
use App\Enums\EnrollmentStatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnrollmentConfirmedMail;
use App\Mail\EnrollmentCancelledMail;


class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('user', 'trainingSession.formation')->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $sessions = TrainingSession::with('formation')->get();
        $users = User::role('participant')->get();
        return view('admin.enrollments.create', compact('sessions', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'training_session_id' => 'required|exists:training_sessions,id',
        ]);

        Enrollment::create([
            'user_id' => $request->user_id,
            'training_session_id' => $request->training_session_id,
            'enrollment_ref' => 'ENR-' . strtoupper(Str::random(8)),
            'statut' => EnrollmentStatus::EnAttente->value,
            'note' => $request->note,
        ]);

        return redirect()->route('admin.enrollments.index')->with('success', 'Inscription créée !');
    }

    public function edit(Enrollment $enrollment)
    {
        $statuts = EnrollmentStatus::cases();
        return view('admin.enrollments.edit', compact('enrollment', 'statuts'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'statut' => 'required',
        ]);

        $data = ['statut' => $request->statut, 'note' => $request->note];

        if ($request->statut === EnrollmentStatus::Confirmee->value) {
            $data['confirmation_date'] = now();
        }

        if ($request->statut === EnrollmentStatus::Annulee->value) {
            $data['cancellation_date'] = now();
        }

        if ($request->statut === EnrollmentStatus::Confirmee->value) {
            $data['confirmation_date'] = now();
            Mail::to($enrollment->user->email)->send(new EnrollmentConfirmedMail($enrollment));
        }

        if ($request->statut === EnrollmentStatus::Annulee->value) {
            $data['cancellation_date'] = now();
            Mail::to($enrollment->user->email)->send(new EnrollmentCancelledMail($enrollment));
        }

        $enrollment->update($data);

        return redirect()->route('admin.enrollments.index')->with('success', 'Inscription modifiée !');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.enrollments.index')->with('success', 'Inscription supprimée !');
    }
}

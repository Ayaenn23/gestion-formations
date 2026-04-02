<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\Formation;
use App\Models\User;
use App\Enums\SessionMode;

class TrainingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = TrainingSession::with('formation', 'trainer')->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $formations = Formation::all();
        $trainers = User::role('formateur')->get();
        $modes = SessionMode::cases();
        return view('admin.sessions.create', compact('formations', 'trainers', 'modes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'trainer_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'nullable|integer',
            'mode' => 'required',
            'statut' => 'required',
        ]);

        TrainingSession::create($request->except('_token'));

        return redirect()->route('admin.sessions.index')->with('success', 'Session créée !');
    }

    public function edit(TrainingSession $session)
    {
        $formations = Formation::all();
        $trainers = User::role('formateur')->get();
        $modes = SessionMode::cases();
        return view('admin.sessions.edit', compact('session', 'formations', 'trainers', 'modes'));
    }

    public function update(Request $request, TrainingSession $session)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'trainer_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'nullable|integer',
            'mode' => 'required',
            'statut' => 'required',
        ]);

        $session->update($request->except('_token', '_method'));

        return redirect()->route('admin.sessions.index')->with('success', 'Session modifiée !');
    }

    public function destroy(TrainingSession $session)
    {
        $session->delete();
        return redirect()->route('admin.sessions.index')->with('success', 'Session supprimée !');
    }
}

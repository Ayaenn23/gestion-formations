<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Formation;

class FormationController extends Controller
{
    public function index(string $locale)
    {
        session(['locale' => $locale]);
        $formations = Formation::where('statut', 'publié')->with('category')->get();
        return view('public.formations.index', compact('formations'));
    }

    public function show(string $locale, string $slug)
    {
        session(['locale' => $locale]);
        $slugField = $locale == 'fr' ? 'slug_fr' : 'slug_en';
        $formation = Formation::where($slugField, $slug)->with('category', 'trainingSessions')->firstOrFail();
        return view('public.formations.show', compact('formation'));
    }
}

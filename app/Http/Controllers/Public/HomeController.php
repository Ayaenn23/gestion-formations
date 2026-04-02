<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(string $locale)
    {
        session(['locale' => $locale]);
        app()->setLocale($locale);

        $formations = Formation::where('statut', 'publié')->take(6)->get();
        $posts = Post::where('statut', 'publié')->take(3)->get();

        return view('public.home', compact('formations', 'posts'));
    }
}

<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function index(string $locale)
    {
        session(['locale' => $locale]);
        $posts = Post::where('statut', 'publié')->with('category', 'author')->get();
        return view('public.blog.index', compact('posts'));
    }

    public function show(string $locale, string $slug)
    {
        session(['locale' => $locale]);
        $slugField = $locale == 'fr' ? 'slug_fr' : 'slug_en';
        $post = Post::where($slugField, $slug)->with('author', 'category')->firstOrFail();
        return view('public.blog.show', compact('post'));
    }
}

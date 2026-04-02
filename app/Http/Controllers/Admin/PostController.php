<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'author')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'statut' => 'required',
        ]);

        $data = $request->except('_token');
        $data['author_id'] = auth()->id();

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Article créé !');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title_fr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'statut' => 'required',
        ]);

        $post->update($request->except('_token', '_method'));

        return redirect()->route('admin.posts.index')->with('success', 'Article modifié !');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Article supprimé !');
    }
}

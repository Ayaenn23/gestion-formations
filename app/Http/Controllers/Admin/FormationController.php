<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Category;
use App\Enums\FormationStatus;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::with('category')->get();
        return view('admin.formations.index', compact('formations'));
    }

    public function create()
    {
        $categories = Category::all();
        $statuts = FormationStatus::cases();
        return view('admin.formations.create', compact('categories', 'statuts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_fr' => 'required|string|max:255',
            'titre_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prix' => 'nullable|numeric',
            'statut' => 'required|in:brouillon,publié,archivé',
        ]);

        $data = $request->except('_token', 'image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        Formation::create($data);

        return redirect()->route('admin.formations.index')->with('success', 'Formation créée !');
    }

    public function edit(Formation $formation)
    {
        $categories = Category::all();
        $statuts = FormationStatus::cases();
        return view('admin.formations.edit', compact('formation', 'categories', 'statuts'));
    }

    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'titre_fr' => 'required|string|max:255',
            'titre_en' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prix' => 'nullable|numeric',
            'statut' => 'required|in:brouillon,publié,archivé',
        ]);

        $data = $request->except('_token', '_method', 'image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('formations', 'public');
        }

        $formation->update($data);

        return redirect()->route('admin.formations.index')->with('success', 'Formation modifiée !');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('admin.formations.index')->with('success', 'Formation supprimée !');
    }
}

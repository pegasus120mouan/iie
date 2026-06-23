<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::with('category')->latest()->paginate(15);

        return view('admin.formations.index', compact('formations'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.formations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateFormation($request);
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('formations', 'public');
        }

        Formation::create($validated);

        return redirect()->route('admin.formations.index')->with('success', 'Formation créée avec succès.');
    }

    public function edit(Formation $formation)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.formations.edit', compact('formation', 'categories'));
    }

    public function update(Request $request, Formation $formation)
    {
        $validated = $this->validateFormation($request);
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('formations', 'public');
        }

        $formation->update($validated);

        return redirect()->route('admin.formations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('admin.formations.index')->with('success', 'Formation supprimée.');
    }

    private function validateFormation(Request $request): array
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'level_required' => 'nullable|string|max:255',
            'certification' => 'nullable|string|max:255',
            'debouches' => 'nullable|string',
            'programme' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if (! empty($validated['programme'])) {
            $validated['programme'] = array_filter(array_map('trim', explode("\n", $validated['programme'])));
        }

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }
}

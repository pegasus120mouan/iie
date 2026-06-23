<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Support\HtmlSanitizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::latest()->paginate(15);

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        return view('admin.actualites.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateActualite($request);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($validated);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité créée.');
    }

    public function edit(Actualite $actualite)
    {
        return view('admin.actualites.edit', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $validated = $this->validateActualite($request);
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($validated);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        $actualite->delete();

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité supprimée.');
    }

    private function validateActualite(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'type' => 'required|in:blog,evenement,seminaire,atelier,concours',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['content'] = HtmlSanitizer::clean($validated['content']);

        return $validated;
    }
}

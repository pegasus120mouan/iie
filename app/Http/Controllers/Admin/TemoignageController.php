<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::orderBy('sort_order')->paginate(15);

        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('admin.temoignages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateTemoignage($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('temoignages', 'public');
        }

        Temoignage::create($validated);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage créé.');
    }

    public function edit(Temoignage $temoignage)
    {
        return view('admin.temoignages.edit', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $validated = $this->validateTemoignage($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('temoignages', 'public');
        }

        $temoignage->update($validated);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage supprimé.');
    }

    private function validateTemoignage(Request $request): array
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'formation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }
}

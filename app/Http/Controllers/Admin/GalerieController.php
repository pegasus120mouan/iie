<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalerieController extends Controller
{
    public function index()
    {
        $galeries = Galerie::orderBy('sort_order')->paginate(20);

        return view('admin.galeries.index', compact('galeries'));
    }

    public function create()
    {
        return view('admin.galeries.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateGalerie($request);
        $validated['file_path'] = $request->file('file')->store('galeries', 'public');

        Galerie::create($validated);

        return redirect()->route('admin.galeries.index')->with('success', 'Élément ajouté à la galerie.');
    }

    public function edit(Galerie $galerie)
    {
        return view('admin.galeries.edit', compact('galerie'));
    }

    public function update(Request $request, Galerie $galerie)
    {
        $validated = $this->validateGalerie($request, false);

        if ($request->hasFile('file')) {
            $this->deleteFile($galerie->file_path);
            $validated['file_path'] = $request->file('file')->store('galeries', 'public');
        }

        $galerie->update($validated);

        return redirect()->route('admin.galeries.index')->with('success', 'Élément mis à jour.');
    }

    public function destroy(Galerie $galerie)
    {
        $this->deleteFile($galerie->file_path);
        $galerie->delete();

        return redirect()->route('admin.galeries.index')->with('success', 'Élément supprimé.');
    }

    private function validateGalerie(Request $request, bool $requireFile = true): array
    {
        $type = $request->input('type', 'photo');

        $fileRules = match ($type) {
            'video' => ['file', 'mimes:mp4,webm', 'max:20480'],
            default => ['file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        };

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'type' => 'required|in:photo,video',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];

        if ($requireFile) {
            $rules['file'] = array_merge(['required'], $fileRules);
        } else {
            $rules['file'] = array_merge(['nullable'], $fileRules);
        }

        $validated = $request->validate($rules);
        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

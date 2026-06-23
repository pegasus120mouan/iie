<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedPopup;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeaturedPopupController extends Controller
{
    public function index()
    {
        $popups = FeaturedPopup::with('formation')->latest()->paginate(15);

        return view('admin.featured-popups.index', compact('popups'));
    }

    public function create()
    {
        $promotionFormation = Formation::promotion();

        return view('admin.featured-popups.create', compact('promotionFormation'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePopup($request, true);
        $validated['formation_id'] = Formation::promotion()->id;
        $validated = $this->applyFormationLink($validated);

        $validated['image'] = $request->file('image')->store('featured-popups', 'public');
        $validated['is_active'] = $request->boolean('is_active');

        $popup = FeaturedPopup::create($validated);

        if ($popup->is_active) {
            $popup->activate();
        }

        return redirect()->route('admin.featured-popups.index')
            ->with('success', 'Formation en vue ajoutée.');
    }

    public function edit(FeaturedPopup $featuredPopup)
    {
        $promotionFormation = Formation::promotion();

        return view('admin.featured-popups.edit', compact('featuredPopup', 'promotionFormation'));
    }

    public function update(Request $request, FeaturedPopup $featuredPopup)
    {
        $validated = $this->validatePopup($request, false);
        $validated['formation_id'] = Formation::promotion()->id;
        $validated = $this->applyFormationLink($validated);

        if ($request->hasFile('image')) {
            $this->deleteImage($featuredPopup->image);
            $validated['image'] = $request->file('image')->store('featured-popups', 'public');
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $featuredPopup->update($validated);

        if ($featuredPopup->is_active) {
            $featuredPopup->activate();
        }

        return redirect()->route('admin.featured-popups.index')
            ->with('success', 'Formation en vue mise à jour.');
    }

    public function destroy(FeaturedPopup $featuredPopup)
    {
        $this->deleteImage($featuredPopup->image);
        $featuredPopup->delete();

        return redirect()->route('admin.featured-popups.index')
            ->with('success', 'Formation en vue supprimée.');
    }

    public function toggle(FeaturedPopup $featuredPopup)
    {
        if ($featuredPopup->is_active) {
            $featuredPopup->deactivate();

            return back()->with('success', 'Popup désactivée.');
        }

        $featuredPopup->activate();

        return back()->with('success', 'Popup activée sur le site.');
    }

    private function validatePopup(Request $request, bool $requireImage): array
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];

        $rules['image'] = $requireImage
            ? 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
            : 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';

        return $request->validate($rules);
    }

    private function applyFormationLink(array $validated): array
    {
        $formation = Formation::find($validated['formation_id']);
        $validated['link'] = ($formation && $formation->slug !== Formation::PROMOTION_SLUG)
            ? route('formations.show', $formation->slug)
            : null;

        return $validated;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

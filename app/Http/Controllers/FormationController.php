<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index(Request $request)
    {
        $query = Formation::with('category')->where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        $formations = $query->orderBy('sort_order')->paginate(9);
        $categories = Category::where('is_active', true)->withCount('formations')->orderBy('sort_order')->get();

        return view('pages.formations.index', compact('formations', 'categories'));
    }

    public function show(string $slug)
    {
        $formation = Formation::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $related = Formation::where('category_id', $formation->category_id)
            ->where('id', '!=', $formation->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('pages.formations.show', compact('formation', 'related'));
    }
}

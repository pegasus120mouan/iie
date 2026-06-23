<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Actualite::where('is_published', true);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $actualites = $query->latest()->paginate(9);
        $types = ['blog', 'evenement', 'seminaire', 'atelier', 'concours'];

        return view('pages.actualites.index', compact('actualites', 'types'));
    }

    public function show(string $slug)
    {
        $actualite = Actualite::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $related = Actualite::where('is_published', true)
            ->where('id', '!=', $actualite->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.actualites.show', compact('actualite', 'related'));
    }
}

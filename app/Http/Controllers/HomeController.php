<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Formation;
use App\Models\Temoignage;

class HomeController extends Controller
{
    public function index()
    {
        $formations = Formation::with('category')
            ->where('is_active', true)
            ->where('is_popular', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $temoignages = Temoignage::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $actualites = Actualite::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.home', compact('formations', 'temoignages', 'actualites'));
    }
}

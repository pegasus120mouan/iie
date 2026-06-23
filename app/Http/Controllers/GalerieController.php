<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function index(Request $request)
    {
        $query = Galerie::where('is_active', true);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $galeries = $query->orderBy('sort_order')->paginate(12);

        return view('pages.galerie', compact('galeries'));
    }
}

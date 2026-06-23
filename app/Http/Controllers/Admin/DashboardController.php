<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Formation;
use App\Models\Galerie;
use App\Models\Inscription;
use App\Models\Paiement;
use App\Models\Temoignage;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'inscriptions_total' => Inscription::count(),
            'inscriptions_mois' => Inscription::whereMonth('created_at', now()->month)->count(),
            'formations_total' => Formation::where('is_active', true)->count(),
            'contacts_non_lus' => Contact::where('is_read', false)->count(),
            'revenus' => Paiement::where('statut', 'valide')->sum('montant'),
        ];

        $formationsPopulaires = Formation::withCount('inscriptions')
            ->orderByDesc('inscriptions_count')
            ->take(5)
            ->get();

        $repartitionCategories = Category::withCount(['formations' => fn ($q) => $q->whereHas('inscriptions')])
            ->get()
            ->map(fn ($cat) => [
                'name' => $cat->name,
                'count' => Inscription::whereHas('formation', fn ($q) => $q->where('category_id', $cat->id))->count(),
            ]);

        $inscriptionsRecentes = Inscription::with('formation')
            ->latest()
            ->take(10)
            ->get();

        $inscriptionsParMois = Inscription::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'formationsPopulaires',
            'repartitionCategories',
            'inscriptionsRecentes',
            'inscriptionsParMois'
        ));
    }
}

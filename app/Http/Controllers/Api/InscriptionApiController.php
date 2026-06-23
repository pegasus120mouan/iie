<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InscriptionResource;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InscriptionApiController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'statut' => 'nullable|in:en_attente,validee,refusee,annulee',
            'formation_id' => 'nullable|integer|exists:formations,id',
            'search' => 'nullable|string|max:255',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'updated_since' => 'nullable|date',
            'per_page' => 'nullable|integer|min:1|max:100',
            'sort' => 'nullable|in:created_at,-created_at,updated_at,-updated_at',
        ]);

        $perPage = min((int) $request->input('per_page', 25), 100);
        $sort = $request->input('sort', '-created_at');
        $direction = str_starts_with($sort, '-') ? 'desc' : 'asc';
        $column = ltrim($sort, '-');

        $query = Inscription::query()
            ->with(['formation.category'])
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->statut))
            ->when($request->filled('formation_id'), fn ($q) => $q->where('formation_id', $request->formation_id))
            ->when($request->filled('from_date'), fn ($q) => $q->whereDate('created_at', '>=', $request->from_date))
            ->when($request->filled('to_date'), fn ($q) => $q->whereDate('created_at', '<=', $request->to_date))
            ->when($request->filled('updated_since'), fn ($q) => $q->where('updated_at', '>=', $request->updated_since))
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->where(function ($inner) use ($search) {
                    $inner->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenoms', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('numero_dossier', 'like', "%{$search}%")
                        ->orWhere('telephone', 'like', "%{$search}%");
                });
            })
            ->orderBy($column, $direction);

        return InscriptionResource::collection($query->paginate($perPage));
    }

    public function show(Inscription $inscription): InscriptionResource
    {
        $inscription->load(['formation.category']);

        return new InscriptionResource($inscription);
    }

    public function showByNumero(string $numero): InscriptionResource
    {
        $inscription = Inscription::with(['formation.category'])
            ->where('numero_dossier', $numero)
            ->firstOrFail();

        return new InscriptionResource($inscription);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Inscription::with('formation');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('numero_dossier', 'like', "%{$search}%")
                    ->orWhere('nom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $inscriptions = $query->latest()->paginate(20);

        return view('admin.inscriptions.index', compact('inscriptions'));
    }

    public function show(Inscription $inscription)
    {
        $inscription->load(['formation', 'paiements']);

        return view('admin.inscriptions.show', compact('inscription'));
    }

    public function update(Request $request, Inscription $inscription)
    {
        $validated = $request->validate([
            'statut' => 'required|in:en_attente,validee,refusee,annulee',
            'notes' => 'nullable|string',
        ]);

        $inscription->update($validated);

        return back()->with('success', 'Inscription mise à jour.');
    }

    public function destroy(Inscription $inscription)
    {
        $inscription->delete();

        return redirect()->route('admin.inscriptions.index')->with('success', 'Inscription supprimée.');
    }
}

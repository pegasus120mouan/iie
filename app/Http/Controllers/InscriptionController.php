<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionAdminNotification;
use App\Mail\InscriptionConfirmation;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InscriptionController extends Controller
{
    public function create(Request $request)
    {
        $formations = Formation::where('is_active', true)->orderBy('name')->get();
        $selectedFormation = $request->get('formation');

        return view('pages.inscription', compact('formations', 'selectedFormation'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'date_naissance' => 'required|date|before:today',
            'sexe' => 'required|in:M,F',
            'telephone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:500',
            'niveau_etude' => 'required|string|max:255',
            'formation_id' => 'required|exists:formations,id',
        ]);

        $validated['numero_dossier'] = Inscription::generateNumeroDossier();

        $inscription = Inscription::create($validated);
        $inscription->load('formation');

        Mail::to($inscription->email)->send(new InscriptionConfirmation($inscription));

        Mail::to(config('iie.email'))->send(new InscriptionAdminNotification($inscription));

        return redirect()->route('inscription.success', $inscription->numero_dossier)
            ->with('success', 'Votre inscription a été enregistrée avec succès !');
    }

    public function success(string $numero)
    {
        $inscription = Inscription::with('formation')
            ->where('numero_dossier', $numero)
            ->firstOrFail();

        return view('pages.inscription-success', compact('inscription'));
    }
}

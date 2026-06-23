<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionAdminNotification;
use App\Mail\InscriptionConfirmation;
use App\Models\Formation;
use App\Models\Inscription;
use App\Support\Honeypot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
        if (Honeypot::isBot($request)) {
            return redirect()->route('inscription.create')
                ->with('success', 'Votre inscription a été enregistrée avec succès !');
        }

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

        $inscription = Inscription::create([
            'numero_dossier' => Inscription::generateNumeroDossier(),
            'formation_id' => $validated['formation_id'],
            'nom' => $validated['nom'],
            'prenoms' => $validated['prenoms'],
            'date_naissance' => $validated['date_naissance'],
            'sexe' => $validated['sexe'],
            'telephone' => $validated['telephone'],
            'whatsapp' => $validated['whatsapp'] ?? null,
            'email' => $validated['email'],
            'adresse' => $validated['adresse'],
            'niveau_etude' => $validated['niveau_etude'],
            'statut' => 'en_attente',
        ]);

        $inscription->load('formation');

        Mail::to($inscription->email)->send(new InscriptionConfirmation($inscription));

        Mail::to(config('iie.email'))->send(new InscriptionAdminNotification($inscription));

        $successUrl = URL::temporarySignedRoute(
            'inscription.success',
            now()->addDays(7),
            ['numero' => $inscription->numero_dossier]
        );

        return redirect($successUrl)
            ->with('success', 'Votre inscription a été enregistrée avec succès !');
    }

    public function success(Request $request, string $numero)
    {
        $inscription = Inscription::with('formation')
            ->where('numero_dossier', $numero)
            ->firstOrFail();

        return view('pages.inscription-success', compact('inscription'));
    }
}

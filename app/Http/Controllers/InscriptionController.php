<?php

namespace App\Http\Controllers;

use App\Mail\InscriptionAdminNotification;
use App\Mail\InscriptionConfirmation;
use App\Models\Formation;
use App\Models\FeaturedPopup;
use App\Models\Inscription;
use App\Support\Honeypot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class InscriptionController extends Controller
{
    public function create(Request $request)
    {
        $formations = Formation::publicCatalog()->where('is_active', true)->orderBy('name')->get();
        $selectedFormation = $request->get('formation');
        $formationLocked = false;
        $featuredPopupId = null;
        $promotion = null;

        if (old('featured_popup_id')) {
            $popup = FeaturedPopup::with('formation')->find(old('featured_popup_id'));
            if ($popup && (int) $popup->formation_id === (int) old('formation_id', $selectedFormation)) {
                $formationLocked = true;
                $featuredPopupId = $popup->id;
                $selectedFormation = $popup->formation_id;
                $promotion = $popup;
            }
        } elseif ($request->query('from') === 'featured') {
            $activePopup = FeaturedPopup::active();
            if ($activePopup?->formation_id && (int) $selectedFormation === (int) $activePopup->formation_id) {
                $formationLocked = true;
                $featuredPopupId = $activePopup->id;
                $promotion = $activePopup;
            }
        }

        return view('pages.inscription', compact(
            'formations',
            'selectedFormation',
            'formationLocked',
            'featuredPopupId',
            'promotion',
        ));
    }

    public function createFromFeatured(string $slug)
    {
        $promotion = FeaturedPopup::with('formation')->where('slug', $slug)->firstOrFail();

        if (! $promotion->formation_id) {
            abort(404);
        }

        $formations = Formation::publicCatalog()->where('is_active', true)->orderBy('name')->get();
        $selectedFormation = $promotion->formation_id;
        $formationLocked = true;
        $featuredPopupId = $promotion->id;

        return view('pages.inscription', compact(
            'formations',
            'selectedFormation',
            'formationLocked',
            'featuredPopupId',
            'promotion',
        ));
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
            'sexe' => 'required|in:M,F',
            'telephone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:500',
            'niveau_etude' => 'required|string|max:255',
            'formation_id' => 'required|exists:formations,id',
            'featured_popup_id' => 'nullable|exists:featured_popups,id',
        ]);

        $featuredPopupId = null;
        if (! empty($validated['featured_popup_id'])) {
            $popup = FeaturedPopup::find($validated['featured_popup_id']);
            if (! $popup || (int) $popup->formation_id !== (int) $validated['formation_id']) {
                return back()
                    ->withInput()
                    ->withErrors(['formation_id' => 'La formation sélectionnée ne correspond pas à la promotion en cours.']);
            }
            $featuredPopupId = $popup->id;
        }

        $inscription = Inscription::create([
            'numero_dossier' => Inscription::generateNumeroDossier(),
            'formation_id' => $validated['formation_id'],
            'featured_popup_id' => $featuredPopupId,
            'nom' => $validated['nom'],
            'prenoms' => $validated['prenoms'],
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

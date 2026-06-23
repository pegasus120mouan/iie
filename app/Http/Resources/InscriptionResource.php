<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero_dossier' => $this->numero_dossier,
            'statut' => $this->statut,
            'nom' => $this->nom,
            'prenoms' => $this->prenoms,
            'nom_complet' => $this->full_name,
            'date_naissance' => $this->date_naissance?->format('Y-m-d'),
            'sexe' => $this->sexe,
            'telephone' => $this->telephone,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'adresse' => $this->adresse,
            'niveau_etude' => $this->niveau_etude,
            'notes' => $this->notes,
            'formation' => $this->whenLoaded('formation', fn () => [
                'id' => $this->formation->id,
                'nom' => $this->formation->name,
                'slug' => $this->formation->slug,
                'categorie' => $this->formation->category?->name,
            ]),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}

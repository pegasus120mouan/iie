<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscription extends Model
{
    protected $fillable = [
        'numero_dossier', 'formation_id', 'featured_popup_id', 'nom', 'prenoms', 'date_naissance',
        'sexe', 'telephone', 'whatsapp', 'email', 'adresse', 'niveau_etude',
        'photo', 'piece_identite', 'statut', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'date_naissance' => 'date',
        ];
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function featuredPopup(): BelongsTo
    {
        return $this->belongsTo(FeaturedPopup::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->nom} {$this->prenoms}";
    }

    public static function generateNumeroDossier(): string
    {
        $year = date('Y');
        $last = static::whereYear('created_at', $year)->count() + 1;

        return sprintf('IIE-%s-%05d', $year, $last);
    }
}

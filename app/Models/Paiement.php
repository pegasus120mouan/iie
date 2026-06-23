<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $fillable = [
        'inscription_id', 'montant', 'mode', 'statut', 'reference', 'date_paiement', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'montant' => 'decimal:2',
            'date_paiement' => 'date',
        ];
    }

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actualite extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'image', 'type',
        'event_date', 'location', 'is_published', 'is_featured', 'user_id',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'blog' => 'Blog',
            'evenement' => 'Événement',
            'seminaire' => 'Séminaire',
            'atelier' => 'Atelier',
            'concours' => 'Concours',
            default => $this->type,
        };
    }
}

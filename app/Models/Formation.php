<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Formation extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'short_description',
        'duration', 'price', 'level_required', 'certification', 'debouches',
        'programme', 'image', 'is_popular', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'programme' => 'array',
            'price' => 'decimal:2',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasManyThrough(Paiement::class, Inscription::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', ' ').' FCFA';
    }
}

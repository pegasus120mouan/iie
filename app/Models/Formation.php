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

    public const PROMOTION_SLUG = 'promotion';

    public function scopePublicCatalog($query)
    {
        return $query->where('slug', '!=', self::PROMOTION_SLUG);
    }

    public static function promotion(): self
    {
        $category = Category::firstOrCreate(
            ['slug' => 'promotions'],
            [
                'name' => 'Promotions',
                'description' => 'Formations promotionnelles et offres spéciales IIE',
                'icon' => 'fa-bullhorn',
                'is_active' => true,
                'sort_order' => 99,
            ]
        );

        return static::firstOrCreate(
            ['slug' => self::PROMOTION_SLUG],
            [
                'category_id' => $category->id,
                'name' => 'Promotion',
                'description' => 'Inscriptions issues des formations en vue et promotions spéciales de l\'IIE.',
                'short_description' => 'Formation promotionnelle IIE',
                'duration' => 'Variable',
                'price' => 0,
                'level_required' => 'Variable',
                'debouches' => 'Selon la promotion en cours',
                'programme' => [],
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 999,
            ]
        );
    }
}

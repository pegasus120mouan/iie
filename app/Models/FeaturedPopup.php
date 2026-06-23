<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FeaturedPopup extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'formation_id',
        'image',
        'link',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (FeaturedPopup $popup) {
            if (empty($popup->slug)) {
                $popup->slug = static::generateUniqueSlug($popup->title);
            }
        });
    }

    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    public function getImageUrlAttribute(): string
    {
        return '/storage/'.ltrim($this->image, '/');
    }

    public function getShareUrlAttribute(): string
    {
        return route('formation-en-vue.inscription', $this->slug);
    }

    public function getClickUrlAttribute(): ?string
    {
        if ($this->formation_id) {
            $formation = $this->relationLoaded('formation')
                ? $this->formation
                : $this->formation()->first();

            if ($formation) {
                return route('formations.show', $formation->slug);
            }
        }

        return $this->link;
    }

    public static function generateUniqueSlug(?string $title, ?int $exceptId = null): string
    {
        $base = Str::slug($title ?: 'formation-en-vue') ?: 'formation-en-vue';
        $slug = $base;
        $i = 1;

        while (static::query()
            ->where('slug', $slug)
            ->when($exceptId, fn ($query) => $query->where('id', '!=', $exceptId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public static function active(): ?self
    {
        return static::with('formation')
            ->where('is_active', true)
            ->latest()
            ->first();
    }

    public function activate(): void
    {
        static::where('id', '!=', $this->id)->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }

    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }
}

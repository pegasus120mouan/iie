<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    protected $fillable = [
        'title', 'description', 'file_path', 'type', 'category', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}

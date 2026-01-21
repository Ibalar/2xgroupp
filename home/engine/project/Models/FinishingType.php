<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'image',
        'is_active',
        'sort',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInternal($query)
    {
        return $query->where('type', 'internal');
    }

    public function scopeExternal($query)
    {
        return $query->where('type', 'external');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort')->orderBy('name');
    }
}

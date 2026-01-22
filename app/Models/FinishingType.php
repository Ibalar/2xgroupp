<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'gallery_images',
        'is_active',
        'sort',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery_images' => 'array',
    ];

    public function getFirstImageAttribute(): ?string
    {
        if (is_array($this->gallery_images) && count($this->gallery_images) > 0) {
            return $this->gallery_images[0];
        }

        return null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInternal(Builder $query): Builder
    {
        return $query->where('type', 'internal');
    }

    public function scopeExternal(Builder $query): Builder
    {
        return $query->where('type', 'external');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort')->orderBy('name');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'slug', 'name',
        'short_description', 'description',
        'price',
        'is_active', 'sort',
        'cover_image',
        'gallery_images',
    ];

    protected $casts = [
        'gallery_images' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CatalogCategory::class, 'category_id');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('sort');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

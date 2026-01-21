<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CatalogCategory extends Model
{
    protected $table = 'catalog_categories';

    protected $fillable = [
        'slug',
        'image',
        'name',
        'description',
        'is_active',
        'sort',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
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

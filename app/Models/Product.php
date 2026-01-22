<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'slug', 'name',
        'short_description', 'description',
        'price',
        'is_active', 'is_popular', 'sort',
        'cover_image',
        'gallery_images',
        'video_type', 'video_url', 'video_file_path',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'video_type' => 'string',
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    public function hasVideo(): bool
    {
        if ($this->video_type === 'youtube') {
            return ! empty($this->video_url);
        }

        if ($this->video_type === 'file') {
            return ! empty($this->video_file_path);
        }

        return false;
    }

    public function getYoutubeEmbedUrl(): ?string
    {
        if ($this->video_type === 'youtube' && $this->video_url) {
            // Parse various YouTube URL formats
            // https://www.youtube.com/watch?v=VIDEO_ID
            // https://youtu.be/VIDEO_ID
            // https://www.youtube.com/embed/VIDEO_ID

            $youtubeId = null;

            if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $this->video_url, $matches)) {
                $youtubeId = $matches[1];
            }

            if ($youtubeId) {
                return "https://www.youtube.com/embed/{$youtubeId}?rel=0&modestbranding=1";
            }
        }

        return null;
    }

    public function getVideoUrl(): ?string
    {
        if ($this->video_type === 'file' && $this->video_file_path) {
            return asset('storage/'.$this->video_file_path);
        }

        return null;
    }
}

<?php

namespace Tests\Feature;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductVideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_video_fields()
    {
        $category = CatalogCategory::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'slug' => 'test-product',
            'name' => 'Test Product',
            'video_type' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $this->assertTrue($product->hasVideo());
        $this->assertEquals('https://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&modestbranding=1', $product->getYoutubeEmbedUrl());
        $this->assertNull($product->getVideoUrl());
    }

    public function test_youtube_url_parsing()
    {
        $category = CatalogCategory::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $testCases = [
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://youtu.be/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ' => 'dQw4w9WgXcQ',
        ];

        foreach ($testCases as $url => $expectedId) {
            $product = Product::create([
                'category_id' => $category->id,
                'slug' => 'test-product-'.uniqid(),
                'name' => 'Test Product',
                'video_type' => 'youtube',
                'video_url' => $url,
            ]);

            $embedUrl = $product->getYoutubeEmbedUrl();
            $this->assertStringContainsString($expectedId, $embedUrl);
            $this->assertStringContainsString('youtube.com/embed/', $embedUrl);
        }
    }

    public function test_file_video()
    {
        $category = CatalogCategory::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'slug' => 'test-product-file',
            'name' => 'Test Product with File',
            'video_type' => 'file',
            'video_url' => 'products/videos/test.mp4',
        ]);

        $this->assertTrue($product->hasVideo());
        $this->assertNull($product->getYoutubeEmbedUrl());
        $this->assertStringContainsString('storage/products/videos/test.mp4', $product->getVideoUrl());
    }

    public function test_no_video()
    {
        $category = CatalogCategory::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'slug' => 'test-product-no-video',
            'name' => 'Test Product without Video',
        ]);

        $this->assertFalse($product->hasVideo());
        $this->assertNull($product->getYoutubeEmbedUrl());
        $this->assertNull($product->getVideoUrl());
    }
}

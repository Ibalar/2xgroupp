<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created(): void
    {
        $category = CatalogCategory::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $product->name,
        ]);
    }

    public function test_product_has_route_key_name_slug(): void
    {
        $product = Product::factory()->create();

        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    public function test_product_belongs_to_category(): void
    {
        $category = CatalogCategory::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($product->category->is($category));
    }

    public function test_active_scope_filters_inactive_products(): void
    {
        $category = CatalogCategory::factory()->create();
        Product::factory()->create(['category_id' => $category->id, 'is_active' => true]);
        Product::factory()->create(['category_id' => $category->id, 'is_active' => false]);

        $active = Product::active()->get();

        $this->assertCount(1, $active);
    }

    public function test_popular_scope_filters_popular_products(): void
    {
        $category = CatalogCategory::factory()->create();
        Product::factory()->create(['category_id' => $category->id, 'is_popular' => true]);
        Product::factory()->create(['category_id' => $category->id, 'is_popular' => false]);

        $popular = Product::popular()->get();

        $this->assertCount(1, $popular);
    }

    public function test_gallery_images_cast_to_array(): void
    {
        $images = ['image1.jpg', 'image2.jpg'];
        $product = Product::factory()->create(['gallery_images' => $images]);

        $this->assertIsArray($product->gallery_images);
        $this->assertEquals($images, $product->gallery_images);
    }
}

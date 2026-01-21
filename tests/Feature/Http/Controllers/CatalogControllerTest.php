<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_categories_page_loads(): void
    {
        $response = $this->get('/catalog');

        $response->assertStatus(200);
        $response->assertViewIs('catalog.categories');
    }

    public function test_catalog_displays_active_categories(): void
    {
        $active = CatalogCategory::factory()->create(['is_active' => true]);
        $inactive = CatalogCategory::factory()->create(['is_active' => false]);

        $response = $this->get('/catalog');

        $categories = $response->viewData('categories');
        $this->assertTrue($categories->contains($active));
        $this->assertFalse($categories->contains($inactive));
    }

    public function test_category_page_loads_successfully(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);

        $response = $this->get("/catalog/{$category->slug}");

        $response->assertStatus(200);
        $response->assertViewIs('catalog.category');
    }

    public function test_inactive_category_returns_404(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => false]);

        $response = $this->get("/catalog/{$category->slug}");

        $response->assertStatus(404);
    }

    public function test_category_displays_paginated_products(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);
        Product::factory(15)->create([
            'category_id' => $category->id,
            'is_active' => true,
        ]);

        $response = $this->get("/catalog/{$category->slug}");

        $response->assertStatus(200);
        $response->assertViewHas('products');
        $this->assertCount(12, $response->viewData('products')->items());
    }

    public function test_product_page_loads_successfully(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => true,
        ]);

        $response = $this->get("/catalog/{$category->slug}/{$product->slug}");

        $response->assertStatus(200);
        $response->assertViewIs('catalog.product');
    }

    public function test_inactive_product_returns_404(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => false,
        ]);

        $response = $this->get("/catalog/{$category->slug}/{$product->slug}");

        $response->assertStatus(404);
    }

    public function test_product_from_inactive_category_returns_404(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => false]);
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => true,
        ]);

        $response = $this->get("/catalog/{$category->slug}/{$product->slug}");

        $response->assertStatus(404);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home.index');
    }

    public function test_home_page_displays_categories(): void
    {
        CatalogCategory::factory()->create(['is_active' => true]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    public function test_home_page_displays_popular_products(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);
        Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => true,
            'is_popular' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('popularProducts');
    }

    public function test_home_page_shows_only_active_categories(): void
    {
        CatalogCategory::factory()->create(['is_active' => true]);
        CatalogCategory::factory()->create(['is_active' => false]);

        $response = $this->get('/');

        $categories = $response->viewData('categories');
        // Controller only returns active categories, so count should be 1
        $this->assertCount(1, $categories);
    }

    public function test_home_page_shows_only_popular_active_products(): void
    {
        $category = CatalogCategory::factory()->create(['is_active' => true]);
        Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => true,
            'is_popular' => true,
        ]);
        Product::factory()->create([
            'category_id' => $category->id,
            'is_active' => false,
            'is_popular' => true,
        ]);

        $response = $this->get('/');

        $products = $response->viewData('popularProducts');
        // Controller only returns active and popular products, so count should be 1
        $this->assertCount(1, $products);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created(): void
    {
        $category = CatalogCategory::factory()->create();

        $this->assertDatabaseHas('catalog_categories', [
            'id' => $category->id,
            'name' => $category->name,
        ]);
    }

    public function test_category_has_route_key_name_slug(): void
    {
        $category = CatalogCategory::factory()->create();

        $this->assertEquals('slug', $category->getRouteKeyName());
    }

    public function test_category_can_have_products(): void
    {
        $category = CatalogCategory::factory()->create();
        Product::factory(5)->create(['category_id' => $category->id]);

        $this->assertCount(5, $category->products);
    }

    public function test_active_scope_filters_inactive_categories(): void
    {
        CatalogCategory::factory()->create(['is_active' => true]);
        CatalogCategory::factory()->create(['is_active' => false]);

        $active = CatalogCategory::active()->get();

        $this->assertCount(1, $active);
    }

    public function test_ordered_scope_sorts_by_sort_then_name(): void
    {
        CatalogCategory::factory()->create(['name' => 'B', 'sort' => 2, 'is_active' => true]);
        CatalogCategory::factory()->create(['name' => 'A', 'sort' => 1, 'is_active' => true]);
        CatalogCategory::factory()->create(['name' => 'C', 'sort' => 1, 'is_active' => true]);

        $ordered = CatalogCategory::ordered()->get();

        $this->assertEquals('A', $ordered[0]->name);
        $this->assertEquals('C', $ordered[1]->name);
        $this->assertEquals('B', $ordered[2]->name);
    }
}

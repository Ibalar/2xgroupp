<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_page_loads_successfully(): void
    {
        $page = Page::factory()->create(['is_published' => true]);

        $response = $this->get("/{$page->slug}");

        $response->assertStatus(200);
        $response->assertViewIs('page.show');
    }

    public function test_unpublished_page_returns_404(): void
    {
        $page = Page::factory()->create(['is_published' => false]);

        $response = $this->get("/{$page->slug}");

        $response->assertStatus(404);
    }

    public function test_page_includes_categories(): void
    {
        $page = Page::factory()->create(['is_published' => true]);

        $response = $this->get("/{$page->slug}");

        $response->assertViewHas('categories');
    }
}

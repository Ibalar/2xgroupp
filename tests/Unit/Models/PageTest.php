<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_can_be_created(): void
    {
        $page = Page::factory()->create();

        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'title' => $page->title,
        ]);
    }

    public function test_page_has_route_key_name_slug(): void
    {
        $page = Page::factory()->create();

        $this->assertEquals('slug', $page->getRouteKeyName());
    }

    public function test_page_can_be_published(): void
    {
        $page = Page::factory()->published()->create();

        $this->assertTrue($page->is_published);
        $this->assertNotNull($page->published_at);
    }

    public function test_page_can_be_unpublished(): void
    {
        $page = Page::factory()->unpublished()->create();

        $this->assertFalse($page->is_published);
        $this->assertNull($page->published_at);
    }
}

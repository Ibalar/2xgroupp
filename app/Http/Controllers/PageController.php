<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->is_published, 404);

        $categories = CatalogCategory::active()
            ->ordered()
            ->get(['id', 'name', 'slug', 'image']);

        return view('page.show', compact('page', 'categories'));
    }
}

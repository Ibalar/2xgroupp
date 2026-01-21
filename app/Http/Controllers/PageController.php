<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        abort_unless($page->is_published, 404);

        $categories = CatalogCategory::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'image']);

        return view('page.show', compact('page', 'categories'));
    }
}

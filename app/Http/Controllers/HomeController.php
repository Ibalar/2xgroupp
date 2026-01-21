<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = CatalogCategory::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'image']);

        $popularProducts = Product::query()
            ->where('is_active', true)
            ->where('is_popular', true)
            ->with(['category:id,slug,name'])
            ->orderBy('sort')
            ->latest('id')
            ->limit(8)
            ->get(['id', 'category_id', 'name', 'slug', 'price', 'cover_image']);

        return view('home.index', compact('categories', 'popularProducts'));
    }
}

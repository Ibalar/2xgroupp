<?php

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Cache::remember('home_categories', now()->addDay(), function () {
            return CatalogCategory::active()
                ->ordered()
                ->get(['id', 'name', 'slug', 'image']);
        });

        $popularProducts = Cache::remember('home_popular_products', now()->addDay(), function () {
            return Product::active()
                ->popular()
                ->with(['category:id,slug,name'])
                ->orderBy('sort')
                ->latest('id')
                ->limit(8)
                ->get(['id', 'category_id', 'name', 'slug', 'price', 'cover_image']);
        });

        return view('home.index', compact('categories', 'popularProducts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function categories(): View
    {
        $categories = CatalogCategory::query()
            ->where('is_active', true)
            ->orderBy('sort')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'image']);

        return view('catalog.categories', compact('categories'));
    }

    public function category(CatalogCategory $category): View
    {
        abort_unless($category->is_active, 404);

        $products = $category->products()
            ->where('is_active', true)
            ->orderBy('sort')
            ->latest('id')
            ->paginate(12, ['id', 'category_id', 'name', 'slug', 'price', 'cover_image', 'short_description']);

        return view('catalog.category', compact('category', 'products'));
    }

    public function product(CatalogCategory $category, Product $product): View
    {
        abort_unless($category->is_active, 404);
        abort_unless($product->is_active, 404);

        return view('catalog.product', compact('category', 'product'));
    }
}

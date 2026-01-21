<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CatalogCategory;
use App\Models\Product;
use App\Services\CatalogService;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function __construct(private CatalogService $catalogService) {}

    public function categories(): View
    {
        $categories = $this->catalogService->getAllCategories();

        return view('catalog.categories', compact('categories'));
    }

    public function category(CatalogCategory $category): View
    {
        $products = $this->catalogService->getCategoryWithProducts($category);

        return view('catalog.category', compact('category', 'products'));
    }

    public function product(CatalogCategory $category, Product $product): View
    {
        $product = $this->catalogService->getProduct($category, $product);

        return view('catalog.product', compact('category', 'product'));
    }
}

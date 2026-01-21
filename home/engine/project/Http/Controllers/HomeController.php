<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\CatalogService;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(
        private CatalogService $catalogService,
        private ProductService $productService,
    ) {}

    public function index(): View
    {
        $categories = $this->catalogService->getHomeCategories();
        $popularProducts = $this->productService->getPopularProducts();

        return view('home.index', compact('categories', 'popularProducts'));
    }
}

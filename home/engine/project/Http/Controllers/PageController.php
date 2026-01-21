<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use App\Services\CatalogService;
use App\Services\PageService;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function __construct(
        private PageService $pageService,
        private CatalogService $catalogService,
    ) {}

    public function show(Page $page): View
    {
        $page = $this->pageService->getPublishedPage($page);
        $categories = $this->catalogService->getAllCategories();

        return view('page.show', compact('page', 'categories'));
    }
}

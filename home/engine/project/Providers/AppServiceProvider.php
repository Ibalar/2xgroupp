<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\CatalogService;
use App\Services\PageService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CatalogService::class);
        $this->app->singleton(PageService::class);
    }

    public function boot(): void
    {
        View::composer('partials.footer', function ($view) {
            $catalogService = app(CatalogService::class);
            $categories = $catalogService->getFooterCategories();
            $view->with('footerCategories', $categories);
        });

        View::composer(['layouts.app', 'partials.header'], function ($view) {
            $pageService = app(PageService::class);
            $menuPages = $pageService->getMenuPages();
            $view->with('menuPages', $menuPages);
        });

        View::composer('layouts.app', function ($view) {
            $catalogService = app(CatalogService::class);
            $categories = $catalogService->getAllCategories();
            $view->with('categories', $categories);
        });
    }
}

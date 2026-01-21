<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use App\Models\CatalogCategory;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.footer', function ($view) {
            $footerCategories = CatalogCategory::query()
                ->where('is_active', true)
                ->orderBy('sort')
                ->orderBy('name')
                ->limit(8)
                ->get(['id', 'name', 'slug']);

            $view->with('footerCategories', $footerCategories);
        });

        View::composer(['layouts.app', 'partials.header'], function ($view) {
            $menuPages = Page::query()
                ->where('is_published', true)
                ->orderBy('sort')
                ->orderBy('title')
                ->get(['id', 'slug', 'title']);

            $view->with('menuPages', $menuPages);
        });

        View::composer('layouts.app', function ($view) {
            $categories = CatalogCategory::query()
                ->where('is_active', true)
                ->orderBy('sort')
                ->orderBy('name')
                ->limit(8)
                ->get(['id', 'name', 'slug', 'image']);

            $view->with('categories', $categories);
        });

    }
}

<?php

namespace App\Providers;

use App\Models\CatalogCategory;
use App\Models\FinishingType;
use App\Models\Page;
use App\Models\Product;
use App\Observers\CatalogCategoryObserver;
use App\Observers\FinishingTypeObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Register observers
        CatalogCategory::observe(CatalogCategoryObserver::class);
        Product::observe(ProductObserver::class);
        FinishingType::observe(FinishingTypeObserver::class);

        View::composer('partials.footer', function ($view) {
            $footerCategories = Cache::rememberForever('catalog_categories_footer', function () {
                return CatalogCategory::active()
                    ->ordered()
                    ->limit(8)
                    ->get(['id', 'name', 'slug']);
            });

            $view->with('footerCategories', $footerCategories);
        });

        View::composer(['layouts.app', 'partials.header'], function ($view) {
            $menuPages = Cache::rememberForever('menu_pages', function () {
                return Page::where('is_published', true)
                    ->orderBy('sort')
                    ->orderBy('title')
                    ->get(['id', 'slug', 'title']);
            });

            $view->with('menuPages', $menuPages);
        });

        View::composer('layouts.app', function ($view) {
            $categories = Cache::rememberForever('layout_categories', function () {
                return CatalogCategory::active()
                    ->ordered()
                    ->limit(8)
                    ->get(['id', 'name', 'slug', 'image']);
            });

            $view->with('categories', $categories);
        });

    }
}

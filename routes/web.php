<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('catalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'categories'])->name('categories');

    Route::get('/{category:slug}', [CatalogController::class, 'category'])
        ->name('category');

    Route::get('/{category:slug}/{product:slug}', [CatalogController::class, 'product'])
        ->scopeBindings()
        ->name('product');
});


Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');

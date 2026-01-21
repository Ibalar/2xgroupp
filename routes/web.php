<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,60')
    ->name('contact.store');

Route::prefix('catalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'categories'])->name('categories');

    Route::get('/{category:slug}', [CatalogController::class, 'category'])
        ->name('category');

    Route::get('/{category:slug}/{product:slug}', [CatalogController::class, 'product'])
        ->scopeBindings()
        ->name('product');
});

Route::prefix('finishing')->name('finishing.')->group(function () {
    Route::get('/', [\App\Http\Controllers\FinishingController::class, 'index'])->name('index');
    Route::get('/{type}/{finishingType:id}', [\App\Http\Controllers\FinishingController::class, 'show'])
        ->where('type', 'internal|external')
        ->name('show');
});

Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');

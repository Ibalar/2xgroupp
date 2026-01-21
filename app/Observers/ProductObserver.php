<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /**
     * Handle the Product "saved" event.
     */
    public function saved(Product $product): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->clearCache();
    }

    /**
     * Clear all product related cache.
     */
    private function clearCache(): void
    {
        Cache::flush();
    }
}

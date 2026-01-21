<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\CatalogCategory;
use Illuminate\Support\Facades\Cache;

class CatalogCategoryObserver
{
    /**
     * Handle the CatalogCategory "saved" event.
     */
    public function saved(CatalogCategory $catalogCategory): void
    {
        $this->clearCache();
    }

    /**
     * Handle the CatalogCategory "deleted" event.
     */
    public function deleted(CatalogCategory $catalogCategory): void
    {
        $this->clearCache();
    }

    /**
     * Clear all catalog category related cache.
     */
    private function clearCache(): void
    {
        Cache::flush();
    }
}

<?php

namespace App\Observers;

use App\Models\FinishingType;
use Illuminate\Support\Facades\Cache;

class FinishingTypeObserver
{
    /**
     * Handle the FinishingType "created" event.
     */
    public function created(FinishingType $finishingType): void
    {
        $this->clearCache();
    }

    /**
     * Handle the FinishingType "updated" event.
     */
    public function updated(FinishingType $finishingType): void
    {
        $this->clearCache();
    }

    /**
     * Handle the FinishingType "deleted" event.
     */
    public function deleted(FinishingType $finishingType): void
    {
        $this->clearCache();
    }

    /**
     * Clear the cache for finishing types.
     */
    protected function clearCache(): void
    {
        Cache::forget('finishing_types_internal');
        Cache::forget('finishing_types_external');
        Cache::forget('finishing_types_all');
    }
}

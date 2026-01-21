<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\FinishingType;
use Illuminate\Support\Facades\Cache;

class FinishingTypeObserver
{
    public function created(FinishingType $model): void
    {
        Cache::forget('finishing_types_internal');
        Cache::forget('finishing_types_external');
        Cache::forget('finishing_types_all');
    }

    public function updated(FinishingType $model): void
    {
        Cache::forget('finishing_types_internal');
        Cache::forget('finishing_types_external');
        Cache::forget('finishing_types_all');
    }

    public function deleted(FinishingType $model): void
    {
        Cache::forget('finishing_types_internal');
        Cache::forget('finishing_types_external');
        Cache::forget('finishing_types_all');
    }
}

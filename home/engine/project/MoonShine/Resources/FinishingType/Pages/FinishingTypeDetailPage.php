<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType\Pages;

use App\MoonShine\Resources\FinishingType\FinishingTypeResource;
use MoonShine\Laravel\Pages\DetailPage;

class FinishingTypeDetailPage extends DetailPage
{
    protected function resourceClass(): string
    {
        return FinishingTypeResource::class;
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType;

use App\Models\FinishingType;
use App\MoonShine\Resources\FinishingType\Pages\FinishingTypeDetailPage;
use App\MoonShine\Resources\FinishingType\Pages\FinishingTypeFormPage;
use App\MoonShine\Resources\FinishingType\Pages\FinishingTypeIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<FinishingType, FinishingTypeIndexPage, FinishingTypeFormPage, FinishingTypeDetailPage>
 */
class FinishingTypeResource extends ModelResource
{
    protected string $model = FinishingType::class;

    protected string $title = 'Виды отделки';

    protected string $column = 'name';

    protected string $icon = 'heroicon-o-home-modern';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            FinishingTypeIndexPage::class,
            FinishingTypeFormPage::class,
            FinishingTypeDetailPage::class,
        ];
    }

    /**
     * @return list<string>
     */
    public function search(): array
    {
        return ['id', 'name', 'description'];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CatalogCategory;

use App\Models\CatalogCategory;
use App\MoonShine\Resources\CatalogCategory\Pages\CatalogCategoryDetailPage;
use App\MoonShine\Resources\CatalogCategory\Pages\CatalogCategoryFormPage;
use App\MoonShine\Resources\CatalogCategory\Pages\CatalogCategoryIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\Enums\PageType;
use MoonShine\Support\ListOf;

/**
 * @extends ModelResource<CatalogCategory, CatalogCategoryIndexPage, CatalogCategoryFormPage, CatalogCategoryDetailPage>
 */
class CatalogCategoryResource extends ModelResource
{
    protected string $model = CatalogCategory::class;

    protected string $title = 'Разделы каталога';

    protected string $column = 'name';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            CatalogCategoryIndexPage::class,
            CatalogCategoryFormPage::class,
            CatalogCategoryDetailPage::class,
        ];
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(Action::VIEW);
    }
}

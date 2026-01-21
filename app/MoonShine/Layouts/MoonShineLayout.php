<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use App\MoonShine\Resources\Page\PageResource;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\CatalogCategory\CatalogCategoryResource;
use App\MoonShine\Resources\Product\ProductResource;
use App\MoonShine\Resources\Media\MediaResource;
use App\MoonShine\Resources\ContactRequest\ContactRequestResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuItem::make(PageResource::class, 'Инфостраницы')
                ->icon('document-duplicate'),
            MenuGroup::make('Каталог')->setItems([
                MenuItem::make(CatalogCategoryResource::class, 'Разделы каталога')->icon('wallet'),
                MenuItem::make(ProductResource::class, 'Предложения каталога')->icon('home-modern'),
            ])->icon('shopping-bag'),
            MenuItem::make(ContactRequestResource::class, 'Обратная связь')
                ->icon('phone'),
            ...parent::menu(),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}

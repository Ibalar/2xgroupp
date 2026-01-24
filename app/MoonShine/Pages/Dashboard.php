<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\ContactRequest;
use App\Models\FinishingType;
use App\Models\Page;
use App\Models\Product;
use App\MoonShine\Resources\ContactRequest\ContactRequestResource;
use App\MoonShine\Resources\FinishingType\FinishingTypeResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page as MoonShinePage;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Grid;

#[\MoonShine\MenuManager\Attributes\SkipMenu]
class Dashboard extends MoonShinePage
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Панель управления';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $productResource = app(ProductResource::class);
        $pageResource = app(PageResource::class);
        $finishingTypeResource = app(FinishingTypeResource::class);
        $contactRequestResource = app(ContactRequestResource::class);

        return [
            ActionButton::make('На главную сайта', route('home'))
                ->icon('home')
                ->blank()
                ->secondary()
                ->class('mb-6'),

            Grid::make([
                Column::make([
                    $this->dashboardBox(
                        count: Product::active()->count(),
                        title: 'Товары каталога',
                        icon: 'shopping-bag',
                        createUrl: $productResource->getIndexPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: Page::query()->where('is_published', true)->count(),
                        title: 'Инфостраницы',
                        icon: 'document-text',
                        createUrl: $pageResource->getIndexPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: FinishingType::active()->count(),
                        title: 'Виды отделки',
                        icon: 'paint-brush',
                        createUrl: $finishingTypeResource->getIndexPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: ContactRequest::query()->where('status', 'new')->count(),
                        title: 'Контактные запросы',
                        icon: 'inbox',
                        createUrl: $contactRequestResource->getIndexPageUrl(),
                    ),
                ], 3, 12),
            ]),
        ];
    }

    private function dashboardBox(int $count, string $title, string $icon, string $createUrl): Box
    {
        return Box::make($title, [
            Div::make([
                Heading::make((string) $count)
                    ->h(1)
                    ->class('text-4xl font-bold'),

                ActionButton::make('Создать новый', $createUrl)
                    ->icon('plus')
                    ->primary(),
            ])->class('flex flex-col gap-4'),
        ])->icon($icon);
    }
}

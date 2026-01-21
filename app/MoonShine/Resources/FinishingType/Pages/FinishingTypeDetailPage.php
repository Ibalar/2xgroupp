<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType\Pages;

use App\MoonShine\Resources\FinishingType\FinishingTypeResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Markdown;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends DetailPage<FinishingTypeResource>
 */
class FinishingTypeDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Select::make('Тип', 'type')
                    ->options([
                        'internal' => 'Внутренняя',
                        'external' => 'Наружная',
                    ]),
                Text::make('Название', 'name'),
                Markdown::make('Описание', 'description'),
                Image::make('Изображение', 'image'),
                Switcher::make('Активен', 'is_active'),
                Number::make('Сортировка', 'sort'),
                Date::make('Создан', 'created_at')->format('d.m.Y H:i'),
                Date::make('Обновлен', 'updated_at')->format('d.m.Y H:i'),
            ]),
        ];
    }
}

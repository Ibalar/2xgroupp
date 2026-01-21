<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType\Pages;

use App\MoonShine\Resources\FinishingType\FinishingTypeResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

/**
 * @extends IndexPage<FinishingTypeResource>
 */
class FinishingTypeIndexPage extends IndexPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Select::make('Тип', 'type')
                ->options([
                    'internal' => 'Внутренняя',
                    'external' => 'Наружная',
                ])
                ->sortable(),
            Text::make('Название', 'name')
                ->sortable(),
            Switcher::make('Активен', 'is_active')
                ->sortable(),
            Number::make('Сортировка', 'sort')
                ->sortable(),
            Date::make('Создан', 'created_at')
                ->format('d.m.Y H:i')
                ->sortable(),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function filters(): iterable
    {
        return [
            Select::make('Тип', 'type')
                ->options([
                    'internal' => 'Внутренняя',
                    'external' => 'Наружная',
                ])
                ->nullable(),
            Switcher::make('Активен', 'is_active'),
        ];
    }
}

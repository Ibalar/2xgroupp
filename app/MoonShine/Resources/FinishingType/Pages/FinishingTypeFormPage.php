<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType\Pages;

use App\MoonShine\Resources\FinishingType\FinishingTypeResource;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;


/**
 * @extends FormPage<FinishingTypeResource>
 */
class FinishingTypeFormPage extends FormPage
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
                    ])
                    ->required(),
                Text::make('Название', 'name')
                    ->required(),
                TinyMce::make('Описание', 'description')
                    ->nullable(),
                Image::make('Галерея изображений', 'gallery_images')
                    ->multiple()
                    ->disk('public')
                    ->dir('finishing')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                    ->removable()
                    ->nullable(),

                Switcher::make('Активен', 'is_active')
                    ->default(true),

                Number::make('Сортировка', 'sort')
                    ->default(0),
            ]),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\FinishingType;

use App\Models\FinishingType;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Support\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Attributes\UseInNavigation;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Boolean;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\TinyMce;

#[UseInNavigation]
#[Icon('heroicon-o-home-modern')]
class FinishingTypeResource extends ModelResource
{
    protected string $model = FinishingType::class;

    protected string $title = 'Виды отделки';

    protected bool $createInModal = true;

    protected bool $editInModal = true;

    protected bool $detailInModal = true;

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Enum::make('type')->translatable('type')->sortable(),
            Text::make('name')->sortable(),
            Boolean::make('is_active')->sortable(),
            Number::make('sort')->sortable(),
            Date::make('created_at')->sortable(),
        ];
    }

    public function formFields(): array
    {
        return [
            ID::make(),
            Select::make('type')
                ->options([
                    'internal' => 'Внутренняя',
                    'external' => 'Наружная',
                ])
                ->required(),
            Text::make('name')->required(),
            TinyMce::make('description'),
            Image::make('image')->disk('public')->dir('finishing'),
            Boolean::make('is_active'),
            Number::make('sort')->default(0),
        ];
    }

    public function detailFields(): array
    {
        return [
            ID::make(),
            Enum::make('type')->translatable('type'),
            Text::make('name'),
            TinyMce::make('description'),
            Image::make('image'),
            Boolean::make('is_active'),
            Number::make('sort'),
            Date::make('created_at'),
            Date::make('updated_at'),
        ];
    }

    public function filters(): array
    {
        return [
            Enum::make('type')->translatable('type'),
            Boolean::make('is_active'),
        ];
    }

    public function search(): array
    {
        return ['name', 'description'];
    }
}

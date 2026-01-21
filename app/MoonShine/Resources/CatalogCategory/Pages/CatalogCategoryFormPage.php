<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\CatalogCategory\Pages;

use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\CatalogCategory\CatalogCategoryResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<CatalogCategoryResource>
 */
class CatalogCategoryFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Название', 'name')
                    ->required()
                    ->reactive(),

                Slug::make('Slug', 'slug')
                    ->from('name')
                    ->separator('-')
                    ->unique()
                    ->live()
                    ->required(),

                Textarea::make('Описание', 'description')
                    ->nullable(),

                Image::make('Изображение', 'image')
                    ->disk('public')
                    ->dir('categories')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                    ->nullable(),

                Switcher::make('Активна', 'is_active')
                    ->default(true),

                Number::make('Сортировка', 'sort')
                    ->min(0)
                    ->default(0),

                // Связанные товары в карточке категории
                HasMany::make('Товары', 'products', resource: ProductResource::class)
                    ->relatedLink(), // показать как ссылку с количеством (по желанию)
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product\Pages;

use App\MoonShine\Resources\CatalogCategory\CatalogCategoryResource;
use App\MoonShine\Resources\Product\ProductResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends FormPage<ProductResource>
 */
class ProductFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([

                Tabs::make([
                    Tab::make('Основная информация', [
                        ID::make(),
                        BelongsTo::make(
                            label: 'Категория',
                            relationName: 'category',
                            formatted: 'name',
                            resource: CatalogCategoryResource::class
                        )
                            ->searchable()
                            ->required(),

                        Text::make('Название', 'name')
                            ->reactive()
                            ->required(),

                        Slug::make('Slug', 'slug')
                            ->from('name')
                            ->separator('-')
                            ->unique()
                            ->live()
                            ->required(),

                        Number::make('Цена', 'price')
                            ->min(0)
                            ->step(0.01)
                            ->nullable(),

                        Switcher::make('Популярный', 'is_popular')
                            ->default(false),

                        Switcher::make('Активен', 'is_active')
                            ->default(true),

                        Number::make('Сортировка', 'sort')
                            ->min(0)
                            ->default(0),
                    ]),
                    Tab::make('Описание', [
                        Textarea::make('Краткое описание', 'short_description')
                            ->nullable(),

                        TinyMce::make('Описание', 'description')
                            ->nullable(),
                    ]),
                    Tab::make('Галерея', [
                        Image::make('Обложка', 'cover_image')
                            ->disk('public')
                            ->dir('products/covers')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                            ->removable()
                            ->nullable(),

                        Image::make('Галерея', 'gallery_images')
                            ->disk('public')
                            ->dir('products/gallery')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                            ->multiple()
                            ->removable()
                            ->nullable(),
                    ]),
                ]),
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
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}

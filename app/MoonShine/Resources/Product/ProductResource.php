<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product;

use App\Models\Product;
use App\MoonShine\Resources\Product\Pages\ProductDetailPage;
use App\MoonShine\Resources\Product\Pages\ProductFormPage;
use App\MoonShine\Resources\Product\Pages\ProductIndexPage;
use MoonShine\Contracts\Core\DependencyInjection\FieldsContract;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Product, ProductIndexPage, ProductFormPage, ProductDetailPage>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Предложения каталога';

    protected string $column = 'name';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProductIndexPage::class,
            ProductFormPage::class,
            ProductDetailPage::class,
        ];
    }

    protected function afterSave(DataWrapperContract $item, FieldsContract $fields): DataWrapperContract
    {
        $model = $item->getOriginal();

        if ($model instanceof Product && $model->video_type === 'file' && request()->file('video_file')) {
            $file = request()->file('video_file');
            $model->video_url = $file->store('products/videos', 'public');
        }

        return parent::afterSave($item, $fields);
    }
}

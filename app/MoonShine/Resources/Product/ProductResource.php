<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product;

use App\Models\Product;
use App\MoonShine\Resources\Product\Pages\ProductDetailPage;
use App\MoonShine\Resources\Product\Pages\ProductFormPage;
use App\MoonShine\Resources\Product\Pages\ProductIndexPage;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\Core\PageContract;
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

    public function afterSave(Model $model): Model
    {
        // Если выбран тип file и загружен файл
        if ($model->video_type === 'file' && request()->file('video_file')) {
            $file = request()->file('video_file');
            $path = $file->store('products/videos', 'public');
            $model->video_url = $path;
            $model->save();
        }

        return $model;
    }
}

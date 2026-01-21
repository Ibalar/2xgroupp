<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CatalogCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogService extends AbstractService
{
    /**
     * Получить все активные категории для главной страницы
     */
    public function getHomeCategories(int $limit = 8): Collection
    {
        return $this->rememberForever('home_categories', function () use ($limit) {
            return CatalogCategory::active()
                ->ordered()
                ->get(['id', 'name', 'slug', 'image']);
        });
    }

    /**
     * Получить все активные категории для каталога
     */
    public function getAllCategories(): Collection
    {
        return $this->remember('catalog_all_categories', now()->addDay(), function () {
            return CatalogCategory::active()
                ->ordered()
                ->get(['id', 'name', 'slug', 'image']);
        });
    }

    /**
     * Получить категории для footer (лимитированное количество)
     */
    public function getFooterCategories(int $limit = 8): Collection
    {
        return $this->rememberForever('catalog_categories_footer', function () use ($limit) {
            return CatalogCategory::active()
                ->ordered()
                ->limit($limit)
                ->get(['id', 'name', 'slug']);
        });
    }

    /**
     * Получить категорию со всеми товарами (с пагинацией)
     */
    public function getCategoryWithProducts(
        CatalogCategory $category,
        int $perPage = 12
    ): LengthAwarePaginator {
        if (! $category->is_active) {
            abort(404);
        }

        return $category->products()
            ->active()
            ->orderBy('sort')
            ->latest('id')
            ->paginate($perPage, ['id', 'category_id', 'name', 'slug', 'price', 'cover_image', 'short_description']);
    }

    /**
     * Получить товар с полной информацией
     */
    public function getProduct(CatalogCategory $category, Product $product): Product
    {
        if (! $category->is_active || ! $product->is_active) {
            abort(404);
        }

        return $product;
    }

    /**
     * Проверить, принадлежит ли товар категории
     */
    public function productBelongsToCategory(Product $product, CatalogCategory $category): bool
    {
        return $product->category_id === $category->id;
    }
}

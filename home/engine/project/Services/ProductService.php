<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService extends AbstractService
{
    /**
     * Получить популярные товары для главной страницы
     */
    public function getPopularProducts(int $limit = 8): Collection
    {
        return $this->remember('home_popular_products', now()->addDay(), function () use ($limit) {
            return Product::active()
                ->popular()
                ->with(['category:id,slug,name'])
                ->orderBy('sort')
                ->latest('id')
                ->limit($limit)
                ->get(['id', 'category_id', 'name', 'slug', 'price', 'cover_image']);
        });
    }

    /**
     * Получить количество активных товаров
     */
    public function getActiveProductsCount(): int
    {
        return $this->remember('active_products_count', now()->addDay(), function () {
            return Product::active()->count();
        });
    }

    /**
     * Получить товары по категории
     */
    public function getProductsByCategory(int $categoryId, int $limit = 12): Collection
    {
        return Product::where('category_id', $categoryId)
            ->active()
            ->orderBy('sort')
            ->limit($limit)
            ->get();
    }

    /**
     * Поиск товаров по названию
     */
    public function searchProducts(string $query, int $limit = 10): Collection
    {
        return Product::active()
            ->where('name', 'like', "%{$query}%")
            ->orWhere('short_description', 'like', "%{$query}%")
            ->limit($limit)
            ->get(['id', 'name', 'slug', 'price', 'cover_image']);
    }
}

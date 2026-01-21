<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class PageService extends AbstractService
{
    /**
     * Получить все опубликованные страницы для меню
     */
    public function getMenuPages(): Collection
    {
        return $this->rememberForever('menu_pages', function () {
            return Page::where('is_published', true)
                ->orderBy('sort')
                ->orderBy('title')
                ->get(['id', 'slug', 'title']);
        });
    }

    /**
     * Получить страницу для отображения
     */
    public function getPublishedPage(Page $page): Page
    {
        if (! $page->is_published) {
            abort(404);
        }

        return $page;
    }
}

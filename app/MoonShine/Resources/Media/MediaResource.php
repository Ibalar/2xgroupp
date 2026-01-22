<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Media;

use App\Models\Media;
use App\MoonShine\Resources\Media\Pages\MediaDetailPage;
use App\MoonShine\Resources\Media\Pages\MediaFormPage;
use App\MoonShine\Resources\Media\Pages\MediaIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<Media, MediaIndexPage, MediaFormPage, MediaDetailPage>
 */
class MediaResource extends ModelResource
{
    protected string $model = Media::class;

    protected string $title = 'Media';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            MediaIndexPage::class,
            MediaFormPage::class,
            MediaDetailPage::class,
        ];
    }
}

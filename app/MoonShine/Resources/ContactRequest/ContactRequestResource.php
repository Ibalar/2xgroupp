<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ContactRequest;

use App\Models\ContactRequest;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestDetailPage;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestFormPage;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestIndexPage;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\Laravel\Resources\ModelResource;

/**
 * @extends ModelResource<ContactRequest, ContactRequestIndexPage, ContactRequestFormPage, ContactRequestDetailPage>
 */
class ContactRequestResource extends ModelResource
{
    protected string $model = ContactRequest::class;

    protected string $title = 'ContactRequests';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ContactRequestIndexPage::class,
            ContactRequestFormPage::class,
            ContactRequestDetailPage::class,
        ];
    }
}

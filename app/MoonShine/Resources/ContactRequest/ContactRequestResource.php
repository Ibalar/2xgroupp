<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ContactRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContactRequest;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestIndexPage;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestFormPage;
use App\MoonShine\Resources\ContactRequest\Pages\ContactRequestDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

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

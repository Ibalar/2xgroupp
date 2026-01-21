<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = ContactRequest::create([
            'name' => $request->validated()['name'],
            'phone' => $request->validated()['phone'],
            'message' => $request->validated()['message'] ?? null,
            'source' => 'contact_form',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Спасибо! Ваше сообщение принято. Мы свяжемся с вами в ближайшее время.',
        ], 201);
    }
}

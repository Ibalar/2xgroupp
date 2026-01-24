<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = ContactRequest::create([
            'name' => $request->validated()['name'],
            'phone' => $request->validated()['phone'],
            'email' => $request->user()?->email ?? $request->validated()['email'] ?? null,
            'message' => $request->validated()['message'] ?? null,
            'source' => 'contact_form',
            'privacy_agreed' => true,
        ]);

        // Отправка письма админу
        try {
            Mail::to(config('mail.admin_email', 'admin@2xgroupp.by'))
                ->send(new ContactFormSubmitted($contact));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email: '.$e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Спасибо! Ваша заявка принята. Мы свяжемся с вами в ближайшее время.',
        ], 201);
    }
}

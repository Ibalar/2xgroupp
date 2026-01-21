<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\BelarusianPhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', new BelarusianPhoneRule, 'max:20'],
            'message' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.string' => 'Имя должно быть текстом',
            'name.max' => 'Имя не должно быть длиннее 255 символов',
            'phone.required' => 'Телефон обязателен',
            'phone.regex' => 'Некорректный формат телефона. Используйте формат: +375(XX)XXX-XX-XX',
            'phone.max' => 'Телефон не должен быть длиннее 20 символов',
            'message.string' => 'Сообщение должно быть текстом',
            'message.max' => 'Сообщение не должно быть длиннее 1000 символов',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'message' => 'Сообщение',
        ];
    }
}

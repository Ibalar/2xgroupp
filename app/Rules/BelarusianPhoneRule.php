<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BelarusianPhoneRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        return (bool) preg_match('/^\+?375\s?\(?\d{2}\)?[\s-]?\d{3}[\s-]?\d{2}[\s-]?\d{2}$/', (string) $value);
    }

    public function message(): string
    {
        return 'Некорректный формат телефона. Используйте формат: +375(XX)XXX-XX-XX';
    }
}

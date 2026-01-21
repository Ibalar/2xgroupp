<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;

abstract class AbstractService
{
    /**
     * Получить данные из кеша или вычислить их
     */
    protected function remember(
        string $key,
        \DateInterval|\DateTimeInterface|int $ttl,
        callable $callback
    ): mixed {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * Получить данные из кеша или сохранить навсегда
     */
    protected function rememberForever(string $key, callable $callback): mixed
    {
        return Cache::rememberForever($key, $callback);
    }

    /**
     * Очистить весь кеш
     */
    protected function flushCache(): void
    {
        Cache::flush();
    }

    /**
     * Забыть конкретный ключ кеша
     */
    protected function forgetCache(string $key): void
    {
        Cache::forget($key);
    }
}

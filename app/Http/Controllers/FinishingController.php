<?php

namespace App\Http\Controllers;

use App\Models\FinishingType;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FinishingController extends Controller
{
    public function index(): View
    {
        $internalTypes = Cache::remember('finishing_types_internal', now()->addDay(), function () {
            return FinishingType::active()->internal()->ordered()->get(['id', 'name', 'description', 'image', 'type']);
        });

        $externalTypes = Cache::remember('finishing_types_external', now()->addDay(), function () {
            return FinishingType::active()->external()->ordered()->get(['id', 'name', 'description', 'image', 'type']);
        });

        return view('finishing.index', compact('internalTypes', 'externalTypes'));
    }

    public function show(string $type, FinishingType $finishingType): View
    {
        abort_unless($finishingType->is_active, 404);
        abort_unless($finishingType->type === $type, 404);

        // Похожие (противоположного типа)
        $similar = Cache::remember("finishing_similar_{$finishingType->id}", now()->addDay(), function () use ($finishingType) {
            $oppositeType = $finishingType->type === 'internal' ? 'external' : 'internal';

            return FinishingType::active()
                ->where('type', $oppositeType)
                ->ordered()
                ->limit(3)
                ->get(['id', 'name', 'image', 'type']);
        });

        return view('finishing.show', compact('finishingType', 'similar'));
    }
}

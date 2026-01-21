<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FinishingType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinishingTypeFactory extends Factory
{
    protected $model = FinishingType::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['internal', 'external']),
            'name' => ucfirst(fake()->words(2, true)),
            'description' => implode("\n\n", fake()->paragraphs(2)),
            'image' => null,
            'is_active' => true,
            'sort' => fake()->numberBetween(0, 100),
        ];
    }
}

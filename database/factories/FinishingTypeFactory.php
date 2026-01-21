<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FinishingType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinishingType>
 */
class FinishingTypeFactory extends Factory
{
    protected $model = FinishingType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['internal', 'external']),
            'name' => fake()->words(2, true),
            'description' => fake()->paragraphs(2, true),
            'is_active' => true,
            'sort' => fake()->numberBetween(0, 100),
        ];
    }
}

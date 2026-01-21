<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FinishingType;
use Illuminate\Database\Seeder;

class FinishingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internal = [
            'Покраска дерева',
            'Гипсокартон',
            'Керамическая плитка',
            'Линолеум',
        ];

        $external = [
            'Облицовка кирпичом',
            'Штукатурка',
            'Деревянная обшивка',
            'Металлосайдинг',
        ];

        foreach ($internal as $name) {
            FinishingType::factory()->create([
                'type' => 'internal',
                'name' => $name,
            ]);
        }

        foreach ($external as $name) {
            FinishingType::factory()->create([
                'type' => 'external',
                'name' => $name,
            ]);
        }
    }
}

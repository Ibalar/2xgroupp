<?php

namespace Database\Seeders;

use App\Models\FinishingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinishingTypeSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Internal finishing types
        $internalTypes = [
            ['type' => 'internal', 'name' => 'Покраска дерева', 'description' => 'Качественная покраска деревянных поверхностей с использованием современных материалов. Покраска включает подготовку поверхности, грунтовку и нанесение финишного покрытия.'],
            ['type' => 'internal', 'name' => 'Гипсокартон', 'description' => 'Монтаж гипсокартонных конструкций любой сложности: перегородки, подвесные потолки, ниши и декоративные элементы. Работаем с влагостойким и огнеупорным гипсокартоном.'],
            ['type' => 'internal', 'name' => 'Керамическая плитка', 'description' => 'Укладка керамической плитки на пол и стены. Работаем с керамогранитом, мозаикой и крупноформатной плиткой. Качественная затирка швов и герметизация.'],
            ['type' => 'internal', 'name' => 'Линолеум', 'description' => 'Профессиональная укладка линолеума любого типа: бытового, полукоммерческого и коммерческого. Подготовка основания, точная подрезка и сварка швов.'],
        ];

        // External finishing types
        $externalTypes = [
            ['type' => 'external', 'name' => 'Облицовка кирпичом', 'description' => 'Облицовка фасадов декоративным и облицовочным кирпичом. Создаём красивые и долговечные фасады с улучшенной теплоизоляцией.'],
            ['type' => 'external', 'name' => 'Штукатурка', 'description' => 'Нанесение декоративной и цементно-песчаной штукатурки на фасады. Включает подготовку стен, армирование и финишную отделку.'],
            ['type' => 'external', 'name' => 'Деревянная обшивка', 'description' => 'Обшивка фасадов натуральным деревом: вагонка, блок-хаус, имитация бруса. Обработка антисептиками и защитными составами.'],
            ['type' => 'external', 'name' => 'Металлосайдинг', 'description' => 'Монтаж металлического сайдинга на фасады зданий. Долговечное решение с отличной устойчивостью к атмосферным воздействиям.'],
        ];

        foreach ($internalTypes as $index => $type) {
            \App\Models\FinishingType::create(array_merge($type, ['sort' => $index]));
        }

        foreach ($externalTypes as $index => $type) {
            \App\Models\FinishingType::create(array_merge($type, ['sort' => $index]));
        }
    }
}

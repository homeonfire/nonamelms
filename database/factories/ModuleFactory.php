<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class ModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Модуль: ' . fake()->sentence(3),
            'order_number' => fake()->randomDigitNotNull(),
        ];
    }
}

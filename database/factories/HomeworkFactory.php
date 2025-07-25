<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class HomeworkFactory extends Factory
{
    public function definition(): array
    {
        // Генерируем от 1 до 3 случайных вопросов
        $questions = [];
        for ($i = 0; $i < rand(1, 3); $i++) {
            $questions[] = ['q' => fake()->sentence() . '?'];
        }

        return [
            'questions' => $questions,
        ];
    }
}

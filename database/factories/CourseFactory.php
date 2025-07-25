<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Курс по ' . fake()->unique()->bs(),
            'description' => fake()->realText(200),
            'difficulty_level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
        ];
    }
}

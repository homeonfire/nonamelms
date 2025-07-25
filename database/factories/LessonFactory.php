<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
class LessonFactory extends Factory
{
    public function definition(): array
    {
        // Массив случайных видео-ссылок
        $videos = [
            'https://kinescope.io/kFJM3fEeZDnMJ6YKYLLEJa',
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'https://www.youtube.com/watch?v=VIDEO_ID',
        ];

        return [
            'title' => 'Урок: ' . fake()->sentence(4),
            'order_number' => fake()->randomDigitNotNull(),
            'content_url' => fake()->randomElement($videos),
            'content_text' => null, // Мы сгенерируем его позже в сидере
        ];
    }
}

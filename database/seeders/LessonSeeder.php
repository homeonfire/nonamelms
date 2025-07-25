<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Находим первый курс
        $course = Course::first();

        if ($course) {
            // Создаем для него модули
            $module1 = Module::create([
                'course_id' => $course->id,
                'title' => 'Введение в AI для кодинга',
                'order_number' => 1,
            ]);

            $module2 = Module::create([
                'course_id' => $course->id,
                'title' => 'Основные инструменты и техники',
                'order_number' => 2,
            ]);

            // Создаем уроки для модулей
            $module1->lessons()->createMany([
                ['title' => 'Почему AI для кодинга важен', 'order_number' => 1, 'content_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
                ['title' => 'Ландшафт Pre-AI кодинга', 'order_number' => 2],
            ]);

            $module2->lessons()->createMany([
                ['title' => 'Работа с GitHub Copilot', 'order_number' => 1],
                ['title' => 'Промпт-инжиниринг для разработчиков', 'order_number' => 2],
            ]);
        }
    }
}

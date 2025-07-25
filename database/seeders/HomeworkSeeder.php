<?php

namespace Database\Seeders;

use App\Models\Homework;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class HomeworkSeeder extends Seeder
{
    public function run(): void
    {
        // Находим первый урок в базе
        $lesson = Lesson::find(1);

        if ($lesson) {
            // Создаем для него домашнее задание
            Homework::create([
                'lesson_id' => $lesson->id,
                'questions' => [
                    ['q' => 'Что такое PHP?'],
                    ['q' => 'Куда шел Лось?'],
                ]
            ]);
        }
    }
}

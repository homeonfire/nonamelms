<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем категории
        $categories = collect(['Программирование', 'Дизайн', 'Маркетинг', 'AI', 'Бизнес', 'Аналитика'])
            ->map(fn ($name) => Category::factory()->create(['name' => $name, 'slug' => str($name)->slug()]));

        // 2. Создаем 20 курсов
        Course::factory(20)->create()->each(function ($course) use ($categories) {
            // Каждому курсу присваиваем от 1 до 3 случайных категорий
            $course->categories()->attach($categories->random(rand(1, 3))->pluck('id'));

            // 3. Для каждого курса создаем от 2 до 5 модулей
            Module::factory(rand(2, 5))->create(['course_id' => $course->id])->each(function ($module) {

                // 4. Для каждого модуля создаем от 3 до 8 уроков
                Lesson::factory(rand(3, 8))->create(['module_id' => $module->id])->each(function ($lesson) {

                    // 5. Каждому второму уроку добавляем домашнее задание
                    if (rand(0, 1)) {
                        $lesson->homework()->create(\App\Models\Homework::factory()->make()->toArray());
                    }

                    // 6. Каждому третьему уроку добавляем текстовый контент из Editor.js
                    if (rand(0, 2) === 0) {
                        $lesson->update(['content_text' => $this->generateEditorJsContent()]);
                    }
                });
            });
        });
    }

    // Вспомогательная функция для генерации контента в формате Editor.js
    private function generateEditorJsContent(): array
    {
        return [
            "time" => now()->timestamp,
            "blocks" => [
                [
                    "id" => "header1",
                    "type" => "header",
                    "data" => ["text" => fake()->sentence(5), "level" => 2]
                ],
                [
                    "id" => "para1",
                    "type" => "paragraph",
                    "data" => ["text" => fake()->realText(400)]
                ],
                [
                    "id" => "list1",
                    "type" => "list",
                    "data" => [
                        "style" => "unordered",
                        "items" => [fake()->sentence(), fake()->sentence(), fake()->sentence()]
                    ]
                ]
            ],
            "version" => "2.29.0"
        ];
    }
}

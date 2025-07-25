<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем категории
        $catCoding = Category::create(['name' => 'Программирование', 'slug' => 'programming']);
        $catDesign = Category::create(['name' => 'Дизайн', 'slug' => 'design']);
        $catMarketing = Category::create(['name' => 'Маркетинг', 'slug' => 'marketing']);
        $catAi = Category::create(['name' => 'AI', 'slug' => 'ai']);

        // Создаем курсы
        $course1 = Course::create([
            'title' => 'AI для Кодинга',
            'description' => 'Это практический курс, который научит разработчиков использовать ИИ на каждом этапе процесса разработки.',
            'difficulty_level' => 'intermediate'
        ]);

        $course2 = Course::create([
            'title' => 'UI/UX Дизайн для начинающих',
            'description' => 'Освойте основы создания интуитивно понятных и красивых интерфейсов с нуля.',
            'difficulty_level' => 'beginner'
        ]);

        $course3 = Course::create([
            'title' => 'Основы Digital-маркетинга',
            'description' => 'Полный курс по продвижению продуктов и услуг в цифровой среде.',
            'difficulty_level' => 'beginner'
        ]);

        // Привязываем категории к курсам
        $course1->categories()->attach([$catCoding->id, $catAi->id]);
        $course2->categories()->attach($catDesign->id);
        $course3->categories()->attach($catMarketing->id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Отображает страницу курса с конкретным уроком.
     *
     * @param Course $course Модель курса, автоматически найденная Laravel по ID из URL.
     * @param Lesson|null $lesson Модель урока, если его ID передан в URL.
     * @return View
     */
    public function show(Course $course, Lesson $lesson = null): View
    {
        // Получаем текущего авторизованного пользователя.
        $user = Auth::user();

        // --- Логика определения активного урока ---

        // Если в URL не был передан конкретный урок...
        if (is_null($lesson)) {
            // ...ищем запись о последнем просмотренном уроке в связующей таблице 'course_user'.
            $pivot = $user->courses()->where('course_id', $course->id)->first()?->pivot;
            $lastViewedLessonId = $pivot?->last_viewed_lesson_id;

            // Если нашли ID последнего урока, загружаем эту модель.
            if ($lastViewedLessonId) {
                $lesson = Lesson::find($lastViewedLessonId);
            } else {
                // Если записи нет (пользователь зашел в курс впервые), берем самый первый урок из первого модуля.
                $lesson = $course->modules()->first()?->lessons()->first();
            }
        }

        // --- Логика "запоминания" урока ---

        // Если у нас есть активный урок (не пустой курс),
        // обновляем запись в связующей таблице, указывая ID этого урока как "последний просмотренный".
        if ($lesson) {
            $user->courses()->updateExistingPivot($course->id, [
                'last_viewed_lesson_id' => $lesson->id,
            ]);
        }

        // --- Подготовка данных для страницы ---

        // "Жадно" загружаем все модули и уроки для этого курса, чтобы избежать лишних запросов к БД.
        $course->load('modules.lessons');

        // Если активный урок существует, загружаем связанное с ним ДЗ и ответ текущего пользователя на это ДЗ.
        $homework = $lesson?->load('homework')->homework;
        $userAnswer = $homework ? $user->homeworkAnswers()->where('homework_id', $homework->id)->first() : null;

        // --- Логика подсчета прогресса ---

        // Считаем общее количество уроков в курсе.
        $totalLessonsCount = $course->lessons()->count();

        // Получаем массив ID всех уроков этого курса, которые пользователь отметил как пройденные.
        $completedLessonIds = $user
            ->lessonProgress()
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->pluck('lesson_id')
            ->toArray();

        // Считаем количество пройденных уроков.
        $completedCount = count($completedLessonIds);

        // Вычисляем прогресс в процентах. Если в курсе 0 уроков, прогресс будет 0.
        $progressPercentage = ($totalLessonsCount > 0) ? round(($completedCount / $totalLessonsCount) * 100) : 0;

        // Проверяем, пройден ли конкретно текущий активный урок.
        $lessonIsCompleted = in_array($lesson?->id, $completedLessonIds);

        // --- Отправка данных в шаблон ---

        // Возвращаем вид 'courses.show' и передаем в него все собранные данные.
        return view('courses.show', [
            'course' => $course,
            'activeLesson' => $lesson,
            'homework' => $homework,
            'userAnswer' => $userAnswer,
            'progressPercentage' => $progressPercentage,
            'completedLessonIds' => $completedLessonIds,
            'lessonIsCompleted' => $lessonIsCompleted,
        ]);
    }
}

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
    /**
     * Отображает страницу курса с конкретным уроком.
     *
     * @param Course $course Модель курса, автоматически найденная Laravel по ID из URL.
     * @param Lesson|null $lesson Модель урока, если его ID передан в URL.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Course $course, Lesson $lesson = null)
    {
        // Получаем текущего авторизованного пользователя.
        $user = Auth::user();

        // --- НАЧАЛО НОВОЙ ЛОГИКИ: Проверка доступа к курсу ---
        // Проверяем, есть ли у пользователя запись о доступе в связующей таблице.
        $hasAccess = $user->courses()->where('course_id', $course->id)->exists();

        // Если у пользователя НЕТ доступа И курс платный (цена больше 0)...
        if (!$hasAccess && $course->price > 0) {
            // ...то не показываем контент, а перенаправляем его на страницу оплаты.
            return redirect()->route('payment.show', $course);
        }
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        // --- Логика определения активного урока (остается без изменений) ---
        if (is_null($lesson)) {
            $pivot = $user->courses()->where('course_id', $course->id)->first()?->pivot;
            $lastViewedLessonId = $pivot?->last_viewed_lesson_id;

            if ($lastViewedLessonId) {
                $lesson = Lesson::find($lastViewedLessonId);
            } else {
                $lesson = $course->modules()->first()?->lessons()->first();
            }
        }

        // --- Логика "запоминания" урока (остается без изменений) ---
        if ($lesson) {
            $user->courses()->updateExistingPivot($course->id, [
                'last_viewed_lesson_id' => $lesson->id,
            ]);
        }

        // --- Подготовка данных для страницы (остается без изменений) ---
        $course->load('modules.lessons');
        $homework = $lesson?->load('homework')->homework;
        $userAnswer = $homework ? $user->homeworkAnswers()->where('homework_id', $homework->id)->first() : null;

        // --- Логика подсчета прогресса (остается без изменений) ---
        $totalLessonsCount = $course->lessons()->count();
        $completedLessonIds = $user
            ->lessonProgress()
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->pluck('lesson_id')
            ->toArray();
        $completedCount = count($completedLessonIds);
        $progressPercentage = ($totalLessonsCount > 0) ? round(($completedCount / $totalLessonsCount) * 100) : 0;
        $lessonIsCompleted = in_array($lesson?->id, $completedLessonIds);

        // --- Отправка данных в шаблон (остается без изменений) ---
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

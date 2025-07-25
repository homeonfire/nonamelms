<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Загружаем курсы пользователя с данными из связующей таблицы и всеми уроками
        $myCourses = $user->courses()->withPivot('last_viewed_lesson_id')->with('lessons')->get();

        // --- НАЧАЛО НОВОЙ ЛОГИКИ: Подсчет прогресса для каждого курса ---
        $myCourses->each(function ($course) use ($user) {
            $totalLessonsCount = $course->lessons->count(); // Считаем общее количество уроков

            if ($totalLessonsCount > 0) {
                // Считаем, сколько уроков этого курса пройдено пользователем
                $completedLessonsCount = $user->lessonProgress()
                    ->whereIn('lesson_id', $course->lessons->pluck('id'))
                    ->count();
                // Вычисляем процент
                $course->progressPercentage = round(($completedLessonsCount / $totalLessonsCount) * 100);
            } else {
                // Если уроков нет, прогресс равен 0
                $course->progressPercentage = 0;
            }
        });
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        $myCourseIds = $myCourses->pluck('id');
        $recommendedCourses = Course::whereNotIn('id', $myCourseIds)->with('categories')->latest()->get();

        return view('dashboard', [
            'myCourses' => $myCourses,
            'recommendedCourses' => $recommendedCourses,
        ]);
    }
}

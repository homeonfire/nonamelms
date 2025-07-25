<?php

namespace App\Http\Controllers;

// Подключаем необходимые классы
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для доступа к авторизованному пользователю

class LessonProgressController extends Controller
{
    /**
     * Отмечает урок как пройденный для текущего пользователя.
     * URI: /lessons/{lesson}/complete
     * Method: POST
     *
     * @param Lesson $lesson Модель урока, автоматически найденная Laravel по ID из URL.
     */
    public function store(Lesson $lesson)
    {
        // 1. Получаем текущего авторизованного пользователя (Auth::user()).
        // 2. Обращаемся к его связи `lessonProgress()`, которую мы определили в модели User.
        // 3. Используем метод `firstOrCreate()`:
        //    - Он сначала пытается НАЙТИ запись в таблице `lesson_progress` с указанными `user_id` и `lesson_id`.
        //    - Если запись НЕ найдена, он СОЗДАЕТ новую.
        //    - Если запись уже СУЩЕСТВУЕТ, он ничего не делает.
        //    - Это идеальный способ избежать дубликатов и ошибок.
        Auth::user()->lessonProgress()->firstOrCreate(['lesson_id' => $lesson->id]);

        // Возвращаем пользователя на предыдущую страницу (на страницу урока, с которой он нажал кнопку).
        return back();
    }
}

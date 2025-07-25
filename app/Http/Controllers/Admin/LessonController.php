<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request, Module $module)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        $module->lessons()->create($validated);
        return back()->with('status', 'Урок успешно добавлен!');
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        $lesson->update($validated);
        return back()->with('status', 'Название урока успешно обновлено!');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('status', 'Урок успешно удален!');
    }

    /**
     * Показывает страницу для редактирования контента и ДЗ
     */
    public function editContent(Lesson $lesson)
    {
        $lesson->load('homework');
        return view('admin.lessons.content', compact('lesson'));
    }

    /**
     * Сохраняет контент и ДЗ
     */
    /**
     * Сохраняет контент урока и ДЗ
     */
    public function updateContent(Request $request, Lesson $lesson)
    {
        // 1. Получаем JSON-строку из скрытого поля формы
        $contentTextJson = $request->input('content_text');

        // 2. Декодируем ее в PHP-массив. Если строка пустая или некорректная, будет null.
        $contentTextArray = json_decode($contentTextJson, true);

        // 3. Обновляем основные поля урока
        $lesson->update([
            'content_url' => $request->input('content_url'),
            'content_text' => $contentTextArray, // Сохраняем массив, Laravel сам закодирует его в JSON
        ]);

        // 4. Работаем с вопросами домашнего задания
        $questions = $request->input('questions', []);

        // Убираем пустые/null значения из массива вопросов
        $filteredQuestions = array_filter($questions);

        if (!empty($filteredQuestions)) {
            // Превращаем массив строк в массив объектов для JSON
            $homeworkQuestions = array_map(fn($q) => ['q' => $q], $filteredQuestions);

            // Создаем или обновляем ДЗ для этого урока
            $lesson->homework()->updateOrCreate(
                ['lesson_id' => $lesson->id], // Условие для поиска
                ['questions' => $homeworkQuestions] // Данные для обновления/создания
            );
        } elseif ($lesson->homework) {
            // Если все вопросы были удалены, удаляем и само ДЗ
            $lesson->homework->delete();
        }

        // 5. Возвращаемся на страницу управления контентом курса
        return redirect()->route('admin.courses.content', $lesson->module->course_id)
            ->with('status', 'Контент урока успешно обновлен!');
    }
}

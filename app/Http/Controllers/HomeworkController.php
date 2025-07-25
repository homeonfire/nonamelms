<?php

namespace App\Http\Controllers;

// Подключаем необходимые классы
use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для доступа к авторизованному пользователю

class HomeworkController extends Controller
{
    /**
     * Обрабатывает отправку формы с домашним заданием от студента.
     * URI: /homeworks/submit
     * Method: POST
     *
     * @param Request $request Объект с данными из отправленной формы.
     */
    public function submit(Request $request)
    {
        // 1. Валидация входящих данных.
        // Laravel автоматически проверит, что:
        // - 'homework_id' был передан и существует в таблице 'homeworks'.
        // - 'answers' был передан и является массивом.
        // - Каждый элемент в массиве 'answers' является строкой (или null).
        // Если проверка не пройдена, Laravel вернет пользователя назад с ошибками.
        $validated = $request->validate([
            'homework_id' => 'required|exists:homeworks,id',
            'answers' => 'required|array',
            'answers.*' => 'nullable|string',
        ]);

        // 2. Преобразуем массив ответов из формы в нужный нам формат для хранения в JSON.
        // Например, массив ['Ответ 1', 'Ответ 2'] превратится в
        // [{'a': 'Ответ 1'}, {'a': 'Ответ 2'}]
        $answersToStore = array_map(function ($answer) {
            return ['a' => $answer ?? '']; // Если ответ пустой, сохраняем пустую строку
        }, $validated['answers']);

        // 3. Создаем запись с ответом в таблице `homework_answers`.
        // Мы используем связь `homeworkAnswers()` на модели User,
        // чтобы автоматически привязать этот ответ к текущему авторизованному пользователю (Auth::user()).
        Auth::user()->homeworkAnswers()->create([
            'homework_id' => $validated['homework_id'],
            'answers' => $answersToStore,
            'status' => 'submitted', // Устанавливаем начальный статус "сдано на проверку"
        ]);

        // 4. Возвращаем пользователя на предыдущую страницу (страницу урока)
        // и передаем в сессию сообщение об успехе.
        return back()->with('status', 'Домашнее задание успешно отправлено на проверку!');
    }
}

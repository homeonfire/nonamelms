<?php

namespace App\Http\Controllers;

// Подключаем необходимые классы (модели и т.д.)
use App\Models\HomeworkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonProgress;

// Контроллер, отвечающий за логику проверки домашних заданий администратором
class HomeworkCheckController extends Controller
{
    /**
     * Показывает страницу со списком всех работ, ожидающих проверки.
     * URI: /homework-check
     * Method: GET
     */
    public function index()
    {
        // Используем статический метод из модели для получения всех ДЗ со статусом 'submitted'
        $submissions = \App\Models\HomeworkAnswer::getSubmitted();
        // Возвращаем вид (view) и передаем в него полученные данные
        return view('homework-check.index', compact('submissions'));
    }

    /**
     * Показывает страницу для проверки одной конкретной работы.
     * URI: /homework-check/{submission}
     * Method: GET
     *
     * @param HomeworkAnswer $submission Модель ответа, автоматически найденная Laravel по ID из URL.
     */
    public function show(HomeworkAnswer $submission)
    {
        // "Жадно" подгружаем связанные данные: пользователя (user) и домашнее задание с уроком (homework.lesson)
        $submission->load('user', 'homework.lesson');
        // Возвращаем вид и передаем в него модель с уже загруженными данными
        return view('homework-check.check', compact('submission'));
    }

    /**
     * Обрабатывает вердикт администратора (принять/отклонить).
     * URI: /homework-check/{submission}
     * Method: POST
     *
     * @param Request $request Объект с данными из отправленной формы.
     * @param HomeworkAnswer $submission Модель ответа, к которой относится вердикт.
     */
    public function process(Request $request, HomeworkAnswer $submission)
    {
        // Получаем статус ('checked' или 'rejected') из данных формы
        $status = $request->input('status');

        // Простая проверка, чтобы убедиться, что статус пришел корректный
        if (!in_array($status, ['checked', 'rejected'])) {
            return back(); // Если статус некорректный, просто возвращаем пользователя назад
        }

        // Обновляем запись в базе данных: меняем статус, добавляем комментарий и ставим время проверки
        $submission->update([
            'status' => $status,
            'comment' => $request->input('comment'),
            'checked_at' => now(), // now() - хелпер Laravel для текущего времени
        ]);

        // --- Логика автоматического завершения урока ---
        // Если домашнее задание было принято...
        if ($status === 'checked') {
            // ...создаем новую запись в таблице прогресса (или ничего не делаем, если она уже есть).
            LessonProgress::firstOrCreate([
                'user_id' => $submission->user_id,
                'lesson_id' => $submission->homework->lesson_id,
            ]);
        }
        // --- Конец логики ---

        // Перенаправляем администратора обратно на страницу со списком работ и показываем сообщение об успехе.
        return redirect()->route('homework-check.index')->with('status', 'Работа успешно проверена!');
    }
}

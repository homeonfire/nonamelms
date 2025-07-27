<?php

namespace App\Http\Controllers;

// Подключаем необходимые классы
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// Контроллер, отвечающий за страницу "Мои ответы"
class MyAnswersController extends Controller
{
    /**
     * Отображает страницу со всеми домашними заданиями текущего пользователя.
     * URI: /my-answers
     * Method: GET
     *
     * @return View
     */
    public function index(): View
    {
        // 1. Получаем текущего авторизованного пользователя.
        $user = Auth::user();

        // 2. Получаем ВСЕ ответы этого пользователя из базы данных.
        $answers = $user
            ->homeworkAnswers() // Используем связь, определенную в модели User
            // `with()` — это "жадная загрузка". Она за один запрос получает все связанные данные:
            // ДЗ -> Урок -> Модуль -> Курс. Это очень эффективно и предотвращает множество мелких запросов к БД.
            ->with('homework.lesson.module.course')
            ->get(); // Выполняем запрос и получаем коллекцию ответов.

        // 3. Возвращаем вид (view) 'my-answers.index' и передаем в него данные.
        return view('my-answers.index', [
            // Laravel-коллекции позволяют легко фильтровать данные.
            // Создаем новую коллекцию, содержащую только ответы со статусом 'submitted'.
            'unchecked' => $answers->where('status', 'submitted'),
            // Создаем еще одну коллекцию, содержащую ответы со статусами 'checked' или 'rejected'.
            'checked' => $answers->whereIn('status', ['checked', 'rejected']),
        ]);
    }
}

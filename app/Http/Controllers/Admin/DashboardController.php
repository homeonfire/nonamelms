<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Показывает главную страницу админ-панели с основной статистикой.
     */
    public function index()
    {
        // Считаем общее количество курсов
        $totalCourses = Course::count();
        // Считаем общее количество пользователей
        $totalUsers = User::count();
        // Получаем 5 последних зарегистрированных пользователей
        $latestUsers = User::latest()->take(5)->get();
        // Получаем 5 последних созданных курсов
        $latestCourses = Course::latest()->take(5)->get();

        // Передаем все данные в шаблон
        return view('admin.dashboard', [
            'totalCourses' => $totalCourses,
            'totalUsers' => $totalUsers,
            'latestUsers' => $latestUsers,
            'latestCourses' => $latestCourses,
        ]);
    }
}

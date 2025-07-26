<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit; // Подключаем модель Visit
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Показывает страницу со списком всех визитов.
     */
    public function index()
    {
        // Получаем все визиты, загружая связанную модель пользователя, и сортируем по дате
        $visits = Visit::with('user')->latest()->get();

        return view('admin.visits.index', ['visits' => $visits]);
    }
}

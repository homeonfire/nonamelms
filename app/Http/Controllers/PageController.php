<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Показывает статическую страницу.
     */
    public function show(StaticPage $page): View
    {
        // Просто передаем модель страницы в шаблон. Вся магия будет в JS.
        return view('pages.show', ['page' => $page]);
    }
}

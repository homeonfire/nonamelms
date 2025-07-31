<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Показывает страницу со списком всех заказов.
     */
    public function index()
    {
        // Получаем все заказы, загружая связанные модели пользователя и курса, и сортируем по дате
        $orders = Order::with('user', 'course')->latest()->get();

        return view('admin.orders.index', ['orders' => $orders]);
    }
}

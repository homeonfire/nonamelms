<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Показывает детальную страницу заказа.
     */
    public function show(Order $order)
    {
        $order->load('user', 'course');
        // Просто передаем заказ, ссылка уже внутри него
        return view('admin.orders.show', ['order' => $order]);
    }
}

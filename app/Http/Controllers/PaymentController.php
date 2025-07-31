<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use App\Services\LeadPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function show(Course $course)
    {
        if (Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('dashboard')->with('status', 'У вас уже есть доступ к этому курсу!');
        }
        return view('payment.show', compact('course'));
    }

    public function process(Request $request, Course $course)
    {
        $user = Auth::user();
        $order = null;

        // --- НАЧАЛО НОВОЙ ЛОГИКИ ---

        // Если пользователь не авторизован
        if (!$user) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
                'terms' => 'required|accepted',
                'policy' => 'required|accepted',
            ]);

            // Ищем пользователя по почте или создаем нового
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'password' => Hash::make(Str::random(12)),
                ]
            );
        }

        // ИЩЕМ СУЩЕСТВУЮЩИЙ НЕОПЛАЧЕННЫЙ ЗАКАЗ
        $order = Order::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'pending')
            ->first();

        // Если заказ НЕ найден, создаем новый
        if (!$order) {
            $order = $course->orders()->create([
                'user_id' => $user->id,
                'amount' => $course->price,
                'status' => 'pending',
            ]);
        }

        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        // Генерируем ссылку на оплату для найденного или нового заказа
        $paymentUrl = (new LeadPayService())->generatePaymentLink($order, $request->input('phone'));

        if ($paymentUrl) {
            // Сохраняем/обновляем ссылку в заказе
            $order->update(['payment_url' => $paymentUrl]);
            return redirect()->away($paymentUrl);
        }

        return back()->with('error', 'Не удалось создать ссылку на оплату. Пожалуйста, попробуйте позже.');
    }
}

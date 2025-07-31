<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Http; // <-- Добавляем для отправки запросов

class LeadPayService
{
    private $settings;
    private $apiUrl = 'https://app.leadpay.ru/api/v1/getLink/'; // URL для получения ссылки

    public function __construct()
    {
        // Загружаем все настройки LeadPay при создании объекта
        $this->settings = PaymentSetting::where('gateway_name', 'leadpay')->pluck('value', 'key');
    }

    /**
     * НОВЫЙ МЕТОД: Генерирует ссылку на оплату для конкретного заказа.
     * @param Order $order
     * @return string|null
     */
    public function generatePaymentLink(Order $order): ?string
    {
        $user = $order->user;
        $token = $this->settings->get('token');

        // Собираем данные для запроса, как требует документация
        $data = [
            'login' => $this->settings->get('login'),
            'id' => (string) $order->id, // ID нашего заказа
            'product_id' => $order->course->leadpay_product_id, // ID продукта из настроек курса
            'count' => "1",
            'email' => $user->email,
            'phone' => '79999999999', // Заглушка, LeadPay требует это поле
            'fio' => $user->name,
            'notification_url' => route('webhooks.leadpay'),
            'redirect_url_ok' => route('dashboard'), // Куда вернуть пользователя после успеха
            'redirect_url_error' => route('dashboard'), // Куда вернуть после неудачи
        ];

        // Считаем хэш
        $data['hash'] = $this->calculateHash($data, $token);

        // Отправляем запрос в LeadPay
        $response = Http::asForm()->post($this->apiUrl, $data);

        if ($response->successful() && $response->json('status') === 'success') {
            return $response->json('url'); // Возвращаем ссылку на оплату
        }

        // В реальном проекте здесь нужно логировать ошибку
        // \Log::error('LeadPay Error: ' . $response->body());
        return null;
    }

    /**
     * НОВЫЙ МЕТОД: Считает HMAC-хэш для запроса.
     */
    private function calculateHash(array $data, string $token): string
    {
        ksort($data);
        $dataString = implode('', $data);
        return hash_hmac('sha256', $dataString, $token);
    }

    /**
     * Проверяет, валиден ли хэш, пришедший от LeadPay.
     * @param array $data - Массив данных из $_POST
     * @return bool
     */
    public function isHashValid(array $data): bool
    {
        $token = $this->settings->get('token');
        if (!isset($data['hash']) || !$token) {
            return false;
        }

        $receivedHash = $data['hash'];
        unset($data['hash']);

        ksort($data);
        $dataString = implode('', $data);
        $calculatedHash = hash_hmac('sha256', $dataString, $token);

        return hash_equals($calculatedHash, $receivedHash);
    }

    /**
     * Обрабатывает уведомление об оплате.
     * @param array $data - Данные из $_POST
     */
    public function handleWebhook(array $data): void
    {
        // 1. Проверяем подлинность запроса
        if (!$this->isHashValid($data)) {
            return;
        }

        // 2. Проверяем статус платежа
        if (isset($data['status']) && $data['status'] === 'success' && isset($data['order_id'])) {
            $order = Order::find($data['order_id']);

            if ($order && $order->status === 'pending') {
                // 3. Обновляем статус заказа
                $order->status = 'completed';
                $order->save();

                // 4. Выдаем пользователю доступ к курсу
                $order->user->courses()->syncWithoutDetaching([$order->course_id]);
            }
        }
    }
}

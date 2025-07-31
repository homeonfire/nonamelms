<?php

namespace App\Http\Controllers;

use App\Services\LeadPayService; // Подключаем наш сервис
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * Обрабатывает входящие уведомления от LeadPay.
     */
    public function handleLeadPay(Request $request)
    {
        // Создаем экземпляр нашего сервиса и передаем ему все данные из запроса
        $leadPayService = new LeadPayService();
        $leadPayService->handleWebhook($request->all());

        // Отвечаем LeadPay, что все в порядке
        return response('OK', 200);
    }
}

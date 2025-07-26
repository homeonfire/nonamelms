<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем ID посетителя из cookie или создаем новый
        $visitorId = $request->cookie('visitor_id', fn() => (string) Str::uuid());

        // Если в URL есть UTM-метки, записываем визит
        if ($request->has('utm_source')) {
            Visit::create([
                'visitor_id' => $visitorId,
                'user_id' => $request->user()?->id, // Если пользователь уже залогинен
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
                'utm_term' => $request->input('utm_term'),
                'utm_content' => $request->input('utm_content'),
                'landing_page' => $request->fullUrl(),
            ]);
        }

        // Получаем ответ от приложения
        $response = $next($request);

        // "Прикрепляем" cookie к ответу, если его не было
        if (!$request->hasCookie('visitor_id')) {
            // Устанавливаем cookie на 5 лет
            $response->cookie('visitor_id', $visitorId, 60 * 24 * 365 * 5);
        }

        return $response;
    }
}

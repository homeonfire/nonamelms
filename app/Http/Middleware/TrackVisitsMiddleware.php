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
        // 1. Пытаемся получить ID посетителя из cookie
        $visitorId = $request->cookie('visitor_id');
        $shouldSetCookie = false;

        // 2. Если ID не найден, генерируем новый
        if (!$visitorId) {
            $visitorId = (string) Str::uuid();
            $shouldSetCookie = true;
        }

        // 3. Если в URL есть UTM-метки, записываем визит
        if ($request->has('utm_source')) {
            Visit::create([
                'visitor_id' => $visitorId,
                'user_id' => $request->user()?->id,
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
                'utm_term' => $request->input('utm_term'),
                'utm_content' => $request->input('utm_content'),
                'landing_page' => $request->fullUrl(),
            ]);
        }

        // 4. Пропускаем запрос дальше по цепочке
        $response = $next($request);

        // 5. Если мы сгенерировали новый ID, "прикрепляем" cookie к ответу
        if ($shouldSetCookie) {
            // Устанавливаем cookie на 5 лет
            $response->cookie('visitor_id', $visitorId, 60 * 24 * 365 * 5);
        }

        return $response;
    }
}

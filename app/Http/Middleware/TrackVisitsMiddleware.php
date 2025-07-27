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
        $visitorId = $request->cookie('visitor_id');
        $shouldSetCookie = false;

        if (!$visitorId) {
            $visitorId = (string) Str::uuid();
            $shouldSetCookie = true;
        }

        // Если в URL есть UTM-метки, записываем визит со всеми данными
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
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
            ]);
        }

        $response = $next($request);

        if ($shouldSetCookie) {
            $response->cookie('visitor_id', $visitorId, 60 * 24 * 365 * 5);
        }

        return $response;
    }
}

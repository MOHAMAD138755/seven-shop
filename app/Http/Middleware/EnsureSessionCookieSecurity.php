<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionCookieSecurity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // اجرای درخواست و دریافت پاسخ
        $response = $next($request);

        // گرفتن تمام کوکی‌ها در هدر پاسخ
        $cookies = $response->headers->getCookies();

        foreach ($cookies as $cookie) {
            // فقط کوکی نشست لاراول را هدف قرار می‌دهیم
            if ($cookie->getName() === config('session.cookie')) {

                // تنظیمات مورد نظر را از پیکربندی بخوانیم
                $sameSite = config('session.same_site', 'lax');
                $isSecure = $request->isSecure(); // اگر HTTPS فعال است

                // بررسی نوع کوکی: Immutable (نسخه‌های جدید) یا Mutable (قدیمی)
                if (method_exists($cookie, 'withSameSite')) {
                    // ✅ نسخه‌های جدید Symfony (6+)
                    $secureCookie = $cookie
                        ->withHttpOnly(true)
                        ->withSecure($isSecure)
                        ->withSameSite($sameSite);

                    $response->headers->setCookie($secureCookie);
                } else {
                    // ✅ نسخه‌های قدیمی‌تر Symfony (5.x یا Laravel 8)
                    $cookie->setHttpOnly(true);
                    $cookie->setSecure($isSecure);
                    if (method_exists($cookie, 'setSameSite')) {
                        $cookie->setSameSite($sameSite);
                    }
                    $response->headers->setCookie($cookie);
                }
            }
        }

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);

        // CSP Header - Example (adjust as needed!)
        $response->header('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';");

        // HSTS Header
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // X-Frame-Options Header
        $response->header('X-Frame-Options', 'SAMEORIGIN');

        // X-Content-Type-Options Header
        $response->header('X-Content-Type-Options', 'nosniff');

        // X-Powered-By Header (optional but good for security to hide framework version)
        $response->headers->remove('X-Powered-By');

        return $response;
    }
}

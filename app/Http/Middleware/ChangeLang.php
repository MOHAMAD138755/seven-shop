<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = $request->segment(1);
        if(!array_key_exists($local, config('app.locales'))){
            $segments = $request->segments();
            $segments[0] = config('app.locale');
            return redirect(implode('/', $segments));
        }
        app()->setLocale($local);
        return $next($request);
    }
}

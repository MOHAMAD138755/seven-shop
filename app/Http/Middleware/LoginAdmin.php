<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()){
            return to_route('user.login',['lang' => app()->getLocale()]);
        }

        if(!auth()->check() || auth()->user()->hasRole('user')){
              return redirect('/');
        }

        return $next($request);
    }
}

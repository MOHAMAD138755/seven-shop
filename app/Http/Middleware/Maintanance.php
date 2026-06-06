<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Maintanance
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maintenance = Setting::where('key', 'maintenance')->value('value');

        if($maintenance == 'on' && !$request->is('fa/Dashboard/*')){
            return response()->view('DashboardAdmin.view-maintenance');
        }

        return $next($request);
    }
}

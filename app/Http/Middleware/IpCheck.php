<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class IpCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        $ip = $request->ip();
        $ip = '5.22.109.226';

        $data = Cache::remember('api_ip'.$ip,now()->addMinutes(30),function () use($ip){
            $response = Http::get('http://ip-api.com/json/'.$ip);

            if($response->failed()){
                return null;
            }

            return $response->json();

        });

        if(!$data || $data['status'] !== 'success'){
            abort(403,'خطایIp');
        }

        if(!empty($data['proxy']) && $data['proxy'] === true){
            abort(403,'proxy,vpn مجاز نیست');
        }

        return $next($request);
    }
}

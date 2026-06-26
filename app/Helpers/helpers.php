<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('settings')) {
    function settings()
    {
        return Cache::remember('settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }
}

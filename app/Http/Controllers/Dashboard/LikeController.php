<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LikeController extends Controller
{
    public function likes(): View
    {
        return view('DashboardAdmin.likes.likes');
    }
}

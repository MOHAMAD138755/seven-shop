<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    public function users(): View
    {
        return view('DashboardAdmin.users');
    }
}

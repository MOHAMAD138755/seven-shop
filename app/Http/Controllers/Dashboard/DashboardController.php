<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $admin = User::where('is_admin',1)->first();
        return view('DashboardAdmin.index',compact('admin'));
    }
}

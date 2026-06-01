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

    public function users(): View
    {
        return view('DashboardAdmin.users');
    }

    public function products(): View
    {
        return view('DashboardAdmin.products');
    }
}

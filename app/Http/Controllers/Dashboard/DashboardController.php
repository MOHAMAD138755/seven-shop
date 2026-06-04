<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $admin = User::where('is_admin',1)->first();
        return view('DashboardAdmin.index',compact('admin'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function config(): View
    {
        return view('DashboardAdmin.config');
    }
}

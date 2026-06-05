<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function update_config(Request $request): RedirectResponse
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::updateorcreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        \Flasher\Toastr\Prime\toastr('با موفقیت ذخیره شد');
        return back();

    }


    public function general(): View
    {
        return view('DashboardAdmin.config');
    }
    public function info(): View
    {
        return view('DashboardAdmin.info-site');
    }
}

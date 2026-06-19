<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('DashboardAdmin.index');
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

        if($request->hasFile('image')){
            $data['image'] = Storage::disk('public')->putFile("maintenance_images",$request->file('image'));
            $last_image = Setting::where('key','image')->first();
            Storage::disk('public')->delete($last_image->value);
        }

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

    public function email(): View
    {
        return view('DashboardAdmin.email-info');
    }

    public function email_test(Request $request): RedirectResponse
    {
        Mail::raw('Email settings are working correctly.', function ($message) use ($request) {
            $message->to($request->email)
            ->subject('Test email');
        });

        \Flasher\Toastr\Prime\toastr('ایمیل موفقیت ارسال شد','success');
        return back();

    }

    public function maintenance(): View
    {
        return view('DashboardAdmin.maintenance');
    }

    public function security(): View
    {
        return view('DashboardAdmin.security');
    }

    public function update_password(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|max:10|confirmed',
        ]);

        $user = Auth::user();
        if(!Hash::check($request->current_password,$user->password)){
            \Flasher\Toastr\Prime\toastr('رمز فعلی نادرست است','error');
            return back();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);
        \Flasher\Toastr\Prime\toastr('با موفقیت اپدیت شد','success');
        return back();
    }
}

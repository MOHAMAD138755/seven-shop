<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function register(): View
    {
        return view('Auth.register');
    }

    public function login(): View
    {
        return view('Auth.login');
    }

    public function user_login(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:4|max:15|regex:/^[A-Za-z\p{Arabic}\s]+$/u',
            'password'=> 'required|string|min:6|max:10',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $key = "login-attempts:" . $request->input('name') . '|' . $request->ip();

        if(RateLimiter::tooManyAttempts($key,3)){
            $second = RateLimiter::availableIn($key);
            return redirect()->back()->withErrors([
                'massage' => ceil($second / 60)."دقیقه دیگر امتحان کنید"
            ]);
        }

        $remember = $request->has('remember');
        if (Auth::attempt($request->only(['name', 'password']),$remember)) {

            $user = Auth::user();

            if(Hash::needsRehash($user['password'])) {
                $user['password'] = Hash::make($request['password']);
                $user->save();
            }

            RateLimiter::clear($key);
            $request->session()->regenerate();

            \Flasher\Toastr\Prime\toastr('ورود موفقیت آمیز بود','success');
            return to_route('Dashboard.َAdmin',['lang' => app()->getLocale()]);
        }

        RateLimiter::hit($key,200);

        \Flasher\Toastr\Prime\toastr('ورود موفقیت آمیز نبود','error');
        return back();

    }

    public function user_register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|unique:users,name|min:4|max:15|regex:/^[A-Za-z\p{Arabic}\s]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password'=> 'required|string|min:6|max:10|confirmed',
            'img' => 'file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storage = Storage::disk('public')->putFile('profile_images', $request->file('img'));

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_path' => $storage,
        ]);

        if ($user) {
            \Flasher\Toastr\Prime\toastr('ثبت نام موفقیت آمیز بود','success');
            return redirect('user.login');
        }

        \Flasher\Toastr\Prime\toastr('ثبت نام موفقیت آمیز نبود','success');
        return back();

    }
}

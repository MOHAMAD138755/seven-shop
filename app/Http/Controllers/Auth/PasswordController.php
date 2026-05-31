<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordController extends Controller
{
    public function new_password(): View
    {
        return view('Auth.new_password');
    }

    public function update_password(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if(!$user = User::where('email',$request['email'])->first()){
            \Flasher\Toastr\Prime\toastr('ایمیل یافت نشد','error');
            return back();
        }

        $token = Str::random(64);
        PasswordResetToken::create([
            'token' => $token,
            'email' => $user['email'],
            'created_at' => now(),
        ]);

        Mail::to($user['email'])->queue(new ResetPasswordMail($user,$token));
        \Flasher\Toastr\Prime\toastr('ایمیل با موفقیت ارسال شد','success');
        return redirect('/');
    }

    public function lastet_reset_password(Request $request): View
    {
        return view('Auth.reset_password',[
            'token' => $request['token'],
            'user' => $request['email'],
        ]);
    }

    public function update_pass(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:10|confirmed',
            'token' => 'required',
        ]);

        $user = PasswordResetToken::where('token',$request['token'])->first();

        if(Carbon::parse($user['created_at']) < now()->subMinutes(2)){
            $user->where('email',$request['email'])->delete();
            \Flasher\Toastr\Prime\toastr('زمان تغییر گذرواژه تمام شده','error');
            return redirect('/');
        }

        if(!$user){
            \Flasher\Toastr\Prime\toastr('کاربر پیدا نشد','info');
            return back();
        }

        $old_user = User::where('email',$request['email'])->first();

        if(Hash::check($request['password'],$old_user['password'])){
            \Flasher\Toastr\Prime\toastr('رمز عبور جدید  نباید تکراری باشد','success');
            return back();
        }

        $new_userpass = User::where('email',$user['email'])->update([
            'password' => Hash::make($request['password']),
        ]);

        $user->where('email',$request['email'])->delete();

        \Flasher\Toastr\Prime\toastr(' با موفقیت رمز ویرایش شد','success');
        return redirect('/');
    }
}

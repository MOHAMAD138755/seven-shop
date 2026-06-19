<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function users(): View
    {
        $users = User::paginate(5);
        return view('DashboardAdmin.users',compact('users'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|unique:users,name|min:4|max:15|regex:/^[A-Za-z\p{Arabic}\s]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password'=> 'required|string|min:6|max:10',
            'img' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storage = Storage::disk('public')->putFile('profile_images', $request->file('img'));

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_path' => $storage,
        ]);

        if ($user) {
            \Flasher\Toastr\Prime\toastr('کاربر با موفقیت اضاقه شد','success');
            return back();
        }

        \Flasher\Toastr\Prime\toastr('کاربر اضافه نشد','success');
        return back();
    }

    public function destroy(string $lang,User $user): RedirectResponse
    {
        $img = User::where('id',$user['id'])->get('profile_path');
        Storage::disk('public')->delete($img[0]->profile_path);

        $delete_user = $user->delete();
        if ($delete_user) {
            \Flasher\Toastr\Prime\toastr('کاربر با موفقیت حذف شد','success');
            return back();
        }
        \Flasher\Toastr\Prime\toastr('کاربر با موفقیت حذف نشد','error');
        return back();

    }

    public function editForm(string $lang,User $user): View
    {
        return view('DashboardAdmin.editUser',compact('user'));
    }

    public function update(string $lang,User $user,Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'string|min:4|max:15|regex:/^[A-Za-z\p{Arabic}\s]+$/u',
            'email' => 'email',
            'img' => 'file|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        if ($request->hasFile('img')) {

             $user->update([
                'profile_path' => Storage::disk('public')->delete($user->profile_path),
            ]);

            $path = Storage::disk('public')->putFile('profile_images', $request->file('img'));

             $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'profile_path' => $path
            ]);
        }

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        \Flasher\Toastr\Prime\toastr('کاربر با موفقیت ویرایش شد','success');
        return back();
    }

    public function search(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|min:4|max:15',
            'email' => 'nullable|string|email|max:20',
        ]);

        $query = User::query();

        if($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
        if($request->filled('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }
        $users = $query->where('is_admin',0)->paginate(5);

        return view('DashboardAdmin.users',compact('users'));

    }
}

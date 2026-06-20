<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function roles(): View
    {;
        $roles = Role::all();
        $permissions = Permission::all();
        return view('DashboardAdmin.roles.roles',compact('roles','permissions'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => 'required|string|unique:roles,name|max:25',
            'permission' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->role
        ]);

        $role->syncPermissions($request->permission);

        \Flasher\Toastr\Prime\toastr('با موفقیت اضاقه شد','success');
        return back();

    }

    public function destroy(string $lang,Role $role): RedirectResponse
    {
        if($role->name == 'administrator' || $role->name == 'writer' || $role->name == 'user'){
            \Flasher\Toastr\Prime\toastr('نقش سیستمی قابل حذف نیست','error');
            return back();
        }

        $role->delete();

        \Flasher\Toastr\Prime\toastr('با موفقیت حذف شد','success');
        return back();
    }

    public function editForm(string $lang,Role $role): View
    {
        $permissions = Permission::all();
        return view('DashboardAdmin.roles.edit-role',compact('role','permissions'));
    }

    public function update(string $lang,Role $role, Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:20',
            'permission' => 'nullable'
        ]);

        $role->update([
            'name' => $request->role
        ]);

        $role->syncPermissions($request->permission);

        \Flasher\Toastr\Prime\toastr('با موفقیت ویرایش شد','success');
        return back();
    }
}

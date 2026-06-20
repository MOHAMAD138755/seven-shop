<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function permissions(): View
    {
        $permissions = Permission::all();
        return view('DashboardAdmin.permissions.permissions',compact('permissions'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'permission' => 'required|string|unique:permissions,name|max:20',
        ]);

        Permission::create([
            'name' => $request->permission
        ]);

        \Flasher\Toastr\Prime\toastr('با موفقیت ساخته شد','success');
        return back();

    }

    public function destroy(string $lang, Permission $permission): RedirectResponse
    {
        $permission->delete();

        \Flasher\Toastr\Prime\toastr('با موفقیت حذف شد','success');
        return back();
    }

    public function editForm(string $lang, Permission $permission): View
    {
        return view('DashboardAdmin.permissions.edit-permission',compact('permission'));
    }

    public function update(string $lang, Permission $permission , Request $request): RedirectResponse
    {
        $request->validate([
            'permission' => 'required|string|unique:permissions,name|max:20',
        ]);

        $permission->update([
            'name' => $request->permission
        ]);

        \Flasher\Toastr\Prime\toastr('با موفقیت ویرایش شد','success');
        return back();

    }

}

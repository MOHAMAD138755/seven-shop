<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function categories(): View
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('DashboardAdmin.categories', compact('categories'));
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:15|min:3',
            'english_name' => 'required|unique:categories,name|max:15|min:3',
        ]);

        Category::create([
            'name' => $request['name'],
            'english_name' => $request['english_name'],
        ]);

        \Flasher\Toastr\Prime\toastr('دسته بندی با موفقیت ایجاد شد','success');
        return back();
    }

    public function destroy(string $lang,Category $category): RedirectResponse
    {
        $category->delete();

        \Flasher\Toastr\Prime\toastr('دسته بندی با موفقیت حذف شد','success');
        return back();
    }

    public function editForm(string $lang,Category $category): View
    {
        return view('DashboardAdmin.editCategory',compact('category'));
    }

    public function update(string $lang,Category $category,Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|max:15|min:3',
            'english_name' => 'required|max:15|min:3',
        ]);

        $category->update([
            'name' => $request['name'],
            'english_name' => $request['english_name'],
        ]);

        \Flasher\Toastr\Prime\toastr('دسته بندی با موفقیت ویرایش شد','success');
        return back();
    }
}

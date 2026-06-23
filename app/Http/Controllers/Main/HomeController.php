<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $newProducts = Product::where('count','!=',0)->latest()->take(8)->get();
        $categories = Category::with('products')->simplepaginate(5);
        return view('main.home',compact('categories','newProducts'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        \Flasher\Toastr\Prime\toastr('با موفقیت خارج شدید');
        return back();
    }

    public function category(string $lang, Category $category): View
    {
        return view('main.category.category',compact('category'));
    }

    public function product(string $lang , Product $product): View
    {
        return view('main.product.single-product',['product'=>$product]);
    }

}

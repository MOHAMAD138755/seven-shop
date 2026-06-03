<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function products(): View
    {
        $products = Product::with('category')->get();
        $categories = Category::all();
        return view('DashboardAdmin.products',['products' => $products,'categories' => $categories ]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:products,name|min:5|max:25',
            'description' => 'required|min:5|max:50',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:1024',
            'price' => 'required|numeric|min:1000|regex:/^\d*(\.\d{1,2})?$/',
            'category' => 'required',
            'count' => 'required|numeric|min:1',
        ]);

        $category = Category::where('name',$request['category'])->get('id')->first();

        $storage = Storage::disk('public')->putFile('products_images', $request->file('image'));

        Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $category['id'],
            'count' => $request['count'],
            'image' => $storage,
            'slug' => Str::slug($request['name'])
        ]);

        \Flasher\Toastr\Prime\toastr('محصول با موفقیت اضافه شد','success');
        return back();
    }
}

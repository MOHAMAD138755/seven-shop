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
        $products = Product::with('category')->paginate(5);
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

    public function destroy(string $lang, Product $product): RedirectResponse
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        \Flasher\Toastr\Prime\toastr('محصول با موفقیت حذف شد','success');
        return back();
    }

    public function editForm(string $lang, Product $product): View
    {
        $categories = Category::all();
        return view('DashboardAdmin.editProduct',['product' => $product , 'categories' => $categories]);
    }

    public function update(string $lang, Product $product , Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:5|max:15',
            'description' => 'required|min:5|max:50',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:1024',
            'price' => 'required|numeric|min:1000|regex:/^\d*(\.\d{1,2})?$/',
            'category' => 'required',
            'count' => 'required|numeric|min:1',
        ]);

        if($request->file('image')){
            Storage::disk('public')->delete($product->image);

            $storage = Storage::disk('public')->putFile('products_images', $request->file('image'));

            $product->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'count' => $request['count'],
                'category_id' => $request['category'],
                'image' => $storage,
            ]);

        }
        $product->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'count' => $request['count'],
            'category_id' => $request['category'],
        ]);

        \Flasher\Toastr\Prime\toastr('محصول با موفقیت ویرایش شد','success');
        return back();

    }

    public function search(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|min:3|max:15',
            'price' => 'nullable|string|max:10',
        ]);

        $query = Product::query();

        if($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
        if($request->filled('price')) {
            $query->where('price', 'LIKE', "%{$request->price}%");
        }
        $products = $query->paginate(5);
        $categories = Category::all();

        return view('DashboardAdmin.products',['products' => $products,'categories' => $categories ]);

    }
}

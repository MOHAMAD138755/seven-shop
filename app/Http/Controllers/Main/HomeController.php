<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $newProducts = Product::where('count','!=',0)->latest()->take(8)->get();
        $categories = Category::getAllCached(5);
        $BestSellers = Cache::remember('BestSellers', 86400, function () {
            return Product::getBestSellers();
        });
        return view('main.home',compact('categories','newProducts','BestSellers'));
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
        $comments = Comment::where('status',1)->where('product_id',$product->id)
            ->whereNull('parent_id')->with(['replies' => function ($query) {
                $query->where('status',1);
            }])->get();
        return view('main.product.single-product',['product'=>$product,'comments'=>$comments]);
    }

    public function create_comment(Request $request): RedirectResponse
    {
        $request->validate([
            'content'=>'required|max:200|string',
        ]);

        Comment::create([
            'content' => $request['content'],
            'product_id' => $request['product_id'],
            'user_id' => Auth::id(),
            'status' => 0,
        ]);

        \Flasher\Toastr\Prime\toastr('کامنت با موفقیت ایجاد شد','success');
        return back();
    }

    public function reply_comment(Request $request): RedirectResponse
    {
        $request->validate([
            'reply_content'=>'required|max:200|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        if($request->has('parent_id'))
        {
            $parentComment = Comment::find($request->parent_id);
            if($parentComment && $parentComment->user->id == Auth::id()){
                \Flasher\Toastr\Prime\toastr('شما نمی توانید به کامنت خود پاسخ دهید','error');
                return back();
            }
        }

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id,
            'content' => $request->reply_content
        ]);

        \Flasher\Toastr\Prime\toastr('پاسخ به کامنت با موفقیت ایجاد شد','success');
        return back();

    }

}

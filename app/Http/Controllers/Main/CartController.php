<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        if(auth()->check()) {

            $request->validate([
                'count' => 'required|integer|min:1'
            ]);

            $cart = Cart::where('user_id', auth()->id())->where('product_id',$request->product_id)->first();

            if($request->count > Product::where('id',$request->product_id)->value('count')) {
                \Flasher\Toastr\Prime\toastr('تعداد محصول خواسته شده بیش از موجود است', 'error');
                return back();
            }

            if($cart) {

                \Flasher\Toastr\Prime\toastr('محصول قبلا به سبد اضافه شده', 'error');
                return back();
            }

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->count
            ]);

            \Flasher\Toastr\Prime\toastr('به سبد خرید اضافه شد', 'success');
            return back();
        }

        \Flasher\Toastr\Prime\toastr('باید ابتدا لاگین کنید', 'error');
        return back();
    }

    public function show(): View
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('main.cart.carts',compact('carts'));
    }
}

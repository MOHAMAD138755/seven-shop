<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CartController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'count' => 'required|integer|min:1',
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if (auth()->check()) {

            $cart = Cart::where('user_id', auth()->id())->where('product_id', $request->product_id)->first();

            if ($request->count > Product::where('id', $request->product_id)->value('count')) {
                \Flasher\Toastr\Prime\toastr('تعداد محصول خواسته شده بیش از موجود است', 'error');
                return back();
            }

            if ($cart) {

                \Flasher\Toastr\Prime\toastr('محصول قبلا به سبد اضافه شده', 'error');
                return back();
            }

            Cart::create([
                'user_id' => auth()->id(),
                'token' => null,
                'product_id' => $request->product_id,
                'quantity' => $request->count
            ]);

            \Flasher\Toastr\Prime\toastr('به سبد خرید اضافه شد', 'success');
            return back();

        }

        $token = $request->cookie('cart_token');

        if (!$token) {
            $token = Str::uuid()->toString();
        }

        $cart = Cart::where('token', $token)->where('product_id', $request->product_id)->first();

        if ($request->count > Product::where('id', $request->product_id)->value('count')) {
            \Flasher\Toastr\Prime\toastr('تعداد محصول خواسته شده بیش از موجود است', 'error');
            return back();
        }

        if ($cart) {
            \Flasher\Toastr\Prime\toastr('محصول قبلا به سبد اضافه شده', 'error');
            return back();
        }

        Cart::create([
            'user_id' => null,
            'token' => $token,
            'product_id' => $request->product_id,
            'quantity' => $request->count
        ]);

        \Flasher\Toastr\Prime\toastr('به سبد خرید اضافه شد', 'success');
        return back()->withCookie(cookie('cart_token', $token, 60 * 24 * 30));
    }

    public function show(): View
    {
        SEOTools::setTitle('سبد خرید');

        if (auth()->check()) {

            $carts = Cart::with('product')
                ->where('user_id', auth()->id())
                ->whereHas('product', function ($query) {
                    $query->where('count', '>', 0);
                })
                ->get();
        } else {
            $token = request()->cookie('cart_token');
            $carts = Cart::with('product')->where('token', $token)
                ->whereHas('product', function ($query) {
                    $query->where('count', '>', 0);
                })->get();
        }

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
        return view('main.cart.carts', compact('carts', 'totalPrice'));
    }

    public function delete(Request $request): RedirectResponse
    {
        $cart = Cart::where('id', $request->cart_id);

        if (auth()->check()) {
            $cart->where('user_id', auth()->id());
        }else{
            $cart->where('token', $request->cookie('cart_token'));
        }

        $cart->firstOrFail()->delete();

        \Flasher\Toastr\Prime\toastr('از سبد خرید حذف شد', 'success');
        return back();
    }

    public function update(string $lang, Cart $cart, Request $request): RedirectResponse
    {
        $request->validate([
            'count' => 'required|integer|min:1'
        ]);

        if (auth()->check()) {
            abort_unless($cart->user_id === auth()->id(), 403);
        }else{
            abort_unless($cart->token === $request->cookie('cart_token'), 403);
        }

        if ($request->count > $cart->product->count) {
            \Flasher\Toastr\Prime\toastr('تعداد انتخاب شده بیش از موجودیت است', 'error');
            return back();
        }

        $cart->update([
            'quantity' => $request->count
        ]);

        \Flasher\Toastr\Prime\toastr('تعداد محصول ویرایش شد', 'success');
        return back();
    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\View\View;

class CheckOutController extends Controller
{
    public function index(): View
    {
        $carts = Cart::with('product')->where('user_id',auth()->id())->get();
        $totalPrice = $carts->sum(function ($cart){
            return $cart->product->price * $cart->quantity;
        });
        return view('main.checkout.index',compact('carts','totalPrice'));
    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
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

    public function submit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:80',
            'address' => 'required',
            'description' => 'nullable',
            'phone' => 'required|regex:/^09[0-9]{9}/',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        $totalPrice = $carts->sum(function ($cart){
            return $cart->product->price * $cart->quantity;
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'receiver_name' => $request->full_name,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'description' =>  $request->description,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($carts as $cart){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        return redirect()->route('payment.pay',['lang' => app()->getLocale(),'order' => $order->id]);

    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckOutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        SEOTools::setTitle('تسویه حساب');

        if (auth()->check()) {

            $carts = Cart::with('product')->where('user_id', auth()->id())->get();
            $totalPrice = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });
            $discount_amount = 0;
            $coupon = Coupon::where('code', session()->get('coupon_code'))->first();

            if ($coupon) {
                if ($coupon->type == 'percent') {
                    $discount_amount = ($totalPrice * $coupon->value) / 100;
                } else {
                    $discount_amount = $coupon->value;
                }

                if ($coupon->max_discount_amount !== null && $coupon->max_discount_amount < $discount_amount) {
                    $discount_amount = $coupon->max_discount_amount;
                }

                $discount_amount = min($discount_amount, $totalPrice);
            }

            $final_total_price = $totalPrice - $discount_amount;
            return view('main.checkout.index', compact('carts', 'totalPrice', 'final_total_price'));

        }
        \Flasher\Toastr\Prime\toastr('برای تسویه حساب لاگین کنید', 'error');
        return redirect()->route('cart.show', ['lang' => app()->getLocale()]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:80',
            'address' => 'required',
            'description' => 'nullable',
            'phone' => 'required|regex:/^09[0-9]{9}$/',
        ]);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();

        $totalPrice = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        $order = DB::transaction(function () use ($request, $carts, $totalPrice) {

            $order = Order::create([
                'user_id' => auth()->id(),
                'receiver_name' => $request->full_name,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'description' => $request->description,
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }

            return $order;

        });

        return redirect()->route('payment.pay', ['lang' => app()->getLocale(), 'order' => $order->id]);

    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->where('is_active',1)
            ->where('expires_at','>',now())->first();

        $carts = Cart::with('product')->where('user_id',auth()->id())
            ->orWhere('token',$request->cookie('cart_token'))->get();

        $total_price = $carts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if (!$coupon) {
            \Flasher\Toastr\Prime\toastr('کد تخفیف به درستی وارد نشده', 'error');
            return back()->withInput();
        }

        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            \Flasher\Toastr\Prime\toastr('کد تخفیف به سقف تعداد استفاده رسیده', 'error');
            return back()->withInput();
        }

        if ($coupon->min_order_amount !== null && $coupon->min_order_amount > $total_price) {
            \Flasher\Toastr\Prime\toastr('کد تخفیف شما برای این مبلغ خرید کم است', 'error');
            return back()->withInput();
        }

        session(['coupon_code' => $coupon->code]);

        \Flasher\Toastr\Prime\toastr('کد تخفیف شما درست است', 'success');
        return back()->withInput();

    }

    public function check_delete()
    {
        session()->forget('coupon_code');

        \Flasher\Toastr\Prime\toastr('کد تخفیف حذف شد','success');
        return back();
    }
}

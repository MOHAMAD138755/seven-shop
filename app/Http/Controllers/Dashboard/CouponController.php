<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function show(): View
    {
        $coupons = Coupon::paginate(7);
        return view('DashboardAdmin.coupons.coupons',compact('coupons'));
    }

    public function destroy(string $lang,Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        \Flasher\Toastr\Prime\toastr('با موفقیت حذف شد');
        return back();
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'code'=>'required|unique:coupons,code|string|min:1|max:100',
            'types'=>'required|string|in:percent,fixed',
            'value'=>['required','numeric',Rule::when($request->input('types')=='percent',['between:1,99']),
                Rule::when($request->input('types')=='fixed',['between:100000,100000000']),],
            'max_discount_amount'=>'numeric|nullable|between:100000,100000000',
            'min_order_amount'=>'numeric|nullable|between:100000,100000000',
            'usage_limit'=>'numeric|required|between:0,200',
            'start_at'=>'date|nullable|after:now',
            'expires_at'=>'date|nullable|after:start_at',
            'is_active'=>'required|boolean',
        ]);

        Coupon::create([
            'code' => $request->code,
            'type' => $request->types,
            'value' => $request->value,
            'max_discount_amount' => $request->max_discount_amount,
            'min_order_amount' => $request->min_order_amount,
            'usage_limit' => $request->usage_limit,
            'start_at' => $request->start_at,
            'expires_at' => $request->expires_at,
            'is_active' => $request->is_active
        ]);

        \Flasher\Toastr\Prime\toastr('با موفقیت ساخته شد');
        return back();
    }
}

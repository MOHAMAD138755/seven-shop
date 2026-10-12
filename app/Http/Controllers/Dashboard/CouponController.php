<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function show(): View
    {
        $coupons = Coupon::paginate(7);
        return view('DashboardAdmin.coupons.coupons',compact('coupons'));
    }
}

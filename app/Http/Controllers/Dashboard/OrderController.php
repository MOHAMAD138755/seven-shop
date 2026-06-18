<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function orders(): View
    {
        $orders = Order::with('user')->latest()->paginate(7);
        return view('DashboardAdmin.orders.orders',compact('orders'));
    }
}

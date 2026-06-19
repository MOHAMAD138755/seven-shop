<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function orders(): View
    {
        $orders = Order::with('user')->latest()->paginate(7);
        return view('DashboardAdmin.orders.orders',compact('orders'));
    }

    public function update(string $lang, Order $order,Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,paid,delivered,cancelled,shipped,processing',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        \Flasher\Toastr\Prime\toastr('وضعیت با موفقیت بروزرسانی شد','success');
        return back();

    }

}

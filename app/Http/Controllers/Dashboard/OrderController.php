<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusChanged;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function orders(): View
    {
        $orders = Order::with('user','items.product')->latest()->paginate(7);
        return view('DashboardAdmin.orders.orders',compact('orders'));
    }

    public function update(string $lang, Order $order,Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,paid,delivered,cancelled,shipped,processing',
        ]);

        $orderStatus = $order->status;
        $newStatus = $request->status;

        if(in_array($newStatus,['paid','shipped']) && $orderStatus !== $newStatus){
            $order->user->notify(new OrderStatusChanged($order,$newStatus));
        }

        $order->update([
            'status' => $request->status
        ]);

        \Flasher\Toastr\Prime\toastr('وضعیت با موفقیت بروزرسانی شد','success');
        return back();

    }

}

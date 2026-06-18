<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function orders(): View
    {
        return view('DashboardAdmin.orders.orders');
    }
}

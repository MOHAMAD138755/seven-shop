<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;

class PaymentController extends Controller
{
    public function pay(string $lang,Order $order)
    {
        dd($order);
    }

    public function verify()
    {
        dd('ok');
    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function pay(string $lang,Order $order)
    {
        $invoice = (new Invoice())->amount($order->total_price);
        return Payment::purchase($invoice,function($driver,$transactionId) use ($order){

            $order->update([
                'authority' => $transactionId,
            ]);

        })->pay()->render();
    }

    public function verify()
    {
        dd('ok');
    }
}

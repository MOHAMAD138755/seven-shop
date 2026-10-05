<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function pay(string $lang, Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $invoice = (new Invoice())->amount($order->total_price);

        return Payment::purchase($invoice, function ($driver, $transactionId) use ($order) {

            $order->update([
                'authority' => $transactionId,
            ]);

        })->pay()->render();
    }

    public function verify()
    {
        $order = Order::where('authority', request()->input('Authority'))->firstOrFail();

        try {
            $receipt = Payment::amount($order->total_price)->transactionId(request()->input('Authority'))->verify();

            DB::transaction(function () use ($order, $receipt) {

                $order = Order::whereKey($order->id)->lockForUpdate()->firstOrFail();

                if ($order->status == 'paid'){
                    return;
                }

                $order->update([
                    'status' => 'paid',
                    'ref_id' => $receipt->getReferenceId(),
                ]);

                foreach ($order->items as $item) {
                    $product = $item->product()->lockForUpdate()->firstOrFail();

                    if ($product->count < $item->quantity) {
                        throw new \Exception('موجودی کافی نیست');
                    }
                    $product->decrement('count', $item->quantity);
                }

                Cart::where('user_id', $order->user_id)->delete();

            });
            \Flasher\Toastr\Prime\toastr('خرید با موفقیت انجام شد','success');
            return redirect()->route('order.details',['lang'=>app()->getLocale()]);

        } catch (InvalidPaymentException $exception) {
            return redirect()->route('cart.show',['lang'=>app()->getLocale()])->with('message', $exception->getMessage());
        }

    }

    public function details(): View
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())
            ->where('status','paid')->latest()->firstOrFail();
        return view('main.order.details',compact('order'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        $carts = Cart::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong.');
        }

        $totalPrice = $carts->sum(
            fn($item) => $item->product->price * $item->quantity
        );

        $order = DB::transaction(function () use ($request, $carts, $totalPrice) {
            $invoiceNumber = $this->generateInvoiceNumber();

            $newOrder = Order::create([
                'user_id' => $request->user()->id,
                'invoice_number' => $invoiceNumber,
                'total_price' => $totalPrice,
            ]);

            foreach ($carts as $cart) {
                $newOrder->orderDetails()->create([
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                ]);
                $cart->product->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', $request->user()->id)->delete();

            return $newOrder;
        });

        $params = [
            'transaction_details' => [
                'order_id' => $order->invoice_number,
                'gross_amount' => $order->total_price,
            ]
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->update(['snap_token' => $snapToken]);

        return redirect()->route('customer.orders.show', ['invoice_number' => $order->invoice_number])
            ->with('success', __('Checkout successful! Your order is being processed.'));
    }

    private function generateInvoiceNumber()
    {
        $now = now();
        $formattedNow = $now->format('Ymd');

        do {
            $randomString = Str::upper(Str::random(8));
            $invoice = "INV-$formattedNow-$randomString";
        } while (Order::where('invoice_number', $invoice)->exists());

        return $invoice;
    }
}

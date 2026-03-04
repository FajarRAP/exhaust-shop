<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('customer.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, string $invoice_number)
    {
        $order = Order::with('orderDetails')
            ->where('user_id', $request->user()->id)
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        return view('customer.orders.show', [
            'order' => $order,
        ]);
    }
}

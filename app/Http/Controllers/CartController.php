<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::with('product')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('customer.cart.index', [
            'carts' => $carts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $product = Product::findOrFail($request->product_id);
        $user_id = $request->user()->id;

        if ($product->stock < $request->quantity) {
            return back()->with('error', __('Insufficient stock!'));
        }

        $existingCart = Cart::where('user_id', $user_id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            $newQuantity = $existingCart->quantity + $request->quantity;

            if ($newQuantity > $product->stock) {
                return back()->with('error', __('Total quantity in cart exceeds remaining stock!'));
            }

            $existingCart->update(['quantity' => $newQuantity]);
        } else {

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('customer.cart.index')->with('success', __('Product has been added to cart!'));
    }

    public function destroy(Request $request, Cart $cart)
    {
        if ($cart->user_id !== $request->user()->id) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', __('Product removed from cart.'));
    }
}

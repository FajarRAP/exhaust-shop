<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::with('category')->latest()->paginate(12);

        return view('customer.dashboard', [
            'products' => $products
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'totalCategories' => $totalCategories,
        ]);
    }
}

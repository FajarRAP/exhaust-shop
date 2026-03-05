<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $currentMonthRevenue = Order::where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');
        $pendingOrdersCount = Order::where('status', 'pending')->count();

        $orderStatusData = [
            [
                'label' => __('Paid'),
                'value' => Order::where('status', 'paid')->count(),
            ],
            [
                'label' => __('Pending'),
                'value' => Order::where('status', 'pending')->count(),
            ],
            [
                'label' => __('Failed'),
                'value' => Order::where('status', 'failed')->count(),
            ],
            [
                'label' => __('Expired'),
                'value' => Order::where('status', 'expired')->count(),
            ],
            [
                'label' => __('Cancelled'),
                'value' => Order::where('status', 'cancelled')->count(),
            ],
            // 'paid' => Order::where('status', 'paid')->count(),
            // 'pending' => Order::where('status', 'pending')->count(),
            // 'failed' => Order::where('status', 'failed')->count(),
            // 'expired' => Order::where('status', 'expired')->count(),
            // 'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // 3. Data untuk Grafik Bar (Pendapatan 7 Hari Terakhir)
        $last7Days = [];
        $revenue7Days = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $last7Days[] = $date->format('d M');

            $dailyRevenue = Order::where('status', 'paid')
                ->whereDate('created_at', $date)
                ->sum('total_price');

            $revenue7Days[] = $dailyRevenue;
        }

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'currentMonthRevenue' => $currentMonthRevenue,
            'pendingOrdersCount' => $pendingOrdersCount,
            'totalCustomers' => $totalCustomers,
            'orderStatusData' => $orderStatusData,
            'last7Days' => $last7Days,
            'revenue7Days' => $revenue7Days,
            'recentOrders' => $recentOrders,
        ]);
    }
}

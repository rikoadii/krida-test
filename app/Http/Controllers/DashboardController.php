<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('grandtotal');
        $totalCustomers = Customer::count();
        $activeItems = Item::count();

        $recentOrders = Order::with('customer')
            ->orderByDesc('orderDate')
            ->orderByDesc('orderId')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'activeItems',
            'recentOrders'
        ));
    }
}

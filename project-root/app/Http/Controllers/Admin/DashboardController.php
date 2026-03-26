<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'customers' => User::count(),
        ];

        $latestOrders = Order::latest('id')->take(8)->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->latest('id')->take(8)->get();

        return view('admin.dashboard', compact('stats', 'latestOrders', 'lowStockProducts'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $keyword = trim((string) $request->get('keyword'));
        $status = $request->get('status');

        $orders = Order::when($keyword, function ($query) use ($keyword) {
                $query->where('order_code', 'like', "%{$keyword}%")
                    ->orWhere('customer_name', 'like', "%{$keyword}%")
                    ->orWhere('customer_phone', 'like', "%{$keyword}%");
            })
            ->when($status, function ($query) use ($status) {
                $query->where('order_status', $status);
            })
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'keyword', 'status'));
    }

    public function show(Order $order): View
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'order_status' => ['required', 'string', 'max:50'],
            'payment_status' => ['required', 'string', 'max:50'],
        ]);

        $order->update($data);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Cập nhật đơn hàng thành công.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Xóa đơn hàng thành công.');
    }
}
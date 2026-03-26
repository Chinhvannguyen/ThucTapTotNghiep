<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (!is_array($cart) || empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống');
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 1));
        });

        $shippingFee = 30000;
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact('cart', 'subtotal', 'shippingFee', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!is_array($cart) || empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống');
        }

        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'address_line' => 'required|string|max:255',
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'province.required' => 'Vui lòng nhập tỉnh/thành',
            'district.required' => 'Vui lòng nhập quận/huyện',
            'ward.required' => 'Vui lòng nhập phường/xã',
            'address_line.required' => 'Vui lòng nhập địa chỉ cụ thể',
        ]);

        $subtotal = collect($cart)->sum(function ($item) {
            return ((float) ($item['price'] ?? 0)) * ((int) ($item['quantity'] ?? 1));
        });

        $shippingFee = 30000;
        $total = $subtotal + $shippingFee;

        $order = DB::transaction(function () use ($request, $cart, $subtotal, $shippingFee, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => 'OD' . now()->format('YmdHis') . random_int(10, 99),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'address_line' => $request->address_line,
                'subtotal' => $subtotal,
                'discount_amount' => 0,
                'shipping_fee' => $shippingFee,
                'total_amount' => $total,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $price = (float) ($item['price'] ?? 0);
                $quantity = (int) ($item['quantity'] ?? 1);

                $order->items()->create([
                    'product_id' => $item['id'] ?? null,
                    'product_name' => $item['name'] ?? 'Sản phẩm',
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $price * $quantity,
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id)
            ->with('success', 'Đặt hàng thành công');
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (!is_array($cart)) {
            $cart = [];
        }

        return view('cart.index', compact('cart'));
    }

    public function add(Product $product, Request $request)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $emotion = $request->input('emotion');

        $cart = session()->get('cart', []);

        if (!is_array($cart)) {
            $cart = [];
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty;

            if (!empty($emotion)) {
                $cart[$product->id]['emotion'] = $emotion;
            }
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price ?: $product->price,
                'thumbnail' => $product->thumbnail ?: 'assets/images/no-image.jpg',
                'quantity' => $qty,
                'slug' => $product->slug,
                'emotion' => $emotion,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update($id, Request $request)
    {
        $qty = max(1, (int) $request->input('quantity', 1));
        $cart = session()->get('cart', []);

        if (!is_array($cart)) {
            $cart = [];
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (!is_array($cart)) {
            $cart = [];
        }

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }
}
@extends('layouts.app')

@section('title', 'Thanh toán | Người Trái Đất')

@section('content')
@php
    $cart = is_array($cart ?? null) ? $cart : [];
    $subtotal = (float) ($subtotal ?? 0);
    $shippingFee = (float) ($shippingFee ?? 0);
    $total = (float) ($total ?? 0);

    $user = $user ?? auth()->user();
    $defaultAddress = $defaultAddress ?? null;
@endphp

<div class="container py-5">
    <h1>Thanh toán</h1>

    @if(session('error'))
        <div style="margin: 12px 0; color: red;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="margin: 12px 0; color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) === 0)
        <div style="margin-top: 20px;">
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('products.index') }}" class="btn-primary">Tiếp tục mua sắm</a>
        </div>
    @else
        <div style="display:grid; grid-template-columns: 1.2fr 0.8fr; gap: 30px; align-items:start;">
            <div>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    @if($user)
                        <div style="margin-bottom:16px; color:#2f7a62; font-weight:600;">
                            Bạn đang đặt hàng với tài khoản: {{ $user->name }}
                        </div>
                    @endif

                    <div style="margin-bottom:12px;">
                        <label for="customer_name">Họ tên</label><br>
                        <input
                            id="customer_name"
                            type="text"
                            name="customer_name"
                            value="{{ old('customer_name', $user->name ?? '') }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('customer_name')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="customer_phone">Số điện thoại</label><br>
                        <input
                            id="customer_phone"
                            type="text"
                            name="customer_phone"
                            value="{{ old('customer_phone', $user->phone ?? ($defaultAddress->phone ?? '')) }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('customer_phone')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="province">Tỉnh / Thành</label><br>
                        <input
                            id="province"
                            type="text"
                            name="province"
                            value="{{ old('province', $defaultAddress->province ?? '') }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('province')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="district">Quận / Huyện</label><br>
                        <input
                            id="district"
                            type="text"
                            name="district"
                            value="{{ old('district', $defaultAddress->district ?? '') }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('district')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="ward">Phường / Xã</label><br>
                        <input
                            id="ward"
                            type="text"
                            name="ward"
                            value="{{ old('ward', $defaultAddress->ward ?? '') }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('ward')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="margin-bottom:12px;">
                        <label for="address_line">Địa chỉ cụ thể</label><br>
                        <input
                            id="address_line"
                            type="text"
                            name="address_line"
                            value="{{ old('address_line', $defaultAddress->address_line ?? '') }}"
                            style="width:100%; padding:10px;"
                        >
                        @error('address_line')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div style="display:flex; gap:12px; margin-top:20px;">
                        <a href="{{ route('cart.index') }}" class="btn-primary" style="text-decoration:none; display:inline-block; padding:10px 16px;">
                            Quay lại giỏ hàng
                        </a>

                        <button type="submit" class="btn-primary">
                            Đặt hàng
                        </button>
                    </div>
                </form>
            </div>

            <div style="border:1px solid #ddd; padding:20px; border-radius:10px;">
                <h3 style="margin-top:0;">Tóm tắt đơn hàng</h3>

                <div style="margin-bottom:16px;">
                    @foreach($cart as $item)
                        @php
                            $name = $item['name'] ?? 'Sản phẩm';
                            $price = (float) ($item['price'] ?? 0);
                            $quantity = (int) ($item['quantity'] ?? 1);
                            $lineTotal = $price * $quantity;
                        @endphp

                        <div style="display:flex; justify-content:space-between; gap:12px; margin-bottom:10px;">
                            <div>
                                <strong>{{ $name }}</strong><br>
                                <small>Số lượng: {{ $quantity }}</small>
                            </div>
                            <div>{{ number_format($lineTotal, 0, ',', '.') }} đ</div>
                        </div>
                    @endforeach
                </div>

                <hr>

                <p>Tạm tính: <strong>{{ number_format($subtotal, 0, ',', '.') }} đ</strong></p>
                <p>Phí ship: <strong>{{ number_format($shippingFee, 0, ',', '.') }} đ</strong></p>
                <p>Tổng tiền: <strong>{{ number_format($total, 0, ',', '.') }} đ</strong></p>
            </div>
        </div>
    @endif
</div>
@endsection
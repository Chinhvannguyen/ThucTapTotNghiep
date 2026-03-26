@extends('layouts.app')

@section('title', 'Giỏ hàng | Người Trái Đất')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
@endpush

@section('content')
<section class="cart-page">
    <div class="container">
        <div class="cart-steps">
            <span class="active">GIỎ HÀNG</span>
            <span>CHI TIẾT THANH TOÁN</span>
            <span>ĐƠN HÀNG HOÀN TẤT</span>
        </div>

        @if(session('success'))
            <div class="cart-alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="cart-alert error">{{ session('error') }}</div>
        @endif

        @php
            $subtotal = 0;
        @endphp

        <div class="cart-layout">
            <div class="cart-left">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th class="cart-col-product">SẢN PHẨM</th>
                                <th>GIÁ</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TẠM TÍNH</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($cart as $item)
                                @php
                                    $lineTotal = $item['price'] * $item['quantity'];
                                    $subtotal += $lineTotal;

                                    $thumb = !empty($item['thumbnail'])
                                        ? (filter_var($item['thumbnail'], FILTER_VALIDATE_URL)
                                            ? $item['thumbnail']
                                            : asset($item['thumbnail']))
                                        : asset('assets/images/no-image.jpg');
                                @endphp

                                <tr>
                                    <td>
                                        <div class="cart-product-info">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="remove-item-btn">×</button>
                                            </form>

                                            <img src="{{ $thumb }}" alt="{{ $item['name'] }}">

                                            <div class="cart-product-meta">
                                                <div class="cart-product-name">
                                                    {{ $item['name'] }}
                                                </div>

                                                @if(!empty($item['emotion']))
                                                    <div class="cart-product-emotion">
                                                        Cảm xúc: {{ $item['emotion'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="price-cell">
                                        {{ number_format($item['price'], 0, ',', '.') }} đ
                                    </td>

                                    <td>
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="qty-form-inline">
                                            @csrf

                                            <div class="cart-qty-box">
                                                <button type="button" onclick="decreaseQty(this)">-</button>
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                                <button type="button" onclick="increaseQty(this)">+</button>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="subtotal-cell">
                                        {{ number_format($lineTotal, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-cart-box">
                                            Giỏ hàng của bạn đang trống.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(count($cart))
                    <div class="cart-action-row">
                        <a href="{{ route('products.index') }}" class="continue-shopping-btn">
                            ← TIẾP TỤC XEM SẢN PHẨM
                        </a>

                        <button type="button" class="update-cart-btn" onclick="submitAllQtyForms()">
                            CẬP NHẬT GIỎ HÀNG
                        </button>
                    </div>
                @endif
            </div>

            <div class="cart-right">
                <div class="cart-summary-card">
                    <h3>TỔNG CỘNG GIỎ HÀNG</h3>

                    <div class="summary-row">
                        <span>Tạm tính</span>
                        <strong>{{ number_format($subtotal, 0, ',', '.') }} đ</strong>
                    </div>

                    <div class="summary-row shipping-row">
                        <span>Giao hàng</span>
                        <div class="shipping-note">
                            <div>Free shipping</div>
                            <small>Tùy chọn giao hàng sẽ được cập nhật trong quá trình thanh toán.</small>
                        </div>
                    </div>

                    <div class="summary-row total">
                        <span>Tổng</span>
                        <strong>{{ number_format($subtotal, 0, ',', '.') }} đ</strong>
                    </div>

                    @if(count($cart))
                        <a href="{{ route('checkout.index') }}" class="checkout-btn">
                            TIẾN HÀNH THANH TOÁN
                        </a>
                    @endif

                    <div class="coupon-box">
                        <label>Mã ưu đãi</label>
                        <input type="text" placeholder="Nhập mã giảm giá">
                        <button type="button">Áp dụng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function decreaseQty(btn) {
        const input = btn.parentElement.querySelector('input');
        let value = parseInt(input.value) || 1;
        value--;
        if (value < 1) value = 1;
        input.value = value;
    }

    function increaseQty(btn) {
        const input = btn.parentElement.querySelector('input');
        let value = parseInt(input.value) || 1;
        value++;
        input.value = value;
    }

    function submitAllQtyForms() {
        document.querySelectorAll('.qty-form-inline').forEach(form => form.submit());
    }
</script>
@endsection
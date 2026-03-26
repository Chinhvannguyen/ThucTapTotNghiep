@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Giỏ hàng</h1>

    @if(session('success'))
        <div style="margin: 12px 0; color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="margin: 12px 0; color: red;">{{ session('error') }}</div>
    @endif

    @php $total = 0; @endphp

    @if(count($cart))
        @foreach($cart as $item)
            @php $lineTotal = $item['price'] * $item['quantity']; $total += $lineTotal; @endphp

            <div style="display:flex; gap:20px; align-items:center; margin-bottom:20px; border-bottom:1px solid #ddd; padding-bottom:20px;">
                <img src="{{ asset($item['thumbnail']) }}" alt="{{ $item['name'] }}" width="100">

                <div style="flex:1;">
                    <h3>{{ $item['name'] }}</h3>
                    <p>{{ number_format($item['price']) }} đ</p>

                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:70px;">
                        <button type="submit">Cập nhật</button>
                    </form>

                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline-block; margin-left:10px;">
                        @csrf
                        <button type="submit">Xóa</button>
                    </form>
                </div>

                <strong>{{ number_format($lineTotal) }} đ</strong>
            </div>
        @endforeach

        <h3>Tổng cộng: {{ number_format($total) }} đ</h3>

        <a href="{{ route('checkout.index') }}" class="btn-primary">Tiến hành thanh toán</a>
    @else
        <p>Giỏ hàng trống.</p>
    @endif
</div>
@endsection
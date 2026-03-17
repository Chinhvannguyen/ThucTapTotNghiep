@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Đặt hàng thành công</h1>
    <p>Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>
    <p>Khách hàng: {{ $order->customer_name }}</p>
    <p>Số điện thoại: {{ $order->customer_phone }}</p>
    <p>Tổng thanh toán: <strong>{{ number_format($order->total_amount) }} đ</strong></p>

    <a href="{{ route('home') }}">Quay về trang chủ</a>
</div>
@endsection
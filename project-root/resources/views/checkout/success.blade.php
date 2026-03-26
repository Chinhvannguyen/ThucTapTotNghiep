@extends('layouts.app')

@section('title', 'Đặt hàng thành công | Người Trái Đất')

@section('content')
@php
    $orderCode = $order->order_code ?? '---';
    $customerName = $order->customer_name ?? '---';
    $customerPhone = $order->customer_phone ?? '---';
    $totalAmount = (float) ($order->total_amount ?? 0);

    $fullAddress = collect([
        $order->address_line ?? null,
        $order->ward ?? null,
        $order->district ?? null,
        $order->province ?? null,
    ])->filter()->implode(', ');
@endphp

<div class="container py-5">
    @if(session('success'))
        <div style="margin-bottom: 16px; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div style="max-width: 720px; margin: 0 auto; border: 1px solid #ddd; border-radius: 14px; padding: 28px;">
        <h1 style="margin-top: 0;">Đặt hàng thành công</h1>

        <p>Cảm ơn bạn đã đặt hàng tại <strong>Người Trái Đất</strong>.</p>

        <div style="margin-top: 20px; line-height: 1.9;">
            <p>Mã đơn hàng: <strong>{{ $orderCode }}</strong></p>
            <p>Khách hàng: {{ $customerName }}</p>
            <p>Số điện thoại: {{ $customerPhone }}</p>

            @if(!empty($fullAddress))
                <p>Địa chỉ giao hàng: {{ $fullAddress }}</p>
            @endif

            <p>Tổng thanh toán: <strong>{{ number_format($totalAmount, 0, ',', '.') }} đ</strong></p>
        </div>

        <div style="display: flex; gap: 12px; margin-top: 24px; flex-wrap: wrap;">
            <a href="{{ route('home') }}" style="display:inline-block; padding:10px 16px; text-decoration:none; border:1px solid #ccc; border-radius:8px;">
                Quay về trang chủ
            </a>

            <a href="{{ route('products.index') }}" style="display:inline-block; padding:10px 16px; text-decoration:none; border:1px solid #ccc; border-radius:8px;">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>
@endsection
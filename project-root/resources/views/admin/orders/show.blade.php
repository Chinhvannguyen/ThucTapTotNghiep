@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="admin-card">
    <h2 class="admin-card-title">Thông tin đơn hàng</h2>

    <div class="admin-detail-list">
        <div><strong>Mã đơn:</strong> {{ $order->order_code ?? ('#'.$order->id) }}</div>
        <div><strong>Khách hàng:</strong> {{ $order->customer_name ?? '—' }}</div>
        <div><strong>SĐT:</strong> {{ $order->customer_phone ?? '—' }}</div>
        <div><strong>Địa chỉ:</strong> {{ $order->address_line ?? '—' }}</div>
        <div><strong>Thanh toán:</strong> {{ $order->payment_status ?? '—' }}</div>
        <div><strong>Trạng thái:</strong> {{ $order->order_status ?? '—' }}</div>
        <div><strong>Tổng tiền:</strong> {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}đ</div>
    </div>
</div>

<div class="admin-card">
    <h2 class="admin-card-title">Sản phẩm trong đơn</h2>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            @forelse($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->subtotal, 0, ',', '.') }}đ</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="admin-empty">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
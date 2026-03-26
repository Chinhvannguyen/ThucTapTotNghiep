@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="admin-card">
    <form method="GET" class="admin-filter-form">
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Mã đơn, tên khách, số điện thoại...">
        <input type="text" name="status" value="{{ $status }}" placeholder="Trạng thái đơn hàng">
        <button type="submit" class="admin-btn admin-btn-primary">Lọc</button>
    </form>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th style="width:180px">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_code ?? ('#'.$order->id) }}</td>
                    <td>{{ $order->customer_name ?? '—' }}</td>
                    <td>{{ $order->customer_phone ?? '—' }}</td>
                    <td>{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}đ</td>
                    <td>{{ $order->payment_status ?? '—' }}</td>
                    <td>{{ $order->order_status ?? '—' }}</td>
                    <td>
                        <div class="admin-actions">
                            <a href="{{ route('admin.orders.show', $order) }}" class="admin-btn admin-btn-light">Xem</a>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="admin-btn admin-btn-primary">Sửa</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="admin-empty">Chưa có đơn hàng nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $orders->links() }}</div>
</div>
@endsection
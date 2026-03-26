@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <h3>{{ $stats['products'] }}</h3>
        <p>Sản phẩm</p>
    </div>
    <div class="admin-stat-card">
        <h3>{{ $stats['categories'] }}</h3>
        <p>Danh mục</p>
    </div>
    <div class="admin-stat-card">
        <h3>{{ $stats['orders'] }}</h3>
        <p>Đơn hàng</p>
    </div>
    <div class="admin-stat-card">
        <h3>{{ $stats['customers'] }}</h3>
        <p>Khách hàng</p>
    </div>
</div>

<div class="admin-grid-2">
    <div class="admin-card">
        <h2 class="admin-card-title">Đơn hàng mới</h2>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @forelse($latestOrders as $order)
                    <tr>
                        <td>{{ $order->order_code ?? ('#'.$order->id) }}</td>
                        <td>{{ $order->customer_name ?? '—' }}</td>
                        <td>{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}đ</td>
                        <td>{{ $order->order_status ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="admin-empty">Chưa có đơn hàng nào.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="admin-card">
        <h2 class="admin-card-title">Sản phẩm sắp hết hàng</h2>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>Tên</th>
                    <th>Tồn kho</th>
                </tr>
                </thead>
                <tbody>
                @forelse($lowStockProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="admin-empty">Không có sản phẩm sắp hết hàng.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
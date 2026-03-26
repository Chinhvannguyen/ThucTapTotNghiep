@extends('admin.layouts.app')

@section('title', 'Chi tiết khách hàng')

@section('content')
<div class="admin-card">
    <h2 class="admin-card-title">{{ $customer->name }}</h2>
    <div class="admin-detail-list">
        <div><strong>ID:</strong> {{ $customer->id }}</div>
        <div><strong>Email:</strong> {{ $customer->email }}</div>
        <div><strong>Vai trò:</strong> {{ $customer->role ?? 'user' }}</div>
        <div><strong>Ngày tạo:</strong> {{ optional($customer->created_at)->format('d/m/Y H:i') }}</div>
    </div>
</div>

@if($orders->count())
<div class="admin-card">
    <h2 class="admin-card-title">Đơn hàng gần đây</h2>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_code ?? ('#'.$order->id) }}</td>
                    <td>{{ number_format($order->total_amount ?? 0, 0, ',', '.') }}đ</td>
                    <td>{{ $order->order_status ?? '—' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
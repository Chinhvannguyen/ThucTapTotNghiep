@extends('admin.layouts.app')

@section('title', 'Cập nhật đơn hàng')

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @csrf
        @method('PUT')

        <div class="admin-form-grid">
            <div class="admin-form-group">
                <label>Trạng thái đơn hàng</label>
                <input type="text" name="order_status" value="{{ old('order_status', $order->order_status) }}" required>
            </div>

            <div class="admin-form-group">
                <label>Trạng thái thanh toán</label>
                <input type="text" name="payment_status" value="{{ old('payment_status', $order->payment_status) }}" required>
            </div>
        </div>

        <div class="admin-form-actions">
            <a href="{{ route('admin.orders.index') }}" class="admin-btn admin-btn-light">Quay lại</a>
            <button type="submit" class="admin-btn admin-btn-primary">Cập nhật đơn hàng</button>
        </div>
    </form>
</div>
@endsection
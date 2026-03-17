@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Thanh toán</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:12px;">
            <label>Họ tên</label><br>
            <input type="text" name="customer_name" value="{{ old('customer_name') }}" style="width:100%; padding:10px;">
            @error('customer_name') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label>Số điện thoại</label><br>
            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" style="width:100%; padding:10px;">
            @error('customer_phone') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label>Tỉnh / Thành</label><br>
            <input type="text" name="province" value="{{ old('province') }}" style="width:100%; padding:10px;">
            @error('province') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label>Quận / Huyện</label><br>
            <input type="text" name="district" value="{{ old('district') }}" style="width:100%; padding:10px;">
            @error('district') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label>Phường / Xã</label><br>
            <input type="text" name="ward" value="{{ old('ward') }}" style="width:100%; padding:10px;">
            @error('ward') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label>Địa chỉ cụ thể</label><br>
            <input type="text" name="address_line" value="{{ old('address_line') }}" style="width:100%; padding:10px;">
            @error('address_line') <small style="color:red;">{{ $message }}</small> @enderror
        </div>

        <hr>

        <p>Tạm tính: <strong>{{ number_format($subtotal) }} đ</strong></p>
        <p>Phí ship: <strong>{{ number_format($shippingFee) }} đ</strong></p>
        <p>Tổng tiền: <strong>{{ number_format($total) }} đ</strong></p>

        <button type="submit" class="btn-primary">Đặt hàng</button>
    </form>
</div>
@endsection
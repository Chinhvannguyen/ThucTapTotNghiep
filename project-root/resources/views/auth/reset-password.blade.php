@extends('layouts.app')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Đặt lại mật khẩu</h2>

        <form method="POST" action="{{ route('password.update') }}" class="auth-form">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Nhập email">
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu mới">
                @error('password')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu mới</label>
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
            </div>

            <button type="submit" class="auth-btn">Cập nhật mật khẩu</button>
        </form>
    </div>
</div>
@endsection
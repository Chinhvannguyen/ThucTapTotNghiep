@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Đổi mật khẩu</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.change.update') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label>Mật khẩu hiện tại</label>
                <input type="password" name="current_password" placeholder="Nhập mật khẩu hiện tại">
                @error('current_password')
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

            <button type="submit" class="auth-btn">Đổi mật khẩu</button>
        </form>
    </div>
</div>
@endsection
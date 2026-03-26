@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Đăng ký tài khoản</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ tên">
                @error('name')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập email">
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
                @error('password')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            </div>

            <button type="submit" class="auth-btn">Đăng ký</button>
        </form>

        <p class="auth-switch">
            Đã có tài khoản?
            <a href="{{ route('login') }}">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
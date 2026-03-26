@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Đăng nhập</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        @if(session('warning'))
            <div class="auth-alert warning">{{ session('warning') }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="auth-form">
            @csrf

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

            <div class="form-row-inline">
                <label class="remember-box">
                    <input type="checkbox" name="remember" value="1">
                    Ghi nhớ đăng nhập
                </label>

                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="auth-btn">Đăng nhập</button>
        </form>

        <p class="auth-switch">
            Chưa có tài khoản?
            <a href="{{ route('register') }}">Đăng ký ngay</a>
        </p>
    </div>
</div>
@endsection
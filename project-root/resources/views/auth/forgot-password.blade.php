@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Quên mật khẩu</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn">
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="auth-btn">Gửi link đặt lại mật khẩu</button>
        </form>
    </div>
</div>
@endsection
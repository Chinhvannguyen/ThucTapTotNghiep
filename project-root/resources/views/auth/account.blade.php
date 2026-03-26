@extends('layouts.app')

@section('title', 'Tài khoản')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Tài khoản của bạn</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        <div class="account-info">
            <p><strong>Họ tên:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p>
                <strong>Trạng thái email:</strong>
                @if(auth()->user()->hasVerifiedEmail())
                    <span class="badge success">Đã xác thực</span>
                @else
                    <span class="badge warning">Chưa xác thực</span>
                @endif
            </p>
            <p><strong>Vai trò:</strong> {{ auth()->user()->role }}</p>
        </div>

        <div class="account-actions">
            @if(!auth()->user()->hasVerifiedEmail())
                <a class="auth-link-btn" href="{{ route('verification.notice') }}">Xác thực email</a>
            @endif

            <a class="auth-link-btn" href="{{ route('password.change') }}">Đổi mật khẩu</a>

            @if(auth()->user()->isAdmin())
                <a class="auth-link-btn" href="{{ route('admin.dashboard') }}">Vào trang Admin</a>
            @endif
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="auth-btn danger">Đăng xuất</button>
        </form>
    </div>
</div>
@endsection
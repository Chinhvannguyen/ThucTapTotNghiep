@extends('layouts.app')

@section('title', 'Xác thực email')

@section('content')
<div class="auth-page">
    <div class="auth-box">
        <h2>Xác thực email</h2>

        @if(session('success'))
            <div class="auth-alert success">{{ session('success') }}</div>
        @endif

        <p class="auth-desc">
            Chúng tôi đã gửi email xác thực cho bạn.
            Hãy kiểm tra hộp thư đến hoặc spam.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="auth-btn">Gửi lại email xác thực</button>
        </form>
    </div>
</div>
@endsection
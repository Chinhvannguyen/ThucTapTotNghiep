@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<section class="section-padded auth-wrap">
    <div class="container auth-card card-soft">
        <h1>TẠO TÀI KHOẢN</h1>

        <form class="auth-form">
            <input type="text" placeholder="Họ và tên">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Mật khẩu">
            <input type="password" placeholder="Xác nhận mật khẩu">
            <button class="btn btn-primary btn-lg full" type="button">ĐĂNG KÝ</button>
        </form>
    </div>
</section>
@endsection
@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<section class="section-padded auth-wrap">
    <div class="container auth-card card-soft">
        <h1>ĐĂNG NHẬP</h1>

        <form class="auth-form">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Mật khẩu">
            <button class="btn btn-primary btn-lg full" type="button">ĐĂNG NHẬP</button>
        </form>
    </div>
</section>
@endsection
@extends('admin.layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="admin-page-head">
    <div>
        <h1 class="admin-page-title">Thêm sản phẩm</h1>
        <p class="admin-page-subtitle">Tạo sản phẩm mới cho cửa hàng.</p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.products.store') }}" method="POST">
        @include('admin.products._form')
    </form>
</div>
@endsection
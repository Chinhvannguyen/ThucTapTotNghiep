@extends('admin.layouts.app')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="admin-page-head">
    <div>
        <h1 class="admin-page-title">Sửa sản phẩm</h1>
        <p class="admin-page-subtitle">Cập nhật thông tin sản phẩm.</p>
    </div>
</div>

<div class="admin-card">
    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @method('PUT')
        @include('admin.products._form')
    </form>
</div>
@endsection
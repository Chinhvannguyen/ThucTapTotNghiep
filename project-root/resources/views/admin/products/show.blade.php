@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="admin-page-head">
    <div>
        <h1 class="admin-page-title">Chi tiết sản phẩm</h1>
        <p class="admin-page-subtitle">Xem nhanh thông tin sản phẩm trong hệ thống.</p>
    </div>

    <div class="admin-actions">
        <a href="{{ route('admin.products.edit', $product) }}" class="admin-btn admin-btn-primary">Sửa</a>
        <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn-light">Quay lại</a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-product-detail">
        <div class="admin-product-detail-image">
            <img
                src="{{ $product->thumbnail ?: asset('assets/images/no-image.jpg') }}"
                alt="{{ $product->name }}"
            >
        </div>

        <div class="admin-product-detail-info">
            <h2>{{ $product->name }}</h2>

            <div class="admin-detail-list">
                <div><strong>Slug:</strong> {{ $product->slug }}</div>
                <div><strong>SKU:</strong> {{ $product->sku ?: '—' }}</div>
                <div><strong>Danh mục:</strong> {{ $product->category->name ?? '—' }}</div>
                <div><strong>Giá gốc:</strong> {{ number_format($product->price, 0, ',', '.') }}đ</div>
                <div><strong>Giá sale:</strong> {{ $product->sale_price ? number_format($product->sale_price, 0, ',', '.') . 'đ' : '—' }}</div>
                <div><strong>Tồn kho:</strong> {{ $product->stock }}</div>
                <div>
                    <strong>Trạng thái:</strong>
                    @if($product->is_active)
                        <span class="admin-badge admin-badge-success">Đang bán</span>
                    @else
                        <span class="admin-badge admin-badge-danger">Ẩn</span>
                    @endif
                </div>
                <div>
                    <strong>Nổi bật:</strong>
                    @if($product->is_featured)
                        <span class="admin-badge admin-badge-warning">Có</span>
                    @else
                        <span class="admin-badge admin-badge-muted">Không</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($product->short_description)
<div class="admin-card">
    <h3>Mô tả ngắn</h3>
    <p>{{ $product->short_description }}</p>
</div>
@endif

@if($product->description)
<div class="admin-card">
    <h3>Mô tả chi tiết</h3>
    <div class="admin-rich-text">{!! nl2br(e($product->description)) !!}</div>
</div>
@endif

@if($product->care_instructions)
<div class="admin-card">
    <h3>Hướng dẫn chăm sóc</h3>
    <div class="admin-rich-text">{!! nl2br(e($product->care_instructions)) !!}</div>
</div>
@endif
@endsection
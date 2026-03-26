@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="admin-page-head">
    <div>
        <h1 class="admin-page-title">Quản lý sản phẩm</h1>
        <p class="admin-page-subtitle">Danh sách sản phẩm của cửa hàng Người Trái Đất.</p>
    </div>

    <a href="{{ route('admin.products.create') }}" class="admin-btn admin-btn-primary">
        + Thêm sản phẩm
    </a>
</div>

@if(session('success'))
    <div class="admin-alert admin-alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <form method="GET" action="{{ route('admin.products.index') }}" class="admin-filter-form">
        <div class="admin-form-group">
            <label for="keyword">Từ khóa</label>
            <input
                type="text"
                id="keyword"
                name="keyword"
                value="{{ $keyword }}"
                placeholder="Tên sản phẩm, slug, SKU..."
            >
        </div>

        <div class="admin-form-group">
            <label for="status">Trạng thái</label>
            <select id="status" name="status">
                <option value="">Tất cả</option>
                <option value="1" {{ (string) $status === '1' ? 'selected' : '' }}>Đang bán</option>
                <option value="0" {{ (string) $status === '0' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <div class="admin-filter-actions">
            <button type="submit" class="admin-btn admin-btn-primary">Lọc</button>
            <a href="{{ route('admin.products.index') }}" class="admin-btn admin-btn-light">Đặt lại</a>
        </div>
    </form>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Nổi bật</th>
                    <th>Trạng thái</th>
                    <th style="width: 180px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <img
                                src="{{ $product->thumbnail ?: asset('assets/images/no-image.jpg') }}"
                                alt="{{ $product->name }}"
                                class="admin-thumb"
                            >
                        </td>
                        <td>
                            <div class="admin-cell-title">{{ $product->name }}</div>
                            <div class="admin-cell-sub">{{ $product->slug }}</div>
                        </td>
                        <td>{{ $product->category->name ?? '—' }}</td>
                        <td>
                            <div>{{ number_format($product->price, 0, ',', '.') }}đ</div>
                            @if($product->sale_price)
                                <div class="admin-cell-sub">
                                    Sale: {{ number_format($product->sale_price, 0, ',', '.') }}đ
                                </div>
                            @endif
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->is_featured)
                                <span class="admin-badge admin-badge-warning">Nổi bật</span>
                            @else
                                <span class="admin-badge admin-badge-muted">Thường</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_active)
                                <span class="admin-badge admin-badge-success">Đang bán</span>
                            @else
                                <span class="admin-badge admin-badge-danger">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <div class="admin-actions">
                                <a href="{{ route('admin.products.show', $product) }}" class="admin-btn admin-btn-light">
                                    Xem
                                </a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="admin-btn admin-btn-primary">
                                    Sửa
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn-danger">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="admin-empty">
                            Chưa có sản phẩm nào.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
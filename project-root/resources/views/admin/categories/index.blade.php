@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="admin-page-head">
    <form method="GET" class="admin-filter-form single">
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Tìm tên danh mục, slug...">
        <button type="submit" class="admin-btn admin-btn-primary">Lọc</button>
    </form>

    <a href="{{ route('admin.categories.create') }}" class="admin-btn admin-btn-primary">+ Thêm danh mục</a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Trạng thái</th>
                <th style="width:220px">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->status }}</td>
                    <td>
                        <div class="admin-actions">
                            <a href="{{ route('admin.categories.show', $category) }}" class="admin-btn admin-btn-light">Xem</a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="admin-btn admin-btn-primary">Sửa</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Xóa danh mục này?')">
                                @csrf
                                @method('DELETE')
                                <button class="admin-btn admin-btn-danger" type="submit">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="admin-empty">Chưa có danh mục nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $categories->links() }}</div>
</div>
@endsection
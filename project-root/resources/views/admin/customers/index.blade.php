@extends('admin.layouts.app')

@section('title', 'Quản lý khách hàng')

@section('content')
<div class="admin-card">
    <form method="GET" class="admin-filter-form single">
        <input type="text" name="keyword" value="{{ $keyword }}" placeholder="Tìm tên hoặc email...">
        <button type="submit" class="admin-btn admin-btn-primary">Lọc</button>
    </form>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th style="width:180px">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->role ?? 'user' }}</td>
                    <td>{{ optional($customer->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="admin-actions">
                            <a href="{{ route('admin.customers.show', $customer) }}" class="admin-btn admin-btn-light">Xem</a>
                            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Xóa khách hàng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-danger">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="admin-empty">Chưa có khách hàng nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">{{ $customers->links() }}</div>
</div>
@endsection
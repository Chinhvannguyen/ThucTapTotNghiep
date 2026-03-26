<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | Người Trái Đất')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <a href="{{ route('admin.dashboard') }}">Người Trái Đất Admin</a>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.products.index') }}">Sản phẩm</a>
                <a href="{{ route('admin.categories.index') }}">Danh mục</a>
                <a href="{{ route('admin.orders.index') }}">Đơn hàng</a>
                <a href="{{ route('admin.customers.index') }}">Khách hàng</a>
                <a href="{{ route('home') }}">Về website</a>
            </nav>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <div class="admin-header-left">
                    <h1>@yield('title', 'Admin')</h1>
                </div>

                <div class="admin-header-right">
                    @auth
                        <span class="admin-user">
                            {{ auth()->user()->name }}
                        </span>
                    @endauth

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="admin-btn admin-btn-danger">Đăng xuất</button>
                    </form>
                </div>
            </header>

            <section class="admin-content">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>
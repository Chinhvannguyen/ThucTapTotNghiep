<header class="site-header">
    <div class="topbar">
        MIỄN PHÍ GIAO HÀNG CHO THÀNH VIÊN VIP
    </div>

    <div class="navbar">
        <button class="menu-btn" id="menuToggle" type="button" aria-label="Mở menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <a href="{{ route('home') }}" class="brand-logo" aria-label="Người Trái Đất">
            <span>người</span>
            <span>trái đất</span>
        </a>

        <div class="nav-actions">
            <button class="icon-btn search-toggle" id="searchToggle" type="button" aria-label="Tìm kiếm">⌕</button>

            <a href="{{ route('cart.index') }}" class="icon-btn cart-link" aria-label="Giỏ hàng">🧺</a>

            @auth
                <div class="header-user">
                    <a href="{{ route('account') }}" class="header-user__name">
                        {{ auth()->user()->name }}
                    </a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="header-user__admin">
                            Quản trị
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="header-user__logout-form">
                        @csrf
                        <button type="submit" class="header-user__logout-btn">Đăng xuất</button>
                    </form>
                </div>
            @else
                <div class="header-guest">
                    <a href="{{ route('login') }}" class="header-link">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="header-link header-link--primary">Đăng ký</a>
                </div>
            @endauth
        </div>
    </div>

    <div class="search-bar" id="searchBar">
        <form action="{{ route('products.search') }}" method="GET" class="search-form">
            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Tìm người bạn xanh lá..."
            >
            <button type="submit">Tìm</button>
        </form>
    </div>

    <aside class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-head">
            <span>Danh mục</span>
            <button class="drawer-close" id="drawerClose" type="button" aria-label="Đóng menu">✕</button>
        </div>

        <nav class="drawer-nav">
            <a href="{{ route('home') }}">Trang chủ</a>
            <a href="{{ route('products.index') }}">Sản phẩm</a>
            <a href="#about">Về chúng mình</a>
            <a href="#featured">Hội bạn thân xanh lá</a>
            <a href="#gifts">Phủ xanh trái tim</a>
            <a href="#friends">Gặp gỡ người bạn mới</a>
            <a href="#cinema">Rạp chiếu bóng xanh lá</a>
            <a href="#newspaper">Sạp báo của người yêu cây</a>

            @auth
                <div class="drawer-user-box">
                    <div class="drawer-user-box__label">Tài khoản</div>
                    <a href="{{ route('account') }}">Xin chào, {{ auth()->user()->name }}</a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="drawer-logout-form">
                        @csrf
                        <button type="submit" class="drawer-logout-btn">Đăng xuất</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a href="{{ route('register') }}">Đăng ký</a>
            @endauth
        </nav>
    </aside>

    <div class="drawer-overlay" id="drawerOverlay"></div>
</header>
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush

@section('title', 'Trang chủ | Người Trái Đất')

@section('content')
@php
    $featuredProducts = $featuredProducts ?? collect();
    $newProducts = $newProducts ?? collect();
    $heroProducts = $featuredProducts->take(3)->values();
    $friendProducts = $newProducts->count() ? $newProducts->take(4) : $featuredProducts->take(4);
@endphp

<section class="hero-home">
    <div class="container hero-grid-home">
        <div class="hero-copy-home">
            <div class="hero-stars">★ ★ ★ ★ ★</div>

            <h1>một mầm xanh<br>một người bạn</h1>

            <p>
                Xin chào,<br>
                Chúng mình là <strong>Người Trái Đất</strong> - tụi mình có một sứ mệnh giản dị:
                <strong>Kết nối bạn với tâm hồn, con người và thiên nhiên</strong>
                theo cách dễ thương, gần gũi và bớt “nghiêm túc hóa cuộc đời”.
            </p>

            <a href="#featured" class="hero-cta">NHẬN NUÔI NGAY</a>
        </div>

        <div class="hero-visual-home">
            @forelse($heroProducts as $index => $product)
                <div class="hero-box hero-box-{{ $index + 1 }}">
                    <img src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}" alt="{{ $product->name }}">
                </div>
            @empty
                <div class="hero-box hero-box-1"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
                <div class="hero-box hero-box-2"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
                <div class="hero-box hero-box-3"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
            @endforelse
        </div>
    </div>

    <div class="section-wave-bottom"></div>
</section>

<section class="personality-home">
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
    <div class="glow glow-3"></div>
    <div class="container personality-inner">
        <h2>Bạn là người:</h2>

        <div class="personality-row">
            <span>ẤM ÁP</span>
            <span>MƠ MỘNG</span>
            <span>THỰC TẾ</span>
        </div>
    </div>
</section>

<section class="about-strip-home" id="about">
    <div class="leaf-decor">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="container about-strip-grid-home">
        <div class="about-strip-title">
            <h3>VỀ CHÚNG MÌNH</h3>
        </div>

        <div class="about-strip-text">
            <p class="about-strip-lead">
                Lan tỏa niềm vui – kết nối cảm xúc – biến từng góc nhỏ thành một thế giới đầy sức sống.
            </p>
            <p>
                Có bao giờ bạn đang mệt mà chỉ cần nhìn thấy một điều dễ thương là tự nhiên cảm thấy vui lên?
            </p>
        </div>
    </div>
</section>

<section class="winter-showcase">
    <div class="container winter-showcase-grid">
        @forelse($heroProducts as $product)
            <div class="winter-card">
                <img src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}" alt="{{ $product->name }}">
            </div>
        @empty
            <div class="winter-card"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
            <div class="winter-card"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
            <div class="winter-card"><img src="{{ asset('assets/images/no-image.jpg') }}" alt=""></div>
        @endforelse
    </div>
</section>

<section class="featured-home" id="featured">
    <div class="top-waves"></div>

    <div class="container">
        <div class="home-section-heading light">
            <h2>HỘI BẠN THÂN XANH LÁ</h2>
            <p>Bạn sẽ muốn kết nối và nhận nuôi người bạn nào đầu tiên?</p>
        </div>

        <div class="featured-grid-home">
            @forelse($featuredProducts->take(4) as $product)
                <article class="featured-card-home">
                    <a href="{{ route('products.show', $product->slug) }}" class="featured-thumb-home">
                        <img src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}" alt="{{ $product->name }}">
                    </a>

                    <div class="featured-body-home">
                        <h3>{{ $product->name }}</h3>
                        <div class="featured-price-home">{{ number_format($product->final_price, 0, ',', '.') }} đ</div>
                        <a href="{{ route('products.show', $product->slug) }}" class="featured-btn-home">NHẬN NUÔI</a>
                    </div>
                </article>
            @empty
                <p class="empty-light">Chưa có sản phẩm nổi bật.</p>
            @endforelse
        </div>
    </div>

    <div class="bottom-waves"></div>
</section>

<section class="cinema-home" id="cinema">
    <div class="container">
        <div class="home-section-heading light">
            <h2>RẠP CHIẾU BÓNG XANH LÁ</h2>
            <p>Mời bạn bước vào “rạp” và chiêm ngưỡng những thước phim ngắn dễ thương của Hội Bạn Xanh Lá.</p>
        </div>

        <div class="video-frame-home">
            <div class="video-placeholder-home">
                <span>VIDEO CỦA BẠN</span>
            </div>
        </div>
    </div>
</section>

<section class="gift-home" id="gifts">
    <div class="container">
        <div class="home-section-heading dark">
            <h2>HÀNH TRÌNH PHỦ XANH TRÁI TIM</h2>
            <p>Đây là lúc bạn “phủ xanh” trái tim người bạn thương, thông qua việc trao tặng người bạn nhỏ.</p>
        </div>

        <div class="gift-grid-home">
            <div class="gift-box-home">
                <div class="gift-icon-home">👨‍👩‍👧</div>
                <div>
                    <h3>Tặng Người “Thương”</h3>
                    <p>Ai là người “thương” mà bạn muốn dành tặng món quà ý nghĩa này?</p>
                </div>
            </div>

            <div class="gift-box-home">
                <div class="gift-icon-home">🎁</div>
                <div>
                    <h3>Tặng Bản Thân</h3>
                    <p>Đã bao lâu kể từ khi bạn tặng cho bản thân một món quà?</p>
                </div>
            </div>

            <div class="gift-box-home">
                <div class="gift-icon-home">💞</div>
                <div>
                    <h3>Dành cho mọi tâm hồn</h3>
                    <p>Những tâm hồn cần chữa lành xứng đáng được nhận món quà nhỏ xinh.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="friends-home" id="friends">
    <div class="container">
        <div class="home-section-heading light">
            <h2>GẶP GỠ NGƯỜI BẠN MỚI</h2>
            <p>Người Trái Đất hân hạnh giới thiệu đến bạn những người cá tính và đầy màu sắc.</p>
            <strong>Nhấn vào để nhận nuôi bạn ấy nhé!</strong>
        </div>

        <div class="friends-grid-home">
            @forelse($friendProducts as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="friend-postcard-home">
                    <h3>{{ $product->name }}</h3>
                    <img src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}" alt="{{ $product->name }}">
                    <span>Nhận nuôi mình ngay nha! 👋</span>
                </a>
            @empty
                <p class="empty-light">Chưa có sản phẩm mới.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="newspaper-home" id="newspaper">
    <div class="top-waves"></div>

    <div class="container">
        <div class="home-section-heading light">
            <h2>SẠP BÁO CỦA NGƯỜI YÊU CÂY</h2>
        </div>

        <div class="newspaper-slider-home">
            <button class="arrow-btn">‹</button>

            <div class="newspaper-cards-home">
                @forelse($featuredProducts->take(3) as $product)
                    <article class="news-card-home">
                        <img src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}" alt="{{ $product->name }}">
                        <div class="news-content-home">
                            <h3>{{ $product->name }} — Bài viết nổi bật</h3>
                            <p>
                                Đây là phần mô tả ngắn cho bài viết/blog. Bạn có thể thay bằng nội dung thật từ database sau.
                            </p>
                        </div>
                    </article>
                @empty
                    <article class="news-card-home">
                        <img src="{{ asset('assets/images/no-image.jpg') }}" alt="">
                        <div class="news-content-home">
                            <h3>Bài viết nổi bật</h3>
                            <p>Nội dung mô tả bài viết sẽ hiển thị tại đây.</p>
                        </div>
                    </article>
                @endforelse
            </div>

            <button class="arrow-btn">›</button>
        </div>

        <div class="read-more-wrap">
            <a href="#" class="read-more-btn">ĐỌC THÊM</a>
        </div>
    </div>
</section>

<section class="about-detail-home">
    <div class="top-waves light-waves"></div>

    <div class="container about-detail-grid-home">
        <div class="about-image-home">
            <img src="{{ ($featuredProducts->first()?->thumbnail_url) ?: asset('assets/images/no-image.jpg') }}" alt="Về chúng mình">
        </div>

        <div class="about-copy-home">
            <h2>♥ VỀ CHÚNG MÌNH</h2>
            <h3>VÌ SAO TỤI MÌNH CHỌN CÁI TÊN “NGƯỜI TRÁI ĐẤT”?</h3>

            <p>
                Chúng mình chọn cái tên <strong>“Người Trái Đất”</strong> vì đó là điểm xuất phát chung của mọi <strong>kết nối</strong>.
            </p>

            <p>
                Trước khi chúng ta <strong>kết nối</strong> với ai, với điều gì, hay với bất cứ nơi nào ... chúng ta đều được <strong>kết nối với Trái Đất</strong> đầu tiên.
            </p>
        </div>
    </div>
</section>
@endsection
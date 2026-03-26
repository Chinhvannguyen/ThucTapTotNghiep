@extends('layouts.app')

@section('title', $product->name . ' | Chi tiết sản phẩm')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
<style>
    .emotion-options{
        display:flex;
        flex-wrap:wrap;
        gap:10px;
    }

    .emotion-tag{
        display:inline-flex;
        align-items:center;
        min-height:36px;
        padding:0 16px;
        border:1px solid #d5c7dc;
        background:#f8f4fb;
        color:#6f6873;
        border-radius:4px;
        font-size:15px;
        cursor:pointer;
        transition:.2s ease;
    }

    .emotion-tag.active{
        background:#dca18f;
        border-color:#dca18f;
        color:#fff;
    }
</style>
@endpush

@section('content')
<section class="product-detail-page">
    <div class="container product-detail-wrap">
        <div class="product-detail-left">
            <div class="product-main-image">
                <img
                    id="mainProductImage"
                    src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}"
                    alt="{{ $product->name }}"
                >
            </div>

            <div class="product-thumb-list">
                <button
                    class="thumb-item active"
                    type="button"
                    onclick="changeMainImage(this, '{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}')"
                >
                    <img
                        src="{{ $product->thumbnail_url ?: asset('assets/images/no-image.jpg') }}"
                        alt="{{ $product->name }}"
                    >
                </button>

                @foreach($product->images as $image)
                    @php
                        $imageUrl = filter_var($image->image_path, FILTER_VALIDATE_URL)
                            ? $image->image_path
                            : asset($image->image_path);
                    @endphp

                    <button
                        class="thumb-item"
                        type="button"
                        onclick="changeMainImage(this, '{{ $imageUrl }}')"
                    >
                        <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                    </button>
                @endforeach
            </div>
        </div>

        <div class="product-detail-right">
            <div class="detail-card-blob">
                <div class="product-head-row">
                    <h1>{{ mb_strtoupper($product->name, 'UTF-8') }}</h1>

                    @if($product->is_featured)
                        <span class="product-badge">KÈM THEO CÂY</span>
                    @endif
                </div>

                <div class="product-price-big">
                    {{ number_format($product->final_price, 0, ',', '.') }} đ
                </div>

                <div class="product-desc-long">
                    {!! nl2br(e($product->description ?: $product->short_description ?: 'Một người bạn nhỏ mang màu sắc riêng, dễ thương và phù hợp để tô xanh góc sống của bạn mỗi ngày.')) !!}
                </div>

                <ul class="product-feature-list">
                    <li>Mang màu sắc riêng</li>
                    <li>Đầy cá tính</li>
                    <li>Tô xanh không gian sống</li>
                    <li>Phù hợp làm quà tặng</li>
                </ul>

                <div class="product-meta-tags">
                    <span class="meta-label">Cảm xúc</span>

                    <div class="emotion-options">
                        <button type="button" class="emotion-tag active" data-value="Buồn" onclick="selectEmotion(this)">
                            Buồn
                        </button>

                        <button type="button" class="emotion-tag" data-value="Ngẫu nhiên" onclick="selectEmotion(this)">
                            Ngẫu nhiên
                        </button>

                        <button type="button" class="emotion-tag" data-value="Tức giận" onclick="selectEmotion(this)">
                            Tức giận
                        </button>

                        <button type="button" class="emotion-tag" data-value="Vui" onclick="selectEmotion(this)">
                            Vui
                        </button>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="detail-buy-row">
                    @csrf

                    <input type="hidden" name="emotion" id="selectedEmotion" value="Buồn">

                    <div class="detail-qty-box">
                        <button type="button" class="detail-qty-btn" onclick="changeQty(-1)">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <button type="button" class="detail-qty-btn" onclick="changeQty(1)">+</button>
                    </div>

                    <button type="submit" class="detail-buy-btn">
                        NHẬN NUÔI
                    </button>
                </form>

                <ul class="detail-list" style="margin-top:24px;">
                    @if(!empty($product->category?->name))
                        <li>Thuộc danh mục {{ $product->category->name }}</li>
                    @endif

                    @if(!empty($product->sku))
                        <li>Mã sản phẩm: {{ $product->sku }}</li>
                    @endif

                    @if(!is_null($product->stock))
                        <li>Còn lại {{ $product->stock }} sản phẩm</li>
                    @endif

                    @if($product->sale_price && $product->sale_price < $product->price)
                        <li>Đang có giá ưu đãi hấp dẫn</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="detail-bottom-wave"></div>
</section>

@if(!empty($product->care_instructions))
<section class="section-padded related-section" style="padding-top:20px;">
    <div class="container">
        <div class="home-section-heading dark" style="margin-bottom:24px;">
            <h2>Hướng dẫn chăm sóc</h2>
            <p>Để người bạn xanh luôn vui vẻ và khỏe mạnh.</p>
        </div>

        <div class="detail-card-blob" style="background:#f3eadf; border-radius:30px;">
            <div class="product-desc-long" style="margin-bottom:0;">
                {!! nl2br(e($product->care_instructions)) !!}
            </div>
        </div>
    </div>
</section>
@endif

@if(isset($relatedProducts) && $relatedProducts->count())
<section class="section-padded related-section">
    <div class="container">
        <div class="home-section-heading dark" style="margin-bottom:28px;">
            <h2>Sản phẩm liên quan</h2>
            <p>Những người bạn xanh khác mà bạn có thể sẽ thích.</p>
        </div>

        <div class="custom-product-grid">
            @foreach($relatedProducts as $relatedProduct)
                <x-product-card
                    :name="$relatedProduct->name"
                    :price="number_format($relatedProduct->final_price, 0, ',', '.') . ' đ'"
                    :image="$relatedProduct->thumbnail_url ?: asset('assets/images/no-image.jpg')"
                    :url="route('products.show', $relatedProduct->slug)"
                />
            @endforeach
        </div>
    </div>
</section>
@endif

@if($product->reviews->count())
<section class="section-padded related-section" style="padding-top:0;">
    <div class="container">
        <div class="home-section-heading dark" style="margin-bottom:28px;">
            <h2>Đánh giá sản phẩm</h2>
            <p>Những chia sẻ từ các bạn đã nhận nuôi người bạn xanh này.</p>
        </div>

        <div style="display:grid; gap:18px;">
            @foreach($product->reviews as $review)
                <div style="background:#fff; border-radius:18px; padding:20px; box-shadow:var(--shadow);">
                    <div style="display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:8px;">
                        <strong>{{ $review->user->name ?? 'Khách hàng' }}</strong>
                        <span>
                            @for($i = 1; $i <= 5; $i++)
                                {{ $i <= $review->rating ? '⭐' : '☆' }}
                            @endfor
                        </span>
                    </div>

                    <p style="margin:0; color:var(--muted); line-height:1.7;">
                        {{ $review->content }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    function changeQty(amount) {
        const qtyInput = document.getElementById('quantity');
        let currentValue = parseInt(qtyInput.value) || 1;
        currentValue += amount;

        if (currentValue < 1) {
            currentValue = 1;
        }

        qtyInput.value = currentValue;
    }

    function changeMainImage(el, src) {
        document.getElementById('mainProductImage').src = src;

        document.querySelectorAll('.thumb-item').forEach(item => {
            item.classList.remove('active');
        });

        el.classList.add('active');
    }

    function selectEmotion(el) {
        document.querySelectorAll('.emotion-tag').forEach(item => {
            item.classList.remove('active');
        });

        el.classList.add('active');
        document.getElementById('selectedEmotion').value = el.dataset.value;
    }
</script>
@endsection
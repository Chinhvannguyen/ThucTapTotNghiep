@extends('layouts.app')

@section('title', 'Sản phẩm | Người Trái Đất')

@section('content')
<section class="products-page">
    <div class="container py-5">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; flex-wrap:wrap; margin-bottom:24px;">
            <div>
                <h1 style="margin:0;">Sản phẩm</h1>
                <p style="margin:8px 0 0; color:#666;">
                    Khám phá những chậu cây xanh phù hợp cho góc nhỏ của bạn.
                </p>
            </div>

            <form action="{{ route('products.index') }}" method="GET" style="display:flex; gap:12px; flex-wrap:wrap;">
                <select name="category" onchange="this.form.submit()" style="padding:10px 12px;">
                    <option value="">Tất cả danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="sort" onchange="this.form.submit()" style="padding:10px 12px;">
                    <option value="">Sắp xếp mặc định</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        @if($products->count())
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:24px;">
                @foreach($products as $product)
                    @php
                        $image = $product->thumbnail ?: 'assets/images/no-image.jpg';
                        $price = $product->sale_price ?: $product->price;
                    @endphp

                    <article style="border:1px solid #e5e5e5; border-radius:16px; overflow:hidden; background:#fff;">
                        <a href="{{ route('products.show', $product->slug) }}" style="display:block; text-decoration:none; color:inherit;">
                            <div style="aspect-ratio:1/1; background:#f7f7f7; display:flex; align-items:center; justify-content:center;">
                                <img
                                    src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : asset($image) }}"
                                    alt="{{ $product->name }}"
                                    style="max-width:100%; max-height:100%; object-fit:cover;"
                                >
                            </div>

                            <div style="padding:16px;">
                                @if($product->category)
                                    <div style="font-size:13px; color:#888; margin-bottom:8px;">
                                        {{ $product->category->name }}
                                    </div>
                                @endif

                                <h3 style="margin:0 0 10px; font-size:18px; line-height:1.4;">
                                    {{ $product->name }}
                                </h3>

                                @if(!empty($product->short_description))
                                    <p style="margin:0 0 12px; color:#666; font-size:14px; line-height:1.6;">
                                        {{ \Illuminate\Support\Str::limit($product->short_description, 80) }}
                                    </p>
                                @endif

                                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                                    <strong style="font-size:18px;">
                                        {{ number_format($price, 0, ',', '.') }} đ
                                    </strong>

                                    @if($product->sale_price && $product->sale_price < $product->price)
                                        <span style="text-decoration:line-through; color:#999;">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <div style="margin-top:30px;">
                {{ $products->links() }}
            </div>
        @else
            <div style="padding:40px 0; text-align:center;">
                <h3>Chưa có sản phẩm phù hợp</h3>
                <p style="color:#666;">Hãy thử đổi bộ lọc danh mục hoặc cách sắp xếp.</p>
            </div>
        @endif
    </div>
</section>
@endsection
@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
@endpush
@section('content')
<section class="page-hero simple-hero">
    <div class="container center">
        <h1>KẾT QUẢ TÌM KIẾM</h1>
        <p>
            Từ khóa:
            <strong>{{ $keyword ?: 'cây mini' }}</strong>
        </p>
    </div>
</section>

<section class="section-padded">
    <div class="container product-grid four-cols">
        @forelse($products as $product)
            <x-product-card
                :name="$product->name"
                :price="number_format($product->final_price, 0, ',', '.') . ' đ'"
                :image="$product->thumbnail_url ?: asset('assets/images/no-image.jpg')"
                :url="route('products.show', $product->slug)"
            />
        @empty
            <p style="grid-column: 1 / -1; text-align: center;">
                Không tìm thấy sản phẩm phù hợp.
            </p>
        @endforelse
    </div>

    @if(method_exists($products, 'links'))
        <div class="container" style="margin-top:32px;">
            {{ $products->links() }}
        </div>
    @endif
</section>
@endsection
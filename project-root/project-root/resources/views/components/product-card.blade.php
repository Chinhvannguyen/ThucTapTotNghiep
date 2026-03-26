@props(['name', 'price', 'image', 'url'])

<div class="plant-card">
    <a href="{{ $url }}" class="plant-card__image-link">
        <img src="{{ $image }}" alt="{{ $name }}" class="plant-card__image">
    </a>

    <div class="plant-card__body">
        <h3 class="plant-card__title">
            <a href="{{ $url }}">{{ $name }}</a>
        </h3>

        <div class="plant-card__price">{{ $price }}</div>

        <a href="{{ $url }}" class="plant-card__btn">
            NHẬN NUÔI
        </a>
    </div>
</div>
<x-cms-layout>
    <div id="primary" class="site-content" style='display:flex;justify-content: space-around'>
        <div>
            <img style='width: 400px' src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->name }}" />
        </div>

        <div class="summary entry-summary">
            <h1 class="product_title entry-title">{{ $product->name }}</h1>

            <p class="price">$ {{ $product->price }}</p>
            <div class="ts-variation-price hidden"></div>
            <div class="woocommerce-product-details__short-description">
                {!! $product->description !!}
            </div>
        </div>
    </div>
</x-cms-layout>
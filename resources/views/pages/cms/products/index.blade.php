<x-cms-layout>
    {{-- <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">

        <x-cms.h1></x-cms.h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
            <x-cms.card :title="$product->name" :url="route('cms.products.show', $product)"
                :imageUrl="$product->getFirstMediaUrl()" imageFit="contain" price="{{ $product->price }}" />
            @endforeach
        </div>

    </div> --}}

    <div id="primary" class="site-content">
        <h1>{{ $navigationLink->label }}</h1>

        <div class="woocommerce main-products columns-4">
            <div class="products">
                @foreach ($products as $product)
                    <section
                        class="product rtwpvg-product type-product post-9730 status-publish first instock product_cat-iphone-ar has-post-thumbnail shipping-taxable product-type-variable"
                        data-product_id="9730">
                        <div class="product-wrapper">

                            <div class="thumbnail-wrapper">
                                <a href="{{route('cms.products.show', $product)}}">

                                    <figure class="no-back-image"><img src="{{$product->getFirstMediaUrl()}}"
                                            data-src="{{$product->getFirstMediaUrl()}}"
                                            class="attachment-shop_catalog wp-post-image ts-lazy-load loaded" alt=""
                                            width="390" height="520"></figure>
                                </a>
                                <div class="product-label">
                                </div>
                                <div class="product-group-button">
                                    <div class="button-in quickshop">
                                        <a class="quickshop" href="#" data-product_id="9730"><span
                                                class="ts-tooltip button-tooltip">Quick
                                                view</span></a>
                                    </div>
                                    <div class="loop-add-to-cart">
                                        <a href="{{route('cms.products.show', $product)}}" class="button alt">
                                            ابحث هنا للشراء
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="meta-wrapper">
                                <h3 class="heading-title product-name"><a href="{{route('cms.products.show', $product)}}">
                                        {{$product->name}}
                                    </a></h3>
                            </div>

                            <div class="meta-wrapper meta-wrapper-2">

                                <div class="product-group-button-meta">
                                    <div class="loop-add-to-cart">
                                        <a href="{{route('cms.products.show', $product)}}" class="button alt">ابحث هنا
                                            للشراء</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach

            </div>
        </div>

        <div class="after-loop-wrapper"></div>


    </div>
</x-cms-layout>
<x-cms-layout>
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full" src="{{ $product->getFirstMediaUrl() }}" alt="{{ $product->name }}" />

                    <div class='flex gap-2'>
                        @foreach ($product->getMedia() as $media)
                            <img class="w-15" src="{{ $media->getUrl() }}" alt="{{ $product->name }}" />
                        @endforeach
                    </div>

                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            ${{ $product->price }}
                        </p>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <x-cms.editor-content>
                        {!! $product->description !!}
                    </x-cms.editor-content>
                </div>
            </div>
        </div>

        @php
            $relatedProducts = $product->related();
        @endphp

        @if ($relatedProducts->count())
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <x-cms.h2>{{__('cms.related_products')}}</x-cms.h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($product->related() as $relatedProduct)
                        <x-cms.card :title="$relatedProduct->name" :url="route('cms.products.show', $relatedProduct)"
                            :imageUrl="asset('storage/' . $relatedProduct->image_path)" imageFit="contain"
                            price="{{ $relatedProduct->price }}" />
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</x-cms-layout>
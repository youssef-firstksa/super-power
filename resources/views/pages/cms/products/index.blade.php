<x-cms-layout>
    <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">

        <x-cms.h1>{{ $navigationLink->label }}</x-cms.h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <x-cms.card :title="$product->name" :url="route('cms.products.show', $product)"
                    :imageUrl="$product->getFirstMediaUrl()" imageFit="contain" price="{{ $product->price }}" />
            @endforeach
        </div>

    </div>
</x-cms-layout>
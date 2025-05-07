<x-cms-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">

            <x-cms.h1>{{ $page_title }}</x-cms.h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($navigationLinks as $navigationLink)
                    <x-cms.card :title="$navigationLink->page->title" :url="route('pages.index', $navigationLink->slug)" :imageUrl="$navigationLink->page->getFirstImageTag()" :content="$navigationLink?->page?->shortContent()" />
                @endforeach
            </div>
        </div>
    </div>
</x-cms-layout>

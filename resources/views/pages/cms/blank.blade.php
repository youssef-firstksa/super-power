<x-cms-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">
            <x-cms.h1>{{ $page->title }}</x-cms.h1>

            <x-cms.editor-content>
                {!! $page->content !!}
            </x-cms.editor-content>

        </div>
    </div>
</x-cms-layout>

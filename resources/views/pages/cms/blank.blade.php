<x-cms-layout>
    <div>
        <h1 class="elementor-heading-title elementor-size-default">{{ $page->title }}</h1>

        <x-cms.editor-content>
            {!! $page->content !!}
        </x-cms.editor-content>
    </div>
</x-cms-layout>
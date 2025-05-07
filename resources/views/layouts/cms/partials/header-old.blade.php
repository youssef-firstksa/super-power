@if (\App\Services\CMS\CMSConfigrationService::showHeader())
    <header class="fixed w-full top-0">
        <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <x-cms.app-logo />

                <div class="flex items-center gap-3 lg:order-2 text-gray-900 dark:text-white">
                    <ul>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="text-sm">
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- <a href="#" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</a> -->
                    <a href="https://themesberg.com/product/tailwind-css/landing-page"
                        class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
                        Download
                    </a>

                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/"
                                class="block py-2 pl-3 pr-4 text-white bg-purple-700 rounded lg:bg-transparent lg:text-purple-700 lg:p-0 dark:text-white"
                                aria-current="page">{{ __('cms.home') }}</a>
                        </li>


                        @foreach (\App\Services\CMS\NavigationService::getParentNavigationLinks() as $navigationLink)
                            <li class="relative group">

                                <a href="{{ route('pages.index', $navigationLink->slug) }}"
                                    class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent">
                                    {{ $navigationLink->label }}
                                </a>

                                @if ($navigationLink->children()->count())
                                    <ul style="width: max-content;"
                                        class="absolute top-4 left-0 hidden mt-2 space-y-2 bg-white border border-gray-200 rounded-lg shadow-lg group-hover:flex flex-col dark:bg-gray-800 dark:border-gray-700">

                                        @foreach ($navigationLink->children as $child)
                                            <li>
                                                <a href="{{ route('pages.index', $child->slug) }}"
                                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                                    {{ $child->label }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($navigationLink->cms_page == 'products')

                                    @php
                                        $categories = \App\Models\Category::select('id', 'image_path')->get();
                                    @endphp

                                    <ul style="width: max-content;"
                                        class="absolute top-4 left-0 hidden mt-2 space-y-2 bg-white border border-gray-200 rounded-lg shadow-lg group-hover:flex flex-col dark:bg-gray-800 dark:border-gray-700">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ route('cms.our-products.index', ['category_id' => $category->id]) }}"
                                                    class="flex flex-col gap-1 items-center px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">

                                                    @if (asset('storage/' . $category->image_path))
                                                        <img class="size-15 object-contain"
                                                            src="{{asset('storage/' . $category->image_path)}}" alt="">
                                                    @endif

                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                        {{-- @foreach (\App\Services\AppService::getNavigationLinks() as $navLink)
                        <li>
                            <a href="{{ $navLink['href'] }}"
                                class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">
                                {{ $navLink['label'] }}
                            </a>
                        </li>
                        @endforeach --}}

                    </ul>
                </div>
            </div>
        </nav>
    </header>
@endif
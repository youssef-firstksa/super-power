@if (\App\Services\CMS\CMSConfigrationService::showHeader())
    <header class="ts-header has-sticky hidden-cart hidden-wishlist hidden-currency hidden-search">
        <div class="header-container">
            <div class="header-template">

                <div class="header-sticky">
                    <div class="header-middle logo-center">
                        <div class="container">

                            <div class="header-left">
                            </div>

                            <div class="logo-wrapper">
                                <div class="logo">
                                    <x-cms.app-logo />
                                </div>
                            </div>

                            <div class="header-right">

                                <div class="language-currency hidden-phone">

                                    <div class="header-language">
                                        <div
                                            class="wpml-ls-statics-shortcode_actions wpml-ls wpml-ls-legacy-list-horizontal">
                                            <ul>
                                                @if (app()->getLocale() === 'en')
                                                    <li
                                                        class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-ar wpml-ls-first-item wpml-ls-last-item wpml-ls-item-legacy-list-horizontal">
                                                        <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                                                            class="wpml-ls-link">
                                                            <span class="wpml-ls-native" lang="ar">العربية</span><span
                                                                class="wpml-ls-display"><span class="wpml-ls-bracket">
                                                                    (</span>Arabic<span
                                                                    class="wpml-ls-bracket">)</span></span></a>
                                                    </li>
                                                @else
                                                    <li
                                                        class="wpml-ls-slot-shortcode_actions wpml-ls-item wpml-ls-item-en wpml-ls-first-item wpml-ls-last-item wpml-ls-item-legacy-list-horizontal">
                                                        <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"
                                                            class="wpml-ls-link">
                                                            <span class="wpml-ls-native" lang="en">الإنجليزية</span><span
                                                                class="wpml-ls-display"><span class="wpml-ls-bracket">
                                                                    (</span>English<span
                                                                    class="wpml-ls-bracket">)</span></span></a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>


                                </div>




                                <!-- Menu Icon -->
                                <div class="icon-menu-sticky-header hidden-phone">
                                    <span class="icon">
                                        <svg width="22" height="18" viewBox="0 0 22 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <line y1="2.39999" x2="22" y2="2.39999" stroke="black" stroke-width="1.5" />
                                            <line y1="9.39999" x2="22" y2="9.39999" stroke="black" stroke-width="1.5" />
                                            <line y1="16.4" x2="22" y2="16.4" stroke="black" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="header-bottom menu-center hidden-phone">
                        <div class="container">
                            <div class="menu-wrapper">
                                <div class="ts-menu">
                                    <nav class="main-menu pc-menu ts-mega-menu-wrapper">
                                        <ul id="menu-main-menu-1" class="menu">
                                            <li
                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-612 current_page_item menu-item-2149 ts-normal-menu">
                                                <a href="index.html">
                                                    <span class="menu-label">{{__('cms.home')}}</span>
                                                </a>
                                            </li>

                                            @foreach (\App\Services\CMS\NavigationService::getParentNavigationLinks() as $navigationLink)

@php
    $hasChildren = $navigationLink->children()->count();
    $hasProducts = $navigationLink->cms_page == 'products';
    $classes = 'menu-item menu-item-type-post_type menu-item-object-page menu-item-1004 ts-normal-menu ';

    if($hasChildren) {
        $classes = 'menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2167 ts-normal-menu parent ';
    }

    if($hasProducts) {
         $classes = 'menu-item menu-item-type-custom menu-item-object-custom menu-item-25 hide ts-megamenu ts-megamenu-columns--1 ts-megamenu-fullwidth ts-megamenu-fullwidth-stretch no-stretch-content parent ';
    }
@endphp

                                                <li
                                                    class="{{$classes}}">

                                                    <a href="{{ route('pages.index', $navigationLink->slug) }}">
                                                        <span class="menu-label"> {{ $navigationLink->label }}</span>
                                                    </a>

@if ($hasChildren)
       <ul class="sub-menu">
     @foreach ($navigationLink->children as $child)
        <li
            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3947">
            <a href="{{ route('pages.index', $child->slug) }}"><span
                    class="menu-label">{{ $child->label }}</span>
                    </a>
        </li>
     @endforeach
                                                </ul>
@endif


@if ($hasProducts)
    

                                                    <ul class="sub-menu">
                                                        <li>
                                                            <div class="ts-megamenu-widgets-container ts-megamenu-container">
                                                                <div data-elementor-type="wp-post" data-elementor-id="534"
                                                                    class="elementor elementor-534">
                                                                    <section
                                                                        class="elementor-section elementor-top-section elementor-element elementor-element-3487098 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                                                        data-id="3487098" data-element_type="section">
                                                                        <div
                                                                            class="elementor-container elementor-column-gap-default">
                                                                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-90d963e"
                                                                                data-id="90d963e" data-element_type="column">
                                                                                <div
                                                                                    class="elementor-widget-wrap elementor-element-populated">
                                                                                    <div class="elementor-element elementor-element-e79fa68 elementor-widget elementor-widget-ts-product-categories"
                                                                                        data-id="e79fa68"
                                                                                        data-element_type="widget"
                                                                                        data-widget_type="ts-product-categories.default">
                                                                                        <div class="elementor-widget-container">
                                                                                            <div
                                                                                                class="ts-product-category-wrapper ts-product ts-shortcode woocommerce columns-8 style-default grid">


                                                                                                <div class="content-wrapper ">
                                                                                                    <div class="products">
                                                                                                @php
                                                                                                    $categories = \App\Models\Category::select('id', 'image_path')->get();
                                                                                                @endphp

                                                                                                    @foreach ($categories as $category)
                                                                                                        <section
                                                                                                            class="product-category product first">

                                                                                                            <div
                                                                                                                class="product-wrapper">

                                                                                                        @if (asset('storage/' . $category->image_path))

    
                                                                                                                <a
                                                                                                                    href="{{ route('cms.' . $navigationLink->slug . '.index', ['category_id' => $category->id]) }}">
                                                                                                                    <img src="{{asset('storage/' . $category->image_path)}}"
                                                                                                                        alt="{{ $category->name }}"
                                                                                                                        width="600"
                                                                                                                        height="600" />
                                                                                                                </a>

                                                                                                        @endif

                                                                                                                <div
                                                                                                                    class="meta-wrapper">

                                                                                                                    <div
                                                                                                                        class="category-name">
                                                                                                                        <h3
                                                                                                                            class="heading-title">
                                                                                                                            <a
                                                                                                                                href="{{ route('cms.'.$navigationLink->slug .'.index', ['category_id' => $category->id]) }}">
                                                                                                                                 {{ $category->name }}
                                                                                                                            </a>
                                                                                                                        </h3>
                                                                                                                    </div>

                                                                                                                </div>


                                                                                                            </div>

                                                                                                        </section>
                                                                                                    @endforeach
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
@endif
                                                </li>

                                            @endforeach

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif
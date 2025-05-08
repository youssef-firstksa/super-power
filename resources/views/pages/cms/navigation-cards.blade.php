<x-cms-layout>
    {{-- <div class="card">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">

            <x-cms.h1>{{ $page_title }}</x-cms.h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach ($navigationLinks as $navigationLink)
                <x-cms.card :title="$navigationLink->page->title" :url="route('pages.index', $navigationLink->slug)"
                    :imageUrl="$navigationLink->page->getFirstImageTag()"
                    :content="$navigationLink?->page?->shortContent()" />
                @endforeach
            </div>
        </div>
    </div> --}}



    <div id="primary" class="site-content">
        <article id="post-612" class="post-612 page type-page status-publish hentry user-has-not-earned">
            <div data-elementor-type="wp-page" data-elementor-id="612" class="elementor elementor-612">
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-f0908c3 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                    data-id="f0908c3" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-e82220c"
                            data-id="e82220c" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                            </div>
                        </div>
                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-b5cf626"
                            data-id="b5cf626" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <section
                                    class="elementor-section elementor-inner-section elementor-element elementor-element-0bc3835 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                    data-id="0bc3835" data-element_type="section">
                                    <div class="elementor-container elementor-column-gap-default">
                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-c8acea7"
                                            data-id="c8acea7" data-element_type="column">
                                            <div class="elementor-widget-wrap elementor-element-populated">
                                            </div>
                                        </div>
                                        <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-89978c9"
                                            data-id="89978c9" data-element_type="column">
                                            <div class="elementor-widget-wrap elementor-element-populated">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-1aacbf5 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                    data-id="1aacbf5" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-61b5965"
                            data-id="61b5965" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-7d4ba55 eael-infobox-content-align-center elementor-widget elementor-widget-eael-info-box"
                                    data-id="7d4ba55" data-element_type="widget"
                                    data-widget_type="eael-info-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="eael-infobox">
                                            <div class="infobox-content">
                                                <h1>{{ $page_title }}</h1>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <section
                                    class="elementor-section elementor-inner-section elementor-element elementor-element-efa10d2 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                                    data-id="efa10d2" data-element_type="section"
                                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                    <div class="elementor-container elementor-column-gap-custom"
                                        style="display: flex;flex-wrap: wrap">

                                        @foreach ($navigationLinks as $navigationLink)
                                            {{-- START ELEMENT --}}
                                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-902d003"
                                                data-id="902d003" data-element_type="column"
                                                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                                <div class="elementor-widget-wrap elementor-element-populated">
                                                    <div class="elementor-element elementor-element-1589752 elementor-widget elementor-widget-heading"
                                                        data-id="1589752" data-element_type="widget"
                                                        data-widget_type="heading.default">
                                                        <div class="elementor-widget-container">
                                                            <style>
                                                                /*! elementor - v3.17.0 - 08-11-2023 */
                                                                .elementor-heading-title {
                                                                    padding: 0;
                                                                    margin: 0;
                                                                    line-height: 1
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a {
                                                                    color: inherit;
                                                                    font-size: inherit;
                                                                    line-height: inherit
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title.elementor-size-small {
                                                                    font-size: 15px
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title.elementor-size-medium {
                                                                    font-size: 19px
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title.elementor-size-large {
                                                                    font-size: 29px
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title.elementor-size-xl {
                                                                    font-size: 39px
                                                                }

                                                                .elementor-widget-heading .elementor-heading-title.elementor-size-xxl {
                                                                    font-size: 59px
                                                                }
                                                            </style>
                                                            <h1 class="elementor-heading-title elementor-size-default">
                                                                {{$navigationLink->page->title}}
                                                            </h1>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-3a6de21 elementor-align-left elementor-widget elementor-widget-button"
                                                        data-id="3a6de21" data-element_type="widget"
                                                        data-widget_type="button.default">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-button-wrapper">
                                                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                                                    href="{{route('pages.index', $navigationLink->slug)}}">
                                                                    <span class="elementor-button-content-wrapper">
                                                                        <span
                                                                            class="elementor-button-text">{{__('cms.read_more')}}</span>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="elementor-element elementor-element-670323f elementor-widget elementor-widget-image"
                                                        data-id="670323f" data-element_type="widget"
                                                        data-widget_type="image.default">
                                                        <div class="elementor-widget-container">
                                                            <style>
                                                                /*! elementor - v3.17.0 - 08-11-2023 */
                                                                .elementor-widget-image {
                                                                    text-align: center
                                                                }

                                                                .elementor-widget-image a {
                                                                    display: inline-block
                                                                }

                                                                .elementor-widget-image a img[src$=".svg"] {
                                                                    width: 48px
                                                                }

                                                                .elementor-widget-image img {
                                                                    vertical-align: middle;
                                                                    display: inline-block
                                                                }
                                                            </style>

                                                            @if ($navigationLink->page->getFirstImageTag())

                                                                <img fetchpriority="high" decoding="async" width="1000"
                                                                    height="778"
                                                                    src="{{$navigationLink->page->getFirstImageTag()}}"
                                                                    class="attachment-full size-full wp-image-8398" alt=""
                                                                    srcset="{{$navigationLink->page->getFirstImageTag()}}"
                                                                    sizes="(max-width: 1000px) 100vw, 1000px" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- END ELEMENT --}}
                                        @endforeach
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-7edd9a4 elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                    data-id="7edd9a4" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-cd95fba"
                            data-id="cd95fba" data-element_type="column">
                            <div class="elementor-widget-wrap">
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    class="elementor-section elementor-top-section elementor-element elementor-element-18bc14e elementor-section-full_width elementor-section-height-default elementor-section-height-default"
                    data-id="18bc14e" data-element_type="section"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-366cd7a"
                            data-id="366cd7a" data-element_type="column">
                            <div class="elementor-widget-wrap">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </article>
    </div>
</x-cms-layout>
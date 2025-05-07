<a href="{{route('home')}}" class="flex items-center gap-3">
    @if (\App\Services\CMS\CMSConfigrationService::appLogoPath())
        <img src="{{ \App\Services\CMS\CMSConfigrationService::appLogoPath() }}" style="width:64px;" alt="Landwind Logo" />
    @endif

    @if (\App\Services\CMS\CMSConfigrationService::appLogoText())
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
            {{ \App\Services\CMS\CMSConfigrationService::appLogoText() }}
        </span>
    @endif
</a>
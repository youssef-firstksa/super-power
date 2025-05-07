<?php

namespace App\Services\CMS;

use App\Models\NavigationLink;

class CMSConfigrationService
{
    public static function showHeader()
    {
        return (int) app()->make(AppSettingService::class)->getValue('show_header');
    }

    public static function showFooter()
    {
        return (int) app()->make(AppSettingService::class)->getValue('show_footer');
    }

    public static function appLogoPath()
    {
        $logoPath = app()->make(AppSettingService::class)->getImage('logo');

        if (!$logoPath) return null;

        return file_exists(public_path('storage/' . $logoPath)) ? asset('storage/' . $logoPath) : null;
    }

    public static function appLogoText()
    {
        return app()->make(AppSettingService::class)->getValue('logo_text');
    }

    public static function appTitle()
    {
        return app()->make(AppSettingService::class)->getValue('title') ?? config('app.name');
    }

    public static function getMeta(string $meta)
    {
        return app()->make(AppSettingService::class)->getValue("meta_{$meta}");
    }

    public static function getMetaImage(string $meta)
    {
        $imagePath = app()->make(AppSettingService::class)->getImage("meta_{$meta}");

        if (!$imagePath) return null;

        return file_exists(public_path('storage/' . $imagePath)) ? asset('storage/' . $imagePath) : null;
    }

    // getMetaImage

    public static function getCMSPagesOptions(?int $ignoreId = null)
    {
        $inUseCmsPagesIds = NavigationLink::whereNotNull('cms_page')
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->whereNot('id', $ignoreId);
            })
            ->pluck('cms_page');

        return collect(config('cms.pages'))
            ->where('status', 'active')
            ->whereNotIn('key', $inUseCmsPagesIds)
            ->pluck(app()->getLocale() . '.label', 'key');
    }
}

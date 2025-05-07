<?php

namespace App\Services\CMS;

use App\Models\NavigationLink;
use Illuminate\Database\Eloquent\Collection;

class NavigationService
{
    public static function getParentNavigationLinks()
    {
        return NavigationLink::where('status', 'active')
            ->whereNull('parent_id')
            ->with(['children'])
            ->orderBy('order', 'asc')
            ->get();
    }

    public static function getNavigationLinks()
    {
        return NavigationLink::where('status', 'active')
            ->with(['children'])
            ->orderBy('order', 'asc')
            ->get();
    }

    public static function getNavigationLink(string $slug): NavigationLink|null
    {
        return NavigationLink::where('status', 'active')
            ->where('slug', $slug)
            ->first();
    }

    public static function getCMSPageNavigationLinks(): Collection
    {
        return NavigationLink::where('status', 'active')
            ->where('page_type', 'cms_page')
            ->whereNotNull('controller')
            ->whereNotNull('action')
            ->get();
    }

    public static function getCMSPageNavigationLink(string $cmsPageName): NavigationLink|null
    {
        return NavigationLink::where('status', 'active')
            ->where('page_type', 'cms_page')
            ->where('cms_page', $cmsPageName)
            ->whereNotNull('controller')
            ->whereNotNull('action')
            ->first();
    }
}

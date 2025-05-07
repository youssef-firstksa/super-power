<?php

namespace App\Services\CMS;

use App\Models\AppSetting;

class AppSettingService
{
    public function getAll()
    {
        return AppSetting::where('status', 'active')->get();
    }

    public function get(string $key)
    {
        return AppSetting::where('status', 'active')
            ->where('key', $key)
            ->first();
    }

    public function getValue(string $key)
    {
        return AppSetting::select('id')
            ->where('status', 'active')
            ->where('key', $key)->first()?->value;
    }

    public function getImage(string $key)
    {
        $imagePath = AppSetting::select('id', 'image_path')
            ->where('status', 'active')
            ->where('key', $key)
            ->first()?->image_path;

        return $imagePath;
    }
}

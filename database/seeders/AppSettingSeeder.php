<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appSettings = config('cms.settings');

        foreach ($appSettings as $appSetting) {
            \App\Models\AppSetting::updateOrCreate(
                ['key' => $appSetting['key']],
                $appSetting,
            );
        }
    }
}

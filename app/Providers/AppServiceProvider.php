<?php

namespace App\Providers;

use App\Services\CMS\AppSettingService;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register AppSettingService as a singleton
        $this->app->singleton(AppSettingService::class, function ($app) {
            return new AppSettingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch->locales(['ar', 'en']); // Define supported locales
        });
    }
}

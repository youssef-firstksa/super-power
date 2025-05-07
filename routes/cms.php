<?php

use App\Http\Controllers\CMS\HomeController;
use App\Http\Controllers\CMS\PageController;
use App\Services\CMS\NavigationService;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        foreach (NavigationService::getCMSPageNavigationLinks() as $navigationLink) {
            Route::get($navigationLink->slug, [$navigationLink->controller, 'index'])->name("cms.{$navigationLink->slug}.index");
        }

        /**
         * Start Add the additional CMS pages here before the PageController to avoid conflicts
         */

        $navigationLink = NavigationService::getCMSPageNavigationLink('contact-us');
        if ($navigationLink) {

            Route::post($navigationLink->slug, [$navigationLink->controller, 'store'])
                ->name("cms.{$navigationLink->cms_page}.store");
        }

        $navigationLink = NavigationService::getCMSPageNavigationLink('blog');
        if ($navigationLink) {

            Route::get("{$navigationLink->slug}/{blog}", [$navigationLink->controller, 'show'])
                ->name("cms.{$navigationLink->cms_page}.show");
        }

        $navigationLink = NavigationService::getCMSPageNavigationLink('products');
        if ($navigationLink) {
            Route::get("{$navigationLink->slug}/{product}", [$navigationLink->controller, 'show'])
                ->name("cms.{$navigationLink->cms_page}.show");
        }


        /**
         * End Add the additional CMS pages here before the PageController to avoid conflicts
         */

        Route::get('/{slug}', [PageController::class, 'index'])->name('pages.index');
    });

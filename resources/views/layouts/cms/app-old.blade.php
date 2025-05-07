<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <link rel="canonical" href="https://https://demo.themesberg.com/landwind/" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{\App\Services\CMS\CMSConfigrationService::getMeta('title') ?? config('app.name')}}</title>

    <!-- Meta SEO -->
    <meta name="title" content="{{\App\Services\CMS\CMSConfigrationService::getMeta('title')}}">
    <meta name="description" content="{{\App\Services\CMS\CMSConfigrationService::getMeta('description')}}">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Themesberg">

    <!-- Social media share -->
    <meta property="og:title" content="{{\App\Services\CMS\CMSConfigrationService::getMeta('og_title')}}">
    <meta property="og:site_name" content="{{config('app.name')}}">
    <meta property="og:url" content="" />
    <meta property="og:description" content="{{\App\Services\CMS\CMSConfigrationService::getMeta('og_description')}}">
    <meta property="og:type" content="">
    <meta property="og:image" content="{{\App\Services\CMS\CMSConfigrationService::getMetaImage('og_image')}}">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@themesberg" />
    <meta name="twitter:creator" content="@themesberg" />

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('layouts.cms.partials.styles')
</head>

<body class="pt-20 lg:pt-28 bg-white dark:bg-gray-900 text-dark dark:text-white">
    @include('layouts.cms.partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('layouts.cms.partials.footer')

    @include('layouts.cms.partials.scripts')
</body>

</html>
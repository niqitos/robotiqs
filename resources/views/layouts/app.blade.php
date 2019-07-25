<!DOCTYPE html>
<html {{-- ⚡--}} lang="{{ app()->getLocale() }}">
<head>
    @if (config('app.env') == 'production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-55639956-6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-55639956-6');
        </script>


        <!-- Google AdSense -->
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-3010249669432310",
                enable_page_level_ads: true
            });
        </script>
    @endif

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow" />

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name') }}</title>
        <meta property="og:title" content="@yield('title') | {{ config('app.name') }}">
        <meta name="twitter:title" content="@yield('title') | {{ config('app.name') }}">
    @else
        <title>{{ config('app.name') }}</title>
        <meta property="og:title" content="{{ config('app.name') }}">
        <meta name="twitter:title" content="{{ config('app.name') }}">
    @endif

    @hasSection('description')
        <meta name="description" content="@yield('description') | {{ config('app.description') }}">
        <meta name="twitter:description" content="@yield('description') | {{ config('app.description') }}">
        <meta property="og:description" content="@yield('description') | {{ config('app.description') }}">
    @else
        <meta name="description" content="{{ config('app.description') }}">
        <meta name="twitter:description" content="{{ config('app.description') }}">
        <meta property="og:description" content="{{ config('app.description') }}">
    @endif

    <!-- Meta -->
    <meta name="twitter:card" content="summary_large_image" />
    {{-- <meta name="twitter:site" content="@nytimesbits" /> --}}
    {{-- <meta name="twitter:creator" content="@nickbilton" /> --}}
    <meta name="twitter:image" content="@yield('twitter:image')">
    {{-- <meta name="twitter:image" content="https://tjournal.ru/cover/tw/s/248070/1560370049/cover.jpg"> --}}

    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="fb:app_id" content="478735766268124">
    <meta property="vk:image" content="@yield('vk:image')">
    {{-- <meta property="vk:image" content="https://tjournal.ru/cover/vk/s/248070/1560370049/cover.jpg"> --}}

    <meta property="og:image" content="@yield('og:image')">
    {{-- <meta property="og:image" content="https://tjournal.ru/cover/fb/s/248070/1560370049/cover.jpg"> --}}
    <link rel="image_src" href="@yield('og:image')">
    {{-- <link rel="image_src" href="https://tjournal.ru/cover/fb/s/248070/1560370049/cover.jpg"> --}}
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="315">
    
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="author" content="@yield('author')">

    <meta property="article:author" content="https://www.facebook.com/robotiqs/">
    <meta property="article:publisher" content="https://www.facebook.com/robotiqs/">
    <meta property="article:published_time" content="2019-06-12T23:07:29+03:00">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#343a40">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#343a40">
    <meta name="msapplication-TileColor" content="#343a40">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#343a40">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#343a40">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
        ]) !!};
    </script>

    @yield('head')
    {{-- <script async src="https://cdn.ampproject.org/v0.js"></script> --}}
    {{-- <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "NewsArticle",
          "headline": "Open-source framework for publishing content",
          "datePublished": "2015-10-07T12:02:41Z",
          "image": [
            "logo.jpg"
          ]
        }
      </script> --}}
      {{-- <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript> --}}
</head>
<body>
    <div id="app" class="min-vh-100 {{ $theme }}">

        @include('layouts.nav')

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        @include('layouts.footer')

        <cookie-consent 
            privacy-endpoint="{{ route('terms.privacy') }}" 
            message="{{ __('This website uses cookies.') }}"
            read="{{ __('Read more') }}"
            accept="{{ __('Accept') }}"
        ></cookie-consent>

        <flash 
            flash-type="{{ session('flash.type') }}" 
            flash-message="{{ session('flash.message') }}"
        ></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">
        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
        }
    </script>
    
    @yield('scripts')
</body>
</html>

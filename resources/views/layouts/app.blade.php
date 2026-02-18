<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $global_settings->get('meta_title', 'St. Anne Marie Academy Schools'))</title>
    <meta name="description" content="@yield('meta_description', $global_settings->get('meta_description', 'High quality education from Nursery to Advanced Level in Tanzania.'))">
    <meta name="keywords" content="{{ $global_settings->get('meta_keywords', 'education, tanzania, school, st marie, saint marie, st marie trust, st marie academy, saint marie academy, stmarie, saintmarie, stmarieacademy, stmarietrust, st marie school, st marie trust school') }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="/images/school/graduation.jpg" as="image" type="image/jpeg" fetchpriority="high">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $global_settings->get('meta_title', 'St. Anne Marie Academy Schools'))">
    <meta property="og:description" content="@yield('og_description', $global_settings->get('meta_description', 'High quality education.'))">
    <meta property="og:image" content="{{ url($global_settings->get('og_image', '/images/school/logo_st_anne_official.jpg')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', $global_settings->get('meta_title', 'St. Anne Marie Academy Schools'))">
    <meta property="twitter:description" content="@yield('twitter_description', $global_settings->get('meta_description', 'High quality education.'))">
    <meta property="twitter:image" content="{{ url($global_settings->get('og_image', '/images/school/logo_st_anne_official.jpg')) }}">

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "Organization",
        "name": "St. Anne Marie Academy Schools",
        "alternateName": [
            "St Marie",
            "Saint Marie",
            "St Marie Trust",
            "St Marie Academy",
            "Saint Marie Academy",
            "Stmarie",
            "Saintmarie",
            "Stmarieacademy",
            "Stmarietrust",
            "St Marie School",
            "St Marie Trust School"
        ],
        "url": "https://saintannemarietrust.co.tz",
        "logo": "{{ url('/images/school/logo_st_anne_official.jpg') }}",
        "sameAs": [
            "{{ $global_settings->get('facebook_url', '#') }}",
            "{{ $global_settings->get('instagram_url', '#') }}"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+255 754 812 345",
            "contactType": "customer service"
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "WebSite",
        "url": "https://saintannemarietrust.co.tz",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://saintannemarietrust.co.tz/news?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    </noscript>

    <!-- CSS Variables & Base Styles -->
    <style>
        :root {
            --school-primary: #1e5128;
            --school-secondary: #c41e3a;
            --school-accent: #00FF88;
        }
    </style>

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        @include('partials.nav')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    @yield('scripts')
</body>
</html>
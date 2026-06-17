<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(trim($__env->yieldContent('page_title')))
    <title>@yield('page_title') — {{ $siteSetting?->site_name ?? 'The Bengal Club' }}</title>
    @else
    <title>{{ $seoSetting?->meta_title ?? ($siteSetting?->site_name ?? 'The Bengal Club') }} @if(!$seoSetting?->meta_title && $siteSetting?->site_tagline) - {{ $siteSetting->site_tagline }} @endif</title>
    @endif

    @if($siteSetting?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $siteSetting->favicon) }}">
    @endif

    {{-- Page-specific meta (pushed before global tags so they take precedence for crawlers) --}}
    @stack('head_meta')

    <!-- Basic SEO Meta Tags -->
    @if($seoSetting?->meta_description)
        <meta name="description" content="{{ $seoSetting->meta_description }}">
    @endif

    @if($seoSetting?->meta_keywords)
        <meta name="keywords" content="{{ $seoSetting->meta_keywords }}">
    @endif

    @if($seoSetting?->meta_author)
        <meta name="author" content="{{ $seoSetting->meta_author }}">
    @endif

    @if($seoSetting?->canonical_url)
        <link rel="canonical" href="{{ $seoSetting->canonical_url }}">
    @endif

    <!-- Robots Meta Tag -->
    @if($seoSetting?->index_page === false)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    <!-- Open Graph / Facebook Meta Tags -->
    @if($seoSetting?->og_title)
        <meta property="og:title" content="{{ $seoSetting->og_title }}">
    @endif

    @if($seoSetting?->og_description)
        <meta property="og:description" content="{{ $seoSetting->og_description }}">
    @endif

    @if($seoSetting?->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seoSetting->og_image) }}">
    @endif

    @if($seoSetting?->og_url)
        <meta property="og:url" content="{{ $seoSetting->og_url }}">
    @endif

    <meta property="og:type" content="{{ $seoSetting?->og_type ?? 'website' }}">

    @if($seoSetting?->og_site_name)
        <meta property="og:site_name" content="{{ $seoSetting->og_site_name }}">
    @endif

    @if($seoSetting?->fb_app_id)
        <meta property="fb:app_id" content="{{ $seoSetting->fb_app_id }}">
    @endif

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $seoSetting?->twitter_card ?? 'summary_large_image' }}">

    @if($seoSetting?->twitter_site)
        <meta name="twitter:site" content="{{ $seoSetting->twitter_site }}">
    @endif

    @if($seoSetting?->twitter_creator)
        <meta name="twitter:creator" content="{{ $seoSetting->twitter_creator }}">
    @endif

    @if($seoSetting?->twitter_title)
        <meta name="twitter:title" content="{{ $seoSetting->twitter_title }}">
    @endif

    @if($seoSetting?->twitter_description)
        <meta name="twitter:description" content="{{ $seoSetting->twitter_description }}">
    @endif

    @if($seoSetting?->twitter_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seoSetting->twitter_image) }}">
    @endif

    <!-- Google Site Verification -->
    @if($seoSetting?->google_site_verification)
        <meta name="google-site-verification" content="{{ $seoSetting->google_site_verification }}">
    @endif

    <!-- Google Analytics -->
    @if($seoSetting?->google_analytics_id)
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoSetting->google_analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $seoSetting->google_analytics_id }}');
        </script>
    @endif

    <!-- Facebook Pixel -->
    @if($seoSetting?->facebook_pixel_id)
        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $seoSetting->facebook_pixel_id }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id={{ $seoSetting->facebook_pixel_id }}&ev=PageView&noscript=1"/>
        </noscript>
    @endif

    <!-- Custom Head Code -->
    @if($seoSetting?->custom_head_code)
        {!! $seoSetting->custom_head_code !!}
    @endif

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: '#0f70bf',
                        'accent-dark': '#0a5a9c',
                        'accent-light': '#1a8fe0',
                        dark: {
                            900: '#0a0a0a',
                            800: '#111111',
                            700: '#1a1a1a',
                            600: '#222222',
                            500: '#2a2a2a'
                        }
                    },
                    fontFamily: {
                        sans: ['Roboto', 'system-ui', '-apple-system', 'sans-serif'],
                        display: ['Roboto', 'system-ui', '-apple-system', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/directors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event-details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/csr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/archive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    @stack('styles')
</head>
<body class="bg-dark-900 text-white font-sans overflow-x-hidden">

    <!-- Custom Body Code -->
    @if($seoSetting?->custom_body_code)
        {!! $seoSetting->custom_body_code !!}
    @endif

    <!-- Custom Cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-outline"></div>

    @include("frontend.partial.header")

    @yield("content")

    @include("frontend.partial.footer")

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/8801988855507?text={{ urlencode('Hello, I would like to know more about ' . ($siteSetting?->site_name ?? 'The Bengal Club') . '.') }}"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat with us on WhatsApp"
       class="whatsapp-float">
        <span class="whatsapp-pulse"></span>
        <svg class="whatsapp-icon" viewBox="0 0 32 32" fill="currentColor" aria-hidden="true">
            <path d="M19.11 17.27c-.27-.13-1.6-.79-1.85-.88-.25-.09-.43-.13-.61.13-.18.27-.7.88-.86 1.06-.16.18-.32.2-.59.07-.27-.13-1.14-.42-2.18-1.34-.81-.72-1.35-1.6-1.51-1.87-.16-.27-.02-.42.12-.55.12-.12.27-.32.4-.48.13-.16.18-.27.27-.45.09-.18.04-.34-.02-.48-.07-.13-.61-1.46-.83-2-.22-.53-.44-.45-.61-.46l-.52-.01c-.18 0-.48.07-.73.34-.25.27-.96.94-.96 2.29 0 1.35.98 2.65 1.12 2.83.13.18 1.93 2.95 4.68 4.13.65.28 1.16.45 1.56.58.66.21 1.25.18 1.72.11.52-.08 1.6-.65 1.83-1.28.23-.63.23-1.18.16-1.29-.07-.11-.25-.18-.52-.31zM16.05 5.33c-5.92 0-10.74 4.81-10.74 10.74 0 1.89.5 3.74 1.45 5.37l-1.55 5.65 5.79-1.52c1.57.86 3.34 1.31 5.14 1.32h.01c5.92 0 10.74-4.81 10.74-10.74 0-2.87-1.12-5.57-3.15-7.6a10.69 10.69 0 0 0-7.6-3.15zm0 19.62h-.01c-1.6 0-3.17-.43-4.55-1.25l-.33-.19-3.43.9.92-3.34-.21-.34a8.92 8.92 0 0 1-1.37-4.75c0-4.93 4.01-8.93 8.94-8.93 2.39 0 4.63.93 6.32 2.62a8.87 8.87 0 0 1 2.62 6.32c0 4.93-4.01 8.93-8.93 8.93z"/>
        </svg>
        <span class="whatsapp-tooltip">Chat on WhatsApp</span>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.4), 0 4px 12px rgba(0, 0, 0, 0.25);
            z-index: 9999;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            text-decoration: none;
        }
        .whatsapp-float:hover {
            transform: scale(1.08);
            box-shadow: 0 12px 32px rgba(37, 211, 102, 0.55), 0 6px 16px rgba(0, 0, 0, 0.3);
        }
        .whatsapp-float:active {
            transform: scale(0.96);
        }
        .whatsapp-icon {
            width: 32px;
            height: 32px;
            position: relative;
            z-index: 2;
        }
        .whatsapp-pulse {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: #25D366;
            opacity: 0.6;
            animation: whatsapp-pulse 2s ease-out infinite;
            z-index: 1;
        }
        @keyframes whatsapp-pulse {
            0%   { transform: scale(1);   opacity: 0.6; }
            70%  { transform: scale(1.6); opacity: 0; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        .whatsapp-tooltip {
            position: absolute;
            right: calc(100% + 14px);
            top: 50%;
            transform: translateY(-50%) translateX(8px);
            background: #111;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease, transform 0.25s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .whatsapp-tooltip::after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: #111;
        }
        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }
        @media (max-width: 640px) {
            .whatsapp-float {
                bottom: 18px;
                right: 18px;
                width: 54px;
                height: 54px;
            }
            .whatsapp-icon { width: 28px; height: 28px; }
            .whatsapp-tooltip { display: none; }
        }
    </style>

    @if(Request::routeIs('frontend.index'))
        @include('frontend.partial.announcement-modal')
    @endif

    <!-- JavaScript Files -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>
    <script src="{{ asset('js/banner.js') }}"></script>
    <script src="{{ asset('js/facilities.js') }}"></script>
    <script src="{{ asset('js/directors.js') }}"></script>
    <script src="{{ asset('js/events.js') }}"></script>
    <script src="{{ asset('js/event-details.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
    @stack('scripts')
</body>
</html>

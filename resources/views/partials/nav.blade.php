@php
    $navItems = [
        ['label' => 'Home', 'path' => '/'],
        ['label' => 'About Us', 'path' => '/about'],
        ['label' => 'Campuses', 'path' => '/campuses'],
        ['label' => 'Academics', 'path' => '/academics'],
        ['label' => 'Admissions', 'path' => '/admissions'],
        ['label' => 'Gallery', 'path' => '/gallery'],
        ['label' => 'Staff', 'path' => '/staff'],
        ['label' => 'News & Events', 'path' => '/news'],
        ['label' => 'Contact Us', 'path' => '/contact'],
    ];
@endphp

<style>
    .hidden { display: none !important; }

    .top-bar {
        background: var(--school-primary, #1e5128);
        color: white;
        padding: 0.5rem 0;
        font-size: 0.75rem;
        border-bottom: 1px solid var(--school-secondary, #c41e3a);
        min-height: 40px; /* Lock height to prevent layout shift */
    }

    .top-bar-container {
        max-width: 1536px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
    }

    .top-bar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .top-bar-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .top-bar-item svg {
        width: 0.875rem;
        height: 0.875rem;
    }

    .top-bar-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .top-bar-social {
        transition: transform 0.3s, color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
    }

    .top-bar-social:hover {
        color: #d4a700;
        transform: translateY(-2px);
    }

    .top-bar-social svg {
        width: 1.125rem;
        height: 1.125rem;
    }

    .main-header {
        position: sticky;
        top: 0;
        z-index: 50;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .header-container {
        max-width: 1536px;
        margin: 0 auto;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .header-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .header-logo-image {
        width: 3.5rem;
        height: 3.5rem;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.125rem;
        background: white;
        border-radius: 9999px;
        border: 2px solid var(--school-primary, #1e5128);
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .header-logo-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 9999px;
    }

    .header-logo-text {
        display: flex;
        flex-direction: column;
    }

    .header-logo-title {
        font-family: Georgia, serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        line-height: 1.2;
        text-transform: uppercase;
        transition: color 0.3s;
    }

    .header-logo:hover .header-logo-title {
        color: var(--school-secondary, #c41e3a);
    }

    .header-logo-subtitle {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--school-secondary, #c41e3a);
        letter-spacing: 0.1em;
    }

    .desktop-nav {
        display: none;
        align-items: center;
        gap: 2rem;
    }

    .nav-link {
        font-weight: 600;
        color: #374151;
        text-decoration: none;
        padding: 0.5rem 0;
        transition: color 0.3s;
        position: relative;
    }

    .nav-link:hover {
        color: var(--school-secondary, #c41e3a);
    }

    .nav-link.active {
        color: var(--school-secondary, #c41e3a);
        border-bottom: 2px solid var(--school-secondary, #c41e3a);
    }

    .nav-apply-btn {
        background: var(--school-secondary, #c41e3a);
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .nav-apply-btn:hover {
        background: #b01830;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px -2px rgba(0, 0, 0, 0.15);
    }

    .mobile-menu-toggle {
        display: block;
        color: var(--school-primary, #1e5128);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
    }

    .mobile-menu-toggle svg {
        width: 1.75rem;
        height: 1.75rem;
    }

    .mobile-menu-toggle .close-icon {
        width: 1.75rem;
        height: 1.75rem;
    }

    .mobile-nav {
        background: white;
        border-top: 1px solid #f3f4f6;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .mobile-nav.active {
        display: block;
    }

    .mobile-nav-container {
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }

    .mobile-nav-link {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
        font-weight: 600;
        color: #374151;
        text-decoration: none;
        transition: color 0.3s;
    }

    .mobile-nav-link:hover,
    .mobile-nav-link.active {
        color: var(--school-secondary, #c41e3a);
    }

    .mobile-nav-apply-btn {
        margin-top: 1rem;
        background: var(--school-secondary, #c41e3a);
        text-align: center;
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 700;
        text-decoration: none;
        display: block;
    }

    /* Responsive Adjustments */
    @media (max-width: 1023px) {
        .top-bar-container {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 0.5rem;
        }

        .top-bar-left {
            flex-direction: column;
            gap: 0.25rem;
        }

        .header-container {
            padding: 0.5rem 1rem;
        }

        .header-logo-image {
            width: 2.5rem;
            height: 2.5rem;
        }

        .header-logo-title {
            font-size: 1rem;
        }

        .header-logo-subtitle {
            font-size: 0.65rem;
        }
    }

    /* Mobile Drawer Styles */
    .mobile-nav-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
    }

    .mobile-nav-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 280px;
        height: 100vh;
        background: white;
        z-index: 1000;
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }

    .mobile-nav.active {
        transform: translateX(0);
        display: flex;
    }

    .mobile-nav-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #f3f4f6;
    }

    .mobile-nav-title {
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        font-family: Georgia, serif;
    }

    .mobile-close-btn {
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 0.25rem;
    }

    .mobile-nav-container {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
        display: flex;
        flex-direction: column;
    }

    .mobile-nav-link {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
        font-weight: 600;
        color: #374151;
        text-decoration: none;
        transition: color 0.3s;
        display: block;
    }

    .mobile-nav-link:hover,
    .mobile-nav-link.active {
        color: var(--school-secondary, #c41e3a);
        padding-left: 0.5rem;
    }

    .mobile-nav-apply-btn {
        margin-top: auto; /* Push to bottom of container if enough space, or just margin top */
        background: var(--school-secondary, #c41e3a);
        text-align: center;
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 700;
        text-decoration: none;
        display: block;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    @media (min-width: 1024px) {
        .top-bar {
            display: block;
        }

        .top-bar-container {
            flex-direction: row;
            justify-content: space-between;
            text-align: left;
        }

        .top-bar-left {
            flex-direction: row;
        }

        .desktop-nav {
            display: flex;
        }

        .header-container {
            justify-content: space-between;
        }

        .mobile-menu-toggle {
            display: none;
        }
        
        .header-logo-image {
            width: 3.5rem;
            height: 3.5rem;
        }

        .header-logo-title {
            font-size: 1.125rem;
        }
    }
</style>

<!-- Top Bar -->
<div class="top-bar">
    <div class="top-bar-container">
        <div class="top-bar-left">
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                Mbezi kwa Musuguri, DSM
            </span>
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                {{ $global_settings->get('contact_email', 'stannemarieacademy@gmail.com') }}
            </span>
            <span class="top-bar-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                {{ $global_settings->get('contact_phone', '+255 754 309 879') }}
            </span>
        </div>
        <div class="top-bar-right">
            @if($global_settings->has('facebook_link'))
            <a href="{{ $global_settings->get('facebook_link') }}" target="_blank" class="top-bar-social" aria-label="Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            @endif
            @if($global_settings->has('youtube_link'))
            <a href="{{ $global_settings->get('youtube_link') }}" target="_blank" class="top-bar-social" aria-label="YouTube">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
            </a>
            @endif
            @if($global_settings->has('instagram_link'))
            <a href="{{ $global_settings->get('instagram_link') }}" target="_blank" class="top-bar-social" aria-label="Instagram">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="main-header">
    <div class="header-container">
        <!-- Mobile Menu Toggle (left side on mobile) -->
        <button onclick="toggleMobileMenu()" class="mobile-menu-toggle" aria-label="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
        </button>

        <!-- Logo -->
        <a href="{{ url('/') }}" class="header-logo">
            <div class="header-logo-image">
                <img src="/images/school/logo_st_anne.jpg" alt="St. Anne Marie Logo" width="56" height="56" fetchpriority="high">
            </div>
            <div class="header-logo-text">
                <span class="header-logo-title">St. Anne Marie</span>
                <span class="header-logo-subtitle">ACADEMY SCHOOLS</span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="desktop-nav">
            @foreach($navItems as $item)
                <a 
                    href="{{ url($item['path']) }}" 
                    class="nav-link {{ request()->is(trim($item['path'], '/') ?: '/') ? 'active' : '' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
            <a href="{{ url('/admissions') }}" class="nav-apply-btn">
                Apply Now
            </a>
        </nav>
    </div>
</header>

<!-- Mobile Nav Drawer -->
<div id="mobile-nav-overlay" class="mobile-nav-overlay" onclick="toggleMobileMenu()"></div>
<div id="mobile-menu" class="mobile-nav">
    <div class="mobile-nav-header">
        <span class="mobile-nav-title">Menu</span>
        <button onclick="toggleMobileMenu()" class="mobile-close-btn" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
    </div>
    <nav class="mobile-nav-container">
        @foreach($navItems as $item)
            <a 
                href="{{ url($item['path']) }}" 
                class="mobile-nav-link {{ request()->is(trim($item['path'], '/') ?: '/') ? 'active' : '' }}"
            >
                {{ $item['label'] }}
            </a>
        @endforeach
        <a href="{{ url('/admissions') }}" class="mobile-nav-apply-btn">
            Apply Now
        </a>
    </nav>
</div>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-nav-overlay');
        const body = document.body;
        
        menu.classList.toggle('active');
        overlay.classList.toggle('active');
        
        if (menu.classList.contains('active')) {
            body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        } else {
            body.style.overflow = '';
        }
    }
</script>
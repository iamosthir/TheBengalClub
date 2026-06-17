<!-- Header -->
    <header id="header" class="fixed top-0 left-0 w-full z-50 transition-all duration-500">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('frontend.index') }}" class="logo-link flex items-center gap-3 group shrink-0">
                    @if($siteSetting?->logo)
                        <img class="w-40" src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->site_name ?? 'Logo' }}">
                    @else
                        <img class="w-40" src="./img/logo.jpeg" alt="Logo">
                    @endif
                </a>

                <!-- Desktop Navigation -->
                <ul id="nav-links" class="hidden lg:flex items-center gap-8 nav-collapsible">
                    <li><a href="{{ route('frontend.index') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('frontend.index') }}#about" class="nav-link">About Us</a></li>
                    <li><a href="{{ route('frontend.index') }}#facilities" class="nav-link">Facilities</a></li>
                    <li><a href="{{ route('frontend.index') }}#events" class="nav-link">Events</a></li>
                    <li><a href="{{ route('frontend.index') }}#social-impact" class="nav-link">Social Impact</a></li>
                    <li><a href="{{ route('honorary-members') }}" class="nav-link">Honorary Members</a></li>
                    <li><a href="{{ route('shop') }}#shop" class="nav-link">Shop</a></li>
                    <li><a href="{{ route('donate') }}" class="nav-link">Donate</a></li>
                    <li><a href="{{ route('frontend.index') }}#contact" class="nav-link">Contact</a></li>
                </ul>

                <!-- Header Search Bar (desktop — shown when search is open) -->
                <div id="header-search-bar" class="header-search-bar hidden lg:flex">
                    <form action="{{ route('member.search') }}" method="GET" class="header-search-form">
                        <svg class="header-search-icon-inner" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                        </svg>
                        <input type="search" name="id" id="header-search-input"
                               class="header-search-input"
                               placeholder="Search by Member ID or Phone…"
                               autocomplete="off" autofocus>
                        <button type="button" id="search-close-btn" class="header-search-close" aria-label="Close search">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Right Controls -->
                <div id="nav-cta" class="flex items-center gap-3 nav-collapsible">
                    <!-- CTA Buttons (desktop only) -->
                    <div class="hidden lg:flex items-center gap-3">
                        @auth
                            <a href="{{ route('member.tan-samiti.index') }}" class="btn-outline px-4 py-2.5 text-sm">
                                Investment Plan
                            </a>
                            <a href="{{ route('member.dashboard') }}" class="btn-outline px-5 py-2.5 text-sm">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('member.logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn-primary px-5 py-2.5 text-sm">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('member.login') }}" class="btn-outline px-5 py-2.5 text-sm">
                                Login
                            </a>
                            <a href="{{ route("membership.application.form") }}" class="btn-primary px-5 py-2.5 text-sm">
                                Join Now
                            </a>
                        @endauth
                    </div>

                    <!-- Search Icon (always visible) -->
                    <button id="search-open-btn" class="header-search-trigger" aria-label="Search member">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                        </svg>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden flex flex-col gap-1.5 p-2" aria-label="Open menu">
                        <span class="menu-line w-6 h-0.5 bg-white transition-all duration-300"></span>
                        <span class="menu-line w-6 h-0.5 bg-white transition-all duration-300"></span>
                        <span class="menu-line w-4 h-0.5 bg-white transition-all duration-300 ml-auto"></span>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Bar (below nav row, shown when search open on mobile) -->
            <div id="mobile-search-bar" class="mobile-search-bar">
                <form action="{{ route('member.search') }}" method="GET" class="mobile-search-form">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="shrink-0 text-gray-400">
                        <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/>
                    </svg>
                    <input type="search" name="id" id="mobile-search-input"
                           class="mobile-search-input"
                           placeholder="Search by Member ID or Phone…"
                           autocomplete="off">
                </form>
            </div>
        </nav>
    </header>

    <!-- Mobile Drawer Backdrop -->
    <div id="drawer-backdrop" class="drawer-backdrop"></div>

    <!-- Mobile Drawer -->
    <div id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
        <!-- Drawer Header -->
        <div class="drawer-header">
            <a href="{{ route('frontend.index') }}" class="logo-link">
                @if($siteSetting?->logo)
                    <img class="h-10 w-auto" src="{{ asset('storage/' . $siteSetting->logo) }}" alt="{{ $siteSetting->site_name ?? 'Logo' }}">
                @else
                    <span class="text-white font-bold text-lg">{{ $siteSetting->site_name ?? 'Bengal Club' }}</span>
                @endif
            </a>
            <button id="drawer-close-btn" class="drawer-close" aria-label="Close menu">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Drawer Nav -->
        <nav class="drawer-nav">
            <ul>
                <li><a href="{{ route('frontend.index') }}" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </span>Home</a></li>
                <li><a href="{{ route('frontend.index') }}#about" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>About Us</a></li>
                <li><a href="{{ route('frontend.index') }}#facilities" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </span>Facilities</a></li>
                <li><a href="{{ route('frontend.index') }}#events" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>Events</a></li>
                <li><a href="{{ route('frontend.index') }}#social-impact" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </span>Social Impact</a></li>
                <li><a href="{{ route('honorary-members') }}" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </span>Honorary Members</a></li>
                <li><a href="{{ route('shop') }}#shop" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </span>Shop</a></li>
                <li><a href="{{ route('donate') }}" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>Donate</a></li>
                <li><a href="{{ route('frontend.index') }}#contact" class="drawer-link">
                    <span class="drawer-link-icon">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>Contact</a></li>
            </ul>
        </nav>

        <!-- Drawer Footer / Auth Buttons -->
        <div class="drawer-footer">
            @auth
                <a href="{{ route('member.tan-samiti.index') }}" class="drawer-btn-outline">Investment Plan</a>
                <a href="{{ route('member.dashboard') }}" class="drawer-btn-outline">Dashboard</a>
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" class="drawer-btn-primary">Logout</button>
                </form>
            @else
                <a href="{{ route('member.login') }}" class="drawer-btn-outline">Login</a>
                <a href="{{ route('membership.application.form') }}" class="drawer-btn-primary">Join Now</a>
            @endauth
        </div>
    </div>

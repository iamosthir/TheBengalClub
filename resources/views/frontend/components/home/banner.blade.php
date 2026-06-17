<!-- Banner Section -->
    <section id="home" class="banner-section relative min-h-screen overflow-hidden">
        <div class="banner-slider">
            @forelse($banners as $index => $banner)
                <!-- Slide {{ $index + 1 }} -->
                <div class="banner-slide {{ $index === 0 ? 'active' : '' }}">
                    <div class="slide-bg" style="background-image: url('{{ asset('storage/' . $banner->image_path) }}')"></div>
                    <div class="slide-overlay"></div>
                    <div class="slide-content container mx-auto px-6 h-full flex items-center">
                        <div class="max-w-3xl">
                            @if($banner->subtitle)
                                <span class="slide-caption">{{ $banner->subtitle }}</span>
                            @endif
                            <h1 class="slide-title">{{ $banner->title }}</h1>
                            @if($banner->extra_text)
                                <p class="slide-description">
                                    {{ $banner->extra_text }}
                                </p>
                            @endif
                            @if($banner->enable_action_button && $banner->button_text && $banner->action_link)
                                <a href="{{ $banner->action_link }}" class="btn-primary slide-btn">
                                    {{ $banner->button_text }}
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default Slide if no banners exist -->
                <div class="banner-slide active">
                    <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1920&q=80')"></div>
                    <div class="slide-overlay"></div>
                    <div class="slide-content container mx-auto px-6 h-full flex items-center">
                        <div class="max-w-3xl">
                            <span class="slide-caption">Welcome to Excellence</span>
                            <h1 class="slide-title">The Bengal Club</h1>
                            <p class="slide-description">
                                A prestigious institution dedicated to fostering community, culture, and excellence.
                                Join us in creating lasting memories and meaningful connections.
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Banner Navigation -->
        @if($banners->isNotEmpty())
            <div class="banner-nav">
                @foreach($banners as $index => $banner)
                    <button class="banner-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @endif

        <!-- Banner Arrows -->
        <button class="banner-arrow banner-prev">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button class="banner-arrow banner-next">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
            <span>Scroll Down</span>
        </div>
    </section>

<!-- About Section -->
@if($aboutUs)
    <section id="about" class="about-section py-24 lg:py-32 relative overflow-hidden">
        <div class="about-bg-pattern"></div>
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Image Side -->
                <div class="about-image-wrapper reveal-left">
                    <div class="about-image-container">
                        <img src="{{ $aboutUs->image_path ? asset('storage/' . $aboutUs->image_path) : 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?w=800&q=80' }}"
                             alt="About The Bengal Club"
                             class="about-image">
                        <div class="about-image-border"></div>
                        <div class="about-image-accent"></div>
                    </div>
                    {{-- <div class="experience-badge">
                        <span class="experience-number">50+</span>
                        <span class="experience-text">Years of Excellence</span>
                    </div> --}}
                </div>

                <!-- Content Side -->
                <div class="about-content reveal-right">
                    <span class="section-caption">About The Bengal Club</span>
                    <h2 class="section-title">{{ $aboutUs->title ?? 'A Premier Social & Business Club' }}</h2>
                    <div class="section-text">
                        {!! $aboutUs->content !!}
                    </div>

                    <!-- Features -->
                    <div class="about-features">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Elite Community</h4>
                                <p>Join {{ number_format($siteSetting?->total_members ?? 0) }}+ distinguished members</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <h4>Premium Facilities</h4>
                                <p>World-class amenities & services</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route("membership.application.form") }}" class="btn-primary mt-8">
                        Become a member today
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

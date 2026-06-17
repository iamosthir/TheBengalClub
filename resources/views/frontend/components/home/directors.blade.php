<!-- Board of Directors Section -->
    <section id="directors" class="directors-section py-24 lg:py-32 bg-dark-800 relative overflow-hidden">
        <div class="container mx-auto px-6 mb-16">
            <div class="text-center max-w-2xl mx-auto reveal-up">
                <span class="section-caption">Leadership</span>
                <h2 class="section-title">Board of Directors</h2>
                <p class="section-text">
                    Meet the visionary leaders who guide The Bengal Club towards excellence and innovation.
                </p>
            </div>
        </div>

        <!-- Directors Marquee -->
        <div class="directors-marquee">
            <div class="marquee-track">
                @forelse($directors as $director)
                    <!-- Director Card -->
                    <div class="director-card">
                        <div class="director-image">
                            @if($director->photo_path)
                                <img src="{{ asset('storage/' . $director->photo_path) }}" alt="{{ $director->name }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($director->name) }}&size=400&background=random" alt="{{ $director->name }}">
                            @endif
                            <div class="director-overlay">
                                @if($director->social_links && is_array($director->social_links) && count($director->social_links) > 0)
                                    <div class="director-socials">
                                        @foreach($director->social_links as $social)
                                            @if(isset($social['url']) && $social['url'])
                                                <a href="{{ $social['url'] }}" class="social-link" target="_blank" rel="noopener">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="director-info">
                            <h4>{{ $director->name }}</h4>
                            @if($director->designation)
                                <p>{{ $director->designation }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <!-- Default Director Cards if none exist -->
                    <div class="director-card">
                        <div class="director-image">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80" alt="Director">
                            <div class="director-overlay">
                                <div class="director-socials">
                                    <a href="#" class="social-link">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="director-info">
                            <h4>Board Member</h4>
                            <p>Position</p>
                        </div>
                    </div>
                @endforelse

                <!-- Duplicate for seamless loop -->
                @foreach($directors as $director)
                    <div class="director-card">
                        <div class="director-image">
                            @if($director->photo_path)
                                <img src="{{ asset('storage/' . $director->photo_path) }}" alt="{{ $director->name }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($director->name) }}&size=400&background=random" alt="{{ $director->name }}">
                            @endif
                            <div class="director-overlay">
                                @if($director->social_links && is_array($director->social_links) && count($director->social_links) > 0)
                                    <div class="director-socials">
                                        @foreach($director->social_links as $social)
                                            @if(isset($social['url']) && $social['url'])
                                                <a href="{{ $social['url'] }}" class="social-link" target="_blank" rel="noopener">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="director-info">
                            <h4>{{ $director->name }}</h4>
                            @if($director->designation)
                                <p>{{ $director->designation }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

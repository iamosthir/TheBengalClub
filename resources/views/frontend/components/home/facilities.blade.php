<!-- Facilities & Amenities Section -->
    <section id="facilities" class="facilities-section py-24 lg:py-32 bg-dark-800 relative overflow-hidden">
        <div class="facilities-bg-pattern"></div>
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
                <span class="section-caption">Our Facilities</span>
                <h2 class="section-title">World-Class Amenities</h2>
                <p class="section-text">
                    Experience exclusive access to premium facilities designed for your comfort,
                    leisure, and professional success.
                </p>
            </div>

            <div class="facilities-grid grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($facilities as $index => $facility)
                <div class="facility-card reveal-up" style="--delay: {{ ($index + 1) * 0.1 }}s">
                    <div class="facility-image">
                        <img src="{{ $facility->image_path ? asset('storage/' . $facility->image_path) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&q=80' }}"
                             alt="{{ $facility->name }}">
                        <div class="facility-overlay">
                            @if($facility->tag_line)
                            <span class="facility-badge">{{ $facility->tag_line }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="facility-content">
                        <h3 class="facility-title">{{ $facility->name }}</h3>
                        <p class="facility-description">
                            {{ $facility->short_bio }}
                        </p>
                        @if($facility->features && count($facility->features) > 0)
                        <ul class="facility-features">
                            @foreach($facility->features as $feature)
                            <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16 reveal-up">
                <a href="{{ route("membership.application.form") }}" class="btn-primary">
                    Join the commiunity
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

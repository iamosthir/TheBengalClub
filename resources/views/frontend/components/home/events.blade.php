<!-- Events Section -->
    <section id="events" class="events-section py-24 lg:py-32 relative overflow-hidden">
        <div class="events-bg-glow"></div>
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
                <span class="section-caption">What's Happening</span>
                <h2 class="section-title">Upcoming Events</h2>
                <p class="section-text">
                    Join us for exclusive gatherings, cultural celebrations, and networking opportunities.
                </p>
            </div>

            <div class="events-grid">
                @forelse($events as $index => $event)
                    @php
                        $isUpcoming = $event->date >= now()->startOfDay();
                        $delay = ($index % 3) * 0.1 + 0.1;
                    @endphp
                    <!-- Event Card {{ $index + 1 }} -->
                    <div class="event-card reveal-up" style="--delay: {{ $delay }}s">
                        <div class="event-image">
                            @if($event->thumbnail_path)
                                <img src="{{ asset('storage/' . $event->thumbnail_path) }}" alt="{{ $event->title }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80" alt="{{ $event->title }}">
                            @endif
                            <div class="event-date">
                                <span class="day">{{ $event->date->format('d') }}</span>
                                <span class="month">{{ $event->date->format('M') }}</span>
                            </div>
                            <!-- Event Status Badge -->
                            @if($isUpcoming)
                                <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Upcoming
                                </div>
                            @else
                                <div class="absolute top-4 left-4 bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    Past Event
                                </div>
                            @endif
                        </div>
                        <div class="event-content">
                            <div class="event-meta">
                                <span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $event->date->format('M d, Y') }}
                                </span>
                                <span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ Str::limit($event->venue, 20) }}
                                </span>
                            </div>
                            <h3 class="event-title">{{ $event->title }}</h3>
                            <p class="event-description">{{ Str::limit(strip_tags($event->description), 100) }}</p>
                            <a href="{{ route('frontend.events.show', $event->id) }}" class="event-link">
                                Learn More
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- No Events Message -->
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 text-lg">No events scheduled at the moment. Check back soon!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12 reveal-up">
                <a href="#" class="btn-outline">
                    View All Events
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

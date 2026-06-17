<!-- Membership Categories Section -->
<section id="membership" class="py-24 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%), linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%); background-size: 60px 60px; background-position: 0 0, 30px 30px;"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Membership Options</span>
            <h2 class="section-title">Categories of Membership</h2>
            <p class="section-text">
                Choose the membership tier that best suits your professional and social aspirations
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach($membershipCategories as $index => $category)
            <div class="membership-card group reveal-up h-full" style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                <div class="relative h-full flex flex-col {{ $index === 0 ? 'bg-gradient-to-br from-accent via-accent-dark to-accent-dark border border-accent' : 'bg-dark-700 border border-accent/20 hover:border-accent/40' }} rounded-2xl p-8 hover:shadow-2xl {{ $index === 0 ? 'hover:shadow-accent/30' : 'hover:shadow-accent/10' }} transition-all duration-300 transform hover:-translate-y-2">
                    @if($category->badge_text)
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $index === 0 ? 'bg-white/20 text-white' : ($category->is_invite_only ? 'bg-amber-500/20 text-amber-400' : 'bg-accent/20 text-accent') }} backdrop-blur-sm">
                            {{ $category->badge_text }}
                        </span>
                    </div>
                    @endif
                    <h3 class="text-2xl font-bold text-white mb-3 mt-2">{{ $category->title }}</h3>
                    <div class="mb-6">
                        <div class="text-xs font-semibold uppercase tracking-wider {{ $index === 0 ? 'text-white/60' : 'text-gray-500' }} mb-1">Membership Fee</div>
                        <div class="text-4xl font-bold text-white mb-1">৳{{ number_format($category->price, 0) }}</div>
                        <div class="{{ $index === 0 ? 'text-white/80' : 'text-gray-400' }} text-sm mb-3">{{ $category->duration }} &bull; One-time</div>
                        @if($category->duration !== 'Lifetime' && $category->installment_price > 0)
                        <div class="border-t {{ $index === 0 ? 'border-white/20' : 'border-accent/20' }} pt-3">
                            <div class="text-xs font-semibold uppercase tracking-wider {{ $index === 0 ? 'text-white/60' : 'text-gray-500' }} mb-1">Installment Price</div>
                            <div class="text-2xl font-bold {{ $index === 0 ? 'text-white/90' : 'text-accent' }}">
                                ৳{{ number_format($category->installment_price, 0) }}
                                <span class="text-sm font-normal {{ $index === 0 ? 'text-white/70' : 'text-gray-400' }}">/ {{ $category->duration === 'Yearly' ? 'year' : 'month' }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($category->bio)
                    <p class="{{ $index === 0 ? 'text-white/80' : 'text-gray-300' }} text-sm mb-4">{{ $category->bio }}</p>
                    @endif
                    @if($category->features && count($category->features) > 0)
                    <ul class="space-y-3 mb-8 flex-grow">
                        @foreach($category->features as $feature)
                        <li class="flex items-start {{ $index === 0 ? 'text-white/90' : 'text-gray-300' }}">
                            <svg class="w-5 h-5 {{ $index === 0 ? 'text-white' : 'text-accent' }} mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="flex-grow"></div>
                    @endif
                    @if($category->is_invite_only)
                        <div class="block w-full text-center py-3 px-6 rounded-lg font-semibold bg-gray-600 text-gray-300 cursor-not-allowed">
                            Invite Only
                        </div>
                    @else
                        <a href="{{ route('membership.application.form', ['category' => $category->id]) }}" class="block w-full text-center py-3 px-6 rounded-lg font-semibold transition-all duration-300 {{ $index === 0 ? 'bg-white text-accent hover:bg-white/90' : 'bg-accent text-white hover:bg-accent-dark' }}">
                            Apply Now
                        </a>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

        <!-- CTA -->
        <div class="text-center mt-16 reveal-up">
            <a href="{{ route('membership.application.form') }}" class="btn-primary inline-flex items-center">
                Apply for Membership
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

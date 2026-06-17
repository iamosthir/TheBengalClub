<!-- Vision & Mission Section -->
@if($visionMission)
<section id="vision-mission" class="py-24 lg:py-32 bg-dark-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(15, 112, 191, 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Our Purpose</span>
            <h2 class="section-title">Vision & Mission</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto">
            <!-- Vision Card -->
            <div class="vision-card group reveal-left">
                <div class="relative bg-dark-700 border border-accent/20 rounded-2xl p-8 lg:p-10 hover:border-accent/40 transition-all duration-300 hover:shadow-xl hover:shadow-accent/10">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-accent/5 rounded-full blur-3xl group-hover:bg-accent/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-accent/10 text-accent mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Vision</h3>
                        <p class="text-gray-300 leading-relaxed text-lg">
                            {{ $visionMission->vision }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Mission Card -->
            <div class="mission-card group reveal-right">
                <div class="relative bg-dark-700 border border-accent/20 rounded-2xl p-8 lg:p-10 hover:border-accent/40 transition-all duration-300 hover:shadow-xl hover:shadow-accent/10">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-accent/5 rounded-full blur-3xl group-hover:bg-accent/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-accent/10 text-accent mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Mission</h3>
                        <div class="text-gray-300 leading-relaxed text-lg">
                            {!! nl2br(e($visionMission->mission)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

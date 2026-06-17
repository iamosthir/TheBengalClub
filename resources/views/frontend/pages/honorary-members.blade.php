@extends('frontend.layouts.master')

@section('title', 'Honorary Members')

@section('content')
<section class="min-h-screen pt-32 pb-20 px-4 relative overflow-hidden mt-30">

    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, rgba(15,112,191,0.4) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(15,112,191,0.3) 0%, transparent 50%);"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">

        {{-- Page Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Our Distinguished Members</span>
            <h1 class="section-title">Honorary Member Gallery</h1>
            <p class="section-text">
                Celebrating the remarkable individuals who have been conferred honorary membership in recognition of their outstanding contributions and distinguished service.
            </p>
        </div>

        @if($members->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 rounded-full bg-dark-700 border border-accent/20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <p class="text-gray-400">No honorary members listed yet.</p>
            </div>
        @else
        {{-- Gallery Grid --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($members as $index => $member)
            <div class="reveal-up group" style="animation-delay: {{ ($index % 8) * 0.08 }}s">
                <div class="relative bg-dark-700 border border-accent/15 rounded-2xl overflow-hidden hover:border-accent/40 hover:shadow-2xl hover:shadow-accent/10 transition-all duration-400 hover:-translate-y-2">

                    {{-- Photo --}}
                    <div class="relative overflow-hidden aspect-square bg-dark-800">
                        @if($member->photo_path)
                            <img src="{{ asset('storage/' . $member->photo_path) }}"
                                 alt="{{ $member->name }}"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Gradient overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-dark-900/90 via-transparent to-transparent"></div>
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <h3 class="text-white font-bold text-lg leading-tight mb-1 group-hover:text-accent transition-colors">
                            {{ $member->name }}
                        </h3>
                        @if(!empty($member->designation))
                            <div class="flex flex-col gap-0.5 mb-2">
                                @foreach((array) $member->designation as $role)
                                    @if(trim($role))
                                    <p class="text-accent text-sm font-medium leading-snug">{{ $role }}</p>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        @if($member->bio)
                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-3">{{ $member->bio }}</p>
                        @endif
                    </div>

                    {{-- Top accent line --}}
                    <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-accent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>
@endsection

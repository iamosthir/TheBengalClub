@extends('frontend.layouts.master')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 pt-32 pb-20 bg-dark-900">
    <div class="w-full max-w-lg text-center">

        {{-- Icon --}}
        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 rounded-full bg-accent/10 border border-accent/20 flex items-center justify-center">
                <svg class="w-12 h-12 text-accent/60" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
            </div>
        </div>

        {{-- Heading --}}
        <h1 class="text-3xl lg:text-4xl font-bold text-white mb-3">Member Not Found</h1>

        @if(!empty($searchId))
            <p class="text-gray-400 text-lg mb-8">
                No member matching <span class="text-accent font-semibold">{{ $searchId }}</span> exists in our records.
            </p>
        @else
            <p class="text-gray-400 text-lg mb-8">
                We couldn't find a member matching your search.
            </p>
        @endif

        {{-- Search again --}}
        <form action="{{ route('member.search') }}" method="GET"
              class="flex gap-3 mb-8 max-w-sm mx-auto">
            <input type="search"
                   name="id"
                   value="{{ $searchId ?? '' }}"
                   placeholder="Member ID or Phone"
                   class="flex-1 bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-accent transition-colors">
            <button type="submit"
                    class="px-5 py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-xl transition-colors">
                Search
            </button>
        </form>

        {{-- Back home --}}
        <a href="{{ route('frontend.index') }}"
           class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Back to Home
        </a>

    </div>
</div>
@endsection

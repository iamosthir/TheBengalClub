@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-16 px-4 mt-5">
    <div class="max-w-4xl mx-auto">

        {{-- Back --}}
        <div class="mb-6">
            <a href="{{ route('member.dashboard') }}"
               class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl px-4 py-3 mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl px-4 py-3 mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6">
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <span class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                Investment Plan
            </h1>
            <p class="text-gray-400 text-sm mt-2 ml-13">Join a savings circle. Pay monthly, win the pot!</p>
        </div>

        {{-- Samiti Cards --}}
        @forelse($samitis as $samiti)
        @php $joined = in_array($samiti->id, $joinedIds); @endphp
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-4 hover:border-white/20 transition-colors">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h2 class="text-lg font-semibold text-white">{{ $samiti->name }}</h2>
                        @if($joined)
                            <span class="text-xs bg-green-500/15 text-green-400 border border-green-500/30 rounded-full px-2 py-0.5">Joined</span>
                        @endif
                    </div>
                    @if($samiti->description)
                        <p class="text-gray-400 text-sm mb-3">{{ $samiti->description }}</p>
                    @endif
                    <div class="flex flex-wrap gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Monthly</span>
                            <span class="text-yellow-400 font-bold ml-1">৳{{ number_format($samiti->monthly_amount, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Cycles</span>
                            <span class="text-white ml-1">{{ $samiti->total_cycles }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Members</span>
                            <span class="text-white ml-1">{{ $samiti->active_members_count }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 shrink-0">
                    @if($joined)
                        <a href="{{ route('member.tan-samiti.show', $samiti) }}"
                           class="px-4 py-2 rounded-xl bg-accent text-white text-sm font-medium hover:bg-accent/80 transition-colors">
                            View Details
                        </a>
                    @else
                        <form action="{{ route('member.tan-samiti.join', $samiti) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 rounded-xl bg-yellow-500 text-black text-sm font-semibold hover:bg-yellow-400 transition-colors">
                                Join Samiti
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-12 text-center">
            <div class="text-gray-500 text-4xl mb-3">🪙</div>
            <p class="text-gray-400">No active Tan Samiti available right now.</p>
        </div>
        @endforelse

    </div>
</section>
@endsection

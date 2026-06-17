@extends("frontend.layouts.master")

@section('page_title', 'Create Your Investment Plan')

@section("content")
<section class="min-h-screen pt-28 pb-16 px-4 mt-5">
    <div class="max-w-2xl mx-auto">

        {{-- Back --}}
        <div class="mb-6">
            <a href="{{ route('member.tan-samiti.index') }}"
               class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Investment Plans
            </a>
        </div>

        {{-- Header --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6">
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <span class="w-10 h-10 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </span>
                Create Your Own Plan
            </h1>
            <p class="text-gray-400 text-sm mt-2 ml-13">
                This is a <span class="text-purple-300 font-medium">private</span> plan — only you can see and pay into it.
            </p>
        </div>

        @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3 mb-6">
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-red-400 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('member.tan-samiti.store') }}" method="POST"
              class="bg-dark-800 rounded-2xl border border-white/10 p-6 space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Plan Name <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="255"
                       placeholder="e.g. My Savings Plan 2026"
                       class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors">
            </div>

            {{-- Amount --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Monthly Amount (BDT) <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-lg font-bold text-yellow-400 select-none">৳</span>
                    <input type="number" name="monthly_amount" value="{{ old('monthly_amount') }}" required min="500" step="1"
                           placeholder="500"
                           class="w-full bg-dark-900 border border-white/10 rounded-xl pl-9 pr-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors">
                </div>
                <p class="text-gray-500 text-xs mt-1.5">Minimum ৳500. You can set any amount at or above this.</p>
            </div>

            {{-- Duration --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Duration <span class="text-red-400">*</span>
                </label>
                <select name="total_cycles" required
                        class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent transition-colors">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ (int) old('total_cycles', 6) === $m ? 'selected' : '' }}>
                            {{ $m }} {{ $m === 1 ? 'month' : 'months' }}
                        </option>
                    @endfor
                </select>
                <p class="text-gray-500 text-xs mt-1.5">You'll pay this monthly amount once per month for the chosen number of months.</p>
            </div>

            {{-- Start date --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Start Date <span class="text-gray-500 font-normal">(optional)</span>
                </label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" min="{{ now()->toDateString() }}"
                       class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-accent transition-colors">
                <p class="text-gray-500 text-xs mt-1.5">Leave empty to start today. The first installment is due on this date.</p>
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Note <span class="text-gray-500 font-normal">(optional)</span>
                </label>
                <textarea name="description" rows="3" maxlength="2000"
                          placeholder="What is this plan for?"
                          class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-yellow-500 text-black text-base font-bold hover:bg-yellow-400 transition-colors">
                Create Plan
            </button>
        </form>

    </div>
</section>
@endsection

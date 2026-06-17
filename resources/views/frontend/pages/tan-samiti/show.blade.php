@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-16 px-4 mt-5">
    <div class="max-w-3xl mx-auto">

        {{-- Back --}}
        <div class="mb-6">
            <a href="{{ route('member.tan-samiti.index') }}"
               class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Tan Samiti
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
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $tanSamiti->name }}</h1>
                    @if($tanSamiti->description)
                        <p class="text-gray-400 text-sm mt-1">{{ $tanSamiti->description }}</p>
                    @endif
                </div>
                @if($membership)
                    <span class="text-xs bg-green-500/15 text-green-400 border border-green-500/30 rounded-full px-3 py-1 shrink-0 mt-1">Joined</span>
                @endif
            </div>
            <div class="grid grid-cols-3 gap-3 mt-4 pt-4 border-t border-white/5">
                <div class="text-center">
                    <div class="text-yellow-400 font-bold text-lg">৳{{ number_format($tanSamiti->monthly_amount, 2) }}</div>
                    <div class="text-gray-500 text-xs">Monthly</div>
                </div>
                <div class="text-center">
                    <div class="text-white font-bold text-lg">{{ $tanSamiti->total_cycles }}</div>
                    <div class="text-gray-500 text-xs">Total Cycles</div>
                </div>
                <div class="text-center">
                    <div class="text-white font-bold text-lg">{{ $draws->count() }}</div>
                    <div class="text-gray-500 text-xs">Draws Done</div>
                </div>
            </div>
        </div>

        @if(!$membership)
        {{-- Not a member: show T&C modal trigger --}}
        <div class="bg-dark-800 rounded-2xl border border-yellow-500/20 p-6 mb-6 text-center">
            <p class="text-gray-400 mb-4">You are not a member of this Tan Samiti yet.</p>
            <button type="button" onclick="openTermsModal()"
                    class="px-6 py-2 rounded-xl bg-yellow-500 text-black font-semibold hover:bg-yellow-400 transition-colors">
                Join Samiti
            </button>
        </div>
        @else
        {{-- Download agreement --}}
        <div class="mb-4 flex justify-end">
            <a href="{{ route('member.tan-samiti.agreement-pdf', $tanSamiti) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/5 border border-white/10
                      text-gray-300 hover:border-white/20 hover:text-white text-sm font-medium transition-all">
                <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Download Agreement PDF
            </a>
        </div>

        {{-- My Installments --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6">
            <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                My Installments
            </h2>

            @if($myInstallments->isEmpty())
                <p class="text-gray-500 text-sm text-center py-4">No installments assigned yet. Admin will generate them soon.</p>
            @else
            <div class="space-y-3">
                @foreach($myInstallments as $inst)
                @php
                    [$statusLabel, $statusClasses] = match(true) {
                        $inst->isCompleted()        => ['Paid',             'bg-green-500/15 text-green-400 border border-green-500/30'],
                        $inst->isPaymentSubmitted() => ['Pending Approval', 'bg-yellow-400/15 text-yellow-400 border border-yellow-400/30'],
                        $inst->isOverdue()          => ['Overdue',          'bg-red-500/15 text-red-400 border border-red-500/30'],
                        default                     => ['Upcoming',         'bg-white/5 text-gray-400 border border-white/10'],
                    };
                @endphp
                <div class="bg-dark-700 rounded-xl border border-white/5 p-4">
                    <div class="flex items-center gap-3">
                        {{-- Left: cycle + date --}}
                        <div class="flex-1 min-w-0">
                            <div class="text-white font-medium">Cycle #{{ $inst->cycle_number }}</div>
                            <div class="text-gray-400 text-xs mt-0.5">Due: {{ $inst->due_date->format('d M Y') }}</div>
                        </div>
                        {{-- Amount + status --}}
                        <div class="text-right shrink-0">
                            <div class="text-white font-bold">৳{{ number_format($inst->amount, 2) }}</div>
                            <span class="inline-block text-xs px-2 py-0.5 rounded-full mt-0.5 {{ $statusClasses }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                        {{-- Pay button --}}
                        @if($inst->isPending() && !$inst->isPaymentSubmitted())
                        <button type="button"
                                onclick="openPaymentModal({{ $inst->id }}, 'Cycle #{{ $inst->cycle_number }}', '{{ number_format($inst->amount, 2) }}')"
                                class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2
                                       @if($inst->isOverdue()) bg-red-500 hover:bg-red-600 shadow-red-500/20
                                       @else bg-accent hover:bg-accent-dark shadow-accent/20 @endif
                                       text-white text-sm font-semibold rounded-xl transition-all shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Pay Now
                        </button>
                        @elseif($inst->isPaymentSubmitted())
                        <span class="shrink-0 inline-flex items-center gap-1 text-xs text-yellow-400 font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Awaiting
                        </span>
                        @endif
                    </div>
                    @if($inst->isCompleted() && $inst->paid_at)
                    <div class="mt-2 pt-2 border-t border-white/5 text-xs text-green-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Paid on {{ $inst->paid_at->format('d M Y, h:i A') }}
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

        @endif {{-- end membership check --}}

        {{-- Draw / Winner History --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
            <h2 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                Draw Winners
            </h2>

            @if($draws->isEmpty())
                <p class="text-gray-500 text-sm text-center py-4">No draws have taken place yet.</p>
            @else
            <div class="space-y-2">
                @foreach($draws as $draw)
                @php $isMe = $draw->user_id === auth()->id(); @endphp
                <div class="flex items-center gap-3 bg-dark-700 rounded-xl border {{ $isMe ? 'border-yellow-500/40' : 'border-white/5' }} p-3">
                    <div class="w-9 h-9 rounded-full bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center shrink-0">
                        <span class="text-yellow-400 text-xs font-bold">#{{ $draw->cycle_number }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-white font-medium text-sm flex items-center gap-1">
                            {{ $draw->user->name }}
                            @if($isMe)
                                <span class="text-xs text-yellow-400 font-normal">(You 🎉)</span>
                            @endif
                        </div>
                        <div class="text-gray-500 text-xs">{{ $draw->drawn_at->format('d M Y') }}</div>
                    </div>
                    <div class="text-yellow-400 font-bold text-sm">
                        ৳{{ number_format($tanSamiti->monthly_amount * $tanSamiti->total_cycles, 2) }}
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</section>

{{-- ===================== TERMS & CONDITIONS MODAL ===================== --}}
@if(!$membership)
<div id="terms-modal" class="fixed inset-0 z-50" style="display:none">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeTermsModal()"></div>

    <div class="absolute inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div id="terms-panel"
             class="relative bg-dark-800 border border-white/10 rounded-t-3xl sm:rounded-2xl w-full sm:max-w-2xl max-h-[90vh] flex flex-col
                    opacity-0 scale-95 transition-all duration-300">

            {{-- Handle (mobile) --}}
            <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0">
                <div class="w-10 h-1 bg-white/20 rounded-full"></div>
            </div>

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10 shrink-0">
                <div>
                    <h3 class="text-white font-bold text-lg">Investment Plan — সদস্য চুক্তিপত্র</h3>
                    <p class="text-gray-400 text-sm">Legal Membership Agreement</p>
                </div>
                <button type="button" onclick="closeTermsModal()"
                        class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-gray-400 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Scrollable body --}}
            <div class="px-6 py-5 overflow-y-auto flex-1">

                {{-- Samiti info strip --}}
                <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-xl px-4 py-3 mb-5 flex flex-wrap gap-4">
                    <div>
                        <div class="text-gray-400 text-xs">Samiti</div>
                        <div class="text-white font-semibold text-sm">{{ $tanSamiti->name }}</div>
                    </div>
                    <div>
                        <div class="text-gray-400 text-xs">Monthly Amount</div>
                        <div class="text-yellow-400 font-bold text-sm">৳{{ number_format($tanSamiti->monthly_amount, 2) }}</div>
                    </div>
                    <div>
                        <div class="text-gray-400 text-xs">Total Cycles</div>
                        <div class="text-white font-semibold text-sm">{{ $tanSamiti->total_cycles }}</div>
                    </div>
                </div>

                {{-- Clauses --}}
                <div class="space-y-3 text-sm">

                    @php
                    $clauses = [
                        ['bn' => '১. পরিচিতি', 'en' => 'Introduction',
                         'text_bn' => 'এই চুক্তি The Bengal Club এবং সদস্যের মধ্যে সম্পাদিত।',
                         'text_en' => 'This agreement is made between The Bengal Club and the member.'],
                        ['bn' => '২. সদস্যের দায়িত্ব', 'en' => 'Membership Obligation',
                         'text_bn' => 'সদস্যকে মাসিক চাঁদা প্রদান করতে হবে।',
                         'text_en' => 'The member must pay monthly subscription.'],
                        ['bn' => '৩. পেমেন্ট শর্ত', 'en' => 'Payment Terms',
                         'text_bn' => 'প্রতি মাসের ১০ তারিখের মধ্যে প্রদান করতে হবে। গ্রেস পিরিয়ড ৫ দিন।',
                         'text_en' => 'Due Date: 10th of each month | Grace period: 5 days.'],
                        ['bn' => '৪. নিরাপত্তা জামানত', 'en' => 'Security Deposit',
                         'text_bn' => 'বকেয়া থাকলে জামানত থেকে সমন্বয় করা হবে।',
                         'text_en' => 'Deposit will be adjusted if dues remain unpaid.'],
                        ['bn' => '৫. বকেয়া', 'en' => 'Non-Payment',
                         'text_bn' => '১ মাস: সতর্কবার্তা — ২ মাস: সাময়িক বহিষ্কার — ৩ মাস: সদস্যপদ বাতিল।',
                         'text_en' => '1 month: Warning — 2 months: Suspension — 3 months: Cancellation.'],
                        ['bn' => '৬. আইনি ব্যবস্থা', 'en' => 'Legal Action',
                         'text_bn' => 'বকেয়া টাকা বাংলাদেশ আইন অনুযায়ী আদায়যোগ্য।',
                         'text_en' => 'Unpaid dues are legally recoverable under Bangladesh law.'],
                        ['bn' => '৭. গ্যারান্টর', 'en' => 'Guarantor',
                         'text_bn' => 'সদস্যকে একজন গ্যারান্টর দিতে হতে পারে।',
                         'text_en' => 'Member may require a guarantor.'],
                        ['bn' => '৮. প্রস্থান নীতি', 'en' => 'Exit Policy',
                         'text_bn' => 'প্রস্থানের পূর্বে সমস্ত বকেয়া পরিশোধ করতে হবে।',
                         'text_en' => 'All dues must be cleared before exit.'],
                    ];
                    @endphp

                    @foreach($clauses as $clause)
                    <div class="bg-dark-700 rounded-xl border border-white/5 p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-yellow-400 font-semibold text-xs">{{ $clause['bn'] }}</span>
                            <span class="text-gray-600 text-xs">/</span>
                            <span class="text-gray-400 text-xs">{{ $clause['en'] }}</span>
                        </div>
                        <p class="text-white text-sm leading-relaxed">{{ $clause['text_bn'] }}</p>
                        <p class="text-gray-400 text-xs mt-1 leading-relaxed italic">{{ $clause['text_en'] }}</p>
                    </div>
                    @endforeach

                </div>

                {{-- Accept checkbox --}}
                <label class="flex items-start gap-3 mt-5 cursor-pointer group">
                    <input type="checkbox" id="terms-accept-checkbox"
                           onchange="onTermsCheckbox(this)"
                           class="mt-0.5 w-5 h-5 rounded border-2 border-white/20 bg-dark-700 accent-yellow-400 cursor-pointer shrink-0">
                    <span class="text-gray-300 text-sm leading-relaxed group-hover:text-white transition-colors">
                        আমি উপরোক্ত সকল শর্তাবলী পড়েছি এবং সম্মত আছি।<br>
                        <span class="text-gray-500 text-xs">I have read and agree to all the terms and conditions above.</span>
                    </span>
                </label>

            </div>

            {{-- Footer --}}
            <div class="px-6 pb-6 pt-3 border-t border-white/10 flex gap-3 shrink-0">
                <button type="button" onclick="closeTermsModal()"
                        class="flex-1 px-4 py-3 bg-dark-700 border border-white/10 text-gray-300 font-semibold rounded-xl hover:border-white/20 transition-all text-sm">
                    Cancel
                </button>
                <form id="join-form" action="{{ route('member.tan-samiti.join', $tanSamiti) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" id="terms-join-btn" disabled
                            class="w-full px-4 py-3 bg-yellow-500 text-black font-bold rounded-xl transition-all text-sm
                                   disabled:opacity-40 disabled:cursor-not-allowed hover:bg-yellow-400">
                        Join Samiti
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endif

{{-- ===================== PAYMENT MODAL ===================== --}}
@if($membership)
<div id="payment-modal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closePaymentModal()"></div>

    {{-- Panel --}}
    <div class="absolute inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div id="modal-panel"
             class="relative bg-dark-800 border border-white/10 rounded-t-3xl sm:rounded-2xl w-full sm:max-w-lg max-h-[90vh] overflow-y-auto
                    opacity-0 scale-95 transition-all duration-300">

            {{-- Handle (mobile only) --}}
            <div class="flex justify-center pt-3 pb-1 sm:hidden">
                <div class="w-10 h-1 bg-white/20 rounded-full"></div>
            </div>

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
                <div>
                    <h3 class="text-white font-bold text-lg" id="modal-title">Submit Payment</h3>
                    <p class="text-gray-400 text-sm" id="modal-subtitle"></p>
                </div>
                <button type="button" onclick="closePaymentModal()"
                        class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-gray-400 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-5">

                {{-- Amount reminder --}}
                <div class="flex items-center justify-between bg-accent/10 border border-accent/20 rounded-xl px-4 py-3">
                    <span class="text-gray-300 text-sm font-medium">Amount to Pay</span>
                    <span class="text-accent font-extrabold text-xl" id="modal-amount"></span>
                </div>

                {{-- Payment method cards --}}
                <div>
                    <p class="text-sm font-semibold text-gray-300 mb-3">Select Payment Method <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($paymentMethods as $method)
                        <label class="cursor-pointer">
                            <input type="radio" name="modal_payment_method" value="{{ $method->id }}"
                                   class="peer sr-only"
                                   data-instruction="{{ $method->instruction }}"
                                   data-wallet="{{ $method->wallet_number }}"
                                   data-qr="{{ $method->qr_image_path ? asset('storage/' . $method->qr_image_path) : '' }}">
                            <div class="flex flex-col items-center gap-2 p-3 bg-dark-700 border-2 border-white/10 rounded-xl transition-all
                                        peer-checked:border-accent peer-checked:bg-accent/5 hover:border-accent/40">
                                @if($method->logo_path)
                                    <img src="{{ asset('storage/' . $method->logo_path) }}"
                                         alt="{{ $method->name }}" class="w-10 h-10 object-contain">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-accent/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                @endif
                                <span class="text-white text-xs font-semibold text-center leading-tight">{{ $method->name }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Method info box --}}
                <div id="modal-method-info" class="hidden bg-dark-700 border border-accent/20 rounded-xl p-4 space-y-3">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">How to pay</p>
                            <p id="modal-instruction" class="text-gray-300 text-sm leading-relaxed whitespace-pre-line"></p>
                            <p id="modal-wallet-wrap" class="hidden mt-2">
                                <span class="text-xs text-gray-500">Wallet:</span>
                                <span id="modal-wallet" class="ml-1 text-accent font-mono font-bold text-sm"></span>
                                <button type="button" onclick="copyWalletNumber('modal-wallet', this)"
                                        class="ml-2 inline-flex items-center gap-1 px-2 py-0.5 text-xs rounded bg-accent/10 border border-accent/30 text-accent hover:bg-accent/20 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="copy-label">Copy</span>
                                </button>
                            </p>
                        </div>
                        <div id="modal-qr-wrap" class="hidden shrink-0 text-center">
                            <p class="text-xs text-gray-500 mb-1">Scan to pay</p>
                            <img id="modal-qr-img" src="" alt="QR"
                                 class="w-24 h-24 object-contain border border-accent/20 rounded-lg p-1 mx-auto">
                        </div>
                    </div>
                </div>

                {{-- Transaction ID --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Transaction ID <span class="text-red-500">*</span></label>
                    <input type="text" id="modal-txn-id" placeholder="Enter the transaction / reference ID"
                           class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent outline-none transition-all text-sm">
                    <p id="modal-txn-error" class="text-red-400 text-xs mt-1 hidden"></p>
                </div>

                {{-- Proof Screenshot --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Proof Screenshot <span class="text-red-500 text-xs font-normal">*</span>
                    </label>
                    <div id="modal-proof-area"
                         class="relative border-2 border-dashed border-white/15 rounded-xl p-5 text-center cursor-pointer hover:border-accent/50 transition-all bg-dark-700">
                        <input type="file" id="modal-proof-input" accept="image/png,image/jpeg,image/jpg"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div id="modal-proof-placeholder">
                            <svg class="w-8 h-8 text-gray-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 text-xs">Click to upload screenshot</p>
                        </div>
                        <div id="modal-proof-preview" class="hidden">
                            <img id="modal-proof-img" src="" alt="" class="max-h-28 mx-auto rounded-lg border border-accent/20">
                            <p id="modal-proof-name" class="text-gray-400 text-xs mt-1"></p>
                            <button type="button" id="modal-proof-remove"
                                    class="mt-1 text-red-400 hover:text-red-300 text-xs font-semibold">Remove</button>
                        </div>
                    </div>
                </div>

                {{-- Messages --}}
                <div id="modal-error" class="hidden bg-red-500/10 border border-red-500/30 rounded-xl p-3 text-red-400 text-sm"></div>
                <div id="modal-success" class="hidden bg-green-500/10 border border-green-500/30 rounded-xl p-3 text-green-400 text-sm"></div>

            </div>

            {{-- Footer --}}
            <div class="px-6 pb-6 pt-2 border-t border-white/10 flex gap-3">
                <button type="button" onclick="closePaymentModal()"
                        class="flex-1 px-4 py-3 bg-dark-700 border border-white/10 text-gray-300 font-semibold rounded-xl hover:border-white/20 transition-all text-sm">
                    Cancel
                </button>
                <button type="button" id="modal-submit-btn" onclick="submitPayment()"
                        class="flex-1 px-4 py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-xl transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Submit Payment
                </button>
            </div>

        </div>
    </div>
</div>
{{-- ===================== END MODAL ===================== --}}

@push('scripts')
<script>
let currentInstallmentId = null;

function openPaymentModal(installmentId, cycleLabel, amount) {
    currentInstallmentId = installmentId;

    document.getElementById('modal-title').textContent    = 'Submit Payment';
    document.getElementById('modal-subtitle').textContent = cycleLabel;
    document.getElementById('modal-amount').textContent   = '৳' + amount;
    document.getElementById('modal-txn-id').value         = '';
    document.getElementById('modal-txn-error').classList.add('hidden');
    document.getElementById('modal-error').classList.add('hidden');
    document.getElementById('modal-success').classList.add('hidden');
    document.getElementById('modal-method-info').classList.add('hidden');
    document.getElementById('modal-proof-input').value = '';
    document.getElementById('modal-proof-preview').classList.add('hidden');
    document.getElementById('modal-proof-placeholder').classList.remove('hidden');
    document.getElementById('modal-submit-btn').disabled = false;
    document.getElementById('modal-submit-btn').innerHTML = `
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg> Submit Payment`;
    document.querySelectorAll('input[name="modal_payment_method"]').forEach(r => r.checked = false);

    const modal = document.getElementById('payment-modal');
    const panel = document.getElementById('modal-panel');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
    });
    document.body.style.overflow = 'hidden';
}

function closePaymentModal() {
    const modal = document.getElementById('payment-modal');
    const panel = document.getElementById('modal-panel');
    panel.classList.remove('opacity-100', 'scale-100');
    panel.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 280);
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closePaymentModal(); });

// Payment method radio → show wallet/QR info
document.querySelectorAll('input[name="modal_payment_method"]').forEach(radio => {
    radio.addEventListener('change', () => {
        if (!radio.checked) return;
        const infoBox     = document.getElementById('modal-method-info');
        const instruction = radio.dataset.instruction || '';
        const wallet      = radio.dataset.wallet || '';
        const qr          = radio.dataset.qr || '';

        document.getElementById('modal-instruction').textContent =
            instruction || 'Send payment and enter your transaction ID below.';

        const walletWrap = document.getElementById('modal-wallet-wrap');
        if (wallet) {
            document.getElementById('modal-wallet').textContent = wallet;
            walletWrap.classList.remove('hidden');
        } else {
            walletWrap.classList.add('hidden');
        }

        const qrWrap = document.getElementById('modal-qr-wrap');
        if (qr) {
            document.getElementById('modal-qr-img').src = qr;
            qrWrap.classList.remove('hidden');
        } else {
            qrWrap.classList.add('hidden');
        }

        infoBox.classList.remove('hidden');
    });
});

// Proof file preview
document.getElementById('modal-proof-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    if (file.size > 5 * 1024 * 1024) { alert('File size must be less than 5MB.'); this.value = ''; return; }
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('modal-proof-img').src = e.target.result;
        document.getElementById('modal-proof-name').textContent = file.name;
        document.getElementById('modal-proof-placeholder').classList.add('hidden');
        document.getElementById('modal-proof-preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

document.getElementById('modal-proof-remove').addEventListener('click', function (e) {
    e.preventDefault(); e.stopPropagation();
    document.getElementById('modal-proof-input').value = '';
    document.getElementById('modal-proof-preview').classList.add('hidden');
    document.getElementById('modal-proof-placeholder').classList.remove('hidden');
});

// Copy wallet number
function copyWalletNumber(spanId, btn) {
    const text = document.getElementById(spanId).textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
        const label = btn.querySelector('.copy-label');
        label.textContent = 'Copied!';
        setTimeout(() => { label.textContent = 'Copy'; }, 2000);
    });
}

async function submitPayment() {
    const btn = document.getElementById('modal-submit-btn');

    const methodRadio = document.querySelector('input[name="modal_payment_method"]:checked');
    if (!methodRadio) { showModalError('Please select a payment method.'); return; }

    const txnId = document.getElementById('modal-txn-id').value.trim();
    if (!txnId) {
        document.getElementById('modal-txn-error').textContent = 'Transaction ID is required.';
        document.getElementById('modal-txn-error').classList.remove('hidden');
        document.getElementById('modal-txn-id').focus();
        return;
    }
    document.getElementById('modal-txn-error').classList.add('hidden');
    hideModalMessages();

    const proofFile = document.getElementById('modal-proof-input').files[0];
    if (!proofFile) { showModalError('Payment proof screenshot is required.'); return; }

    const formData = new FormData();
    formData.append('payment_method_id', methodRadio.value);
    formData.append('txn_id', txnId);
    formData.append('proof', proofFile);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('_token', csrfToken);

    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
    </svg> Submitting…`;

    try {
        const res  = await fetch(`/member/tan-samiti-installments/${currentInstallmentId}/submit-payment`, {
            method:      'POST',
            credentials: 'same-origin',
            headers:     { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body:        formData,
        });
        const data = await res.json();

        if (res.ok && data.success) {
            showModalSuccess(data.message);
            setTimeout(() => location.reload(), 1800);
        } else {
            showModalError(data.message || 'Something went wrong. Please try again.');
            btn.disabled = false;
            btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg> Submit Payment`;
        }
    } catch (err) {
        showModalError('Network error. Please try again.');
        btn.disabled = false;
    }
}

function showModalError(msg) {
    const el = document.getElementById('modal-error');
    el.textContent = msg;
    el.classList.remove('hidden');
    document.getElementById('modal-success').classList.add('hidden');
}

function showModalSuccess(msg) {
    const el = document.getElementById('modal-success');
    el.textContent = msg;
    el.classList.remove('hidden');
    document.getElementById('modal-error').classList.add('hidden');
}

function hideModalMessages() {
    document.getElementById('modal-error').classList.add('hidden');
    document.getElementById('modal-success').classList.add('hidden');
}
</script>
@endpush
@endif

@if(!$membership)
@push('scripts')
<script>
function openTermsModal() {
    const modal = document.getElementById('terms-modal');
    const panel = document.getElementById('terms-panel');
    modal.style.display = 'flex';
    modal.style.alignItems = 'flex-end';
    // On sm+ override to center
    if (window.innerWidth >= 640) {
        modal.style.alignItems = 'center';
    }
    requestAnimationFrame(() => {
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
    });
    document.body.style.overflow = 'hidden';
    // Reset checkbox
    document.getElementById('terms-accept-checkbox').checked = false;
    document.getElementById('terms-join-btn').disabled = true;
}

function closeTermsModal() {
    const modal = document.getElementById('terms-modal');
    const panel = document.getElementById('terms-panel');
    panel.classList.remove('opacity-100', 'scale-100');
    panel.classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }, 280);
}

function onTermsCheckbox(checkbox) {
    document.getElementById('terms-join-btn').disabled = !checkbox.checked;
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeTermsModal(); });
</script>
@endpush
@endif

@endsection

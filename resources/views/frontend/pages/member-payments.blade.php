@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-16 px-4 mt-5">
    <div class="max-w-3xl mx-auto">

        {{-- Back button --}}
        <div class="mb-6">
            <a href="{{ route('member.dashboard') }}"
               class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        @php
            $installments = $user->profile?->installments ?? collect();
            $paidCount    = $installments->where('status', 'completed')->count();
            $totalCount   = $installments->count();
        @endphp

        {{-- Page Header --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6" id="donate">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                        <span class="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center">
                            @if($isOptionalInstallment)
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            @else
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            @endif
                        </span>
                        {{ $isOptionalInstallment ? 'Donation History' : 'Payment Timeline' }}
                    </h1>
                    <p class="text-gray-400 text-sm mt-1 ml-13">
                        {{ $isOptionalInstallment ? 'Your voluntary contributions to The Bengal Club' : 'Your monthly membership fee history' }}
                    </p>
                </div>

                @if($isOptionalInstallment)
                <button type="button" onclick="openDonateModal()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-accent hover:bg-accent-dark text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-accent/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Donate
                </button>
                @elseif($totalCount > 0)
                <div class="flex flex-col items-end gap-1.5 sm:text-right">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-400 text-sm">{{ $paidCount }} / {{ $totalCount }} paid</span>
                        <span class="text-accent font-bold text-sm">
                            {{ $totalCount > 0 ? round($paidCount / $totalCount * 100) : 0 }}%
                        </span>
                    </div>
                    <div class="w-48 h-2.5 bg-dark-600 rounded-full overflow-hidden">
                        <div class="h-full bg-accent rounded-full transition-all"
                             style="width: {{ $totalCount > 0 ? ($paidCount / $totalCount * 100) : 0 }}%"></div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Stats row --}}
            @if($totalCount > 0)
            @php
                $pendingCount  = $installments->filter(fn($i) => $i->isPaymentSubmitted())->count();
                $overdueCount  = $isOptionalInstallment ? 0 : $installments->filter(fn($i) => $i->isOverdue() && !$i->isPaymentSubmitted())->count();
                $upcomingCount = $isOptionalInstallment ? 0 : ($totalCount - $paidCount - $pendingCount - $overdueCount);
            @endphp
            <div class="grid grid-cols-2 {{ $isOptionalInstallment ? 'sm:grid-cols-2' : 'sm:grid-cols-4' }} gap-3 mt-5 pt-5 border-t border-white/5">
                <div class="bg-green-500/5 border border-green-500/20 rounded-xl p-3 text-center">
                    <div class="text-green-400 font-bold text-xl">{{ $paidCount }}</div>
                    <div class="text-gray-400 text-xs mt-0.5">{{ $isOptionalInstallment ? 'Approved' : 'Paid' }}</div>
                </div>
                <div class="bg-yellow-400/5 border border-yellow-400/20 rounded-xl p-3 text-center">
                    <div class="text-yellow-400 font-bold text-xl">{{ $pendingCount }}</div>
                    <div class="text-gray-400 text-xs mt-0.5">Pending</div>
                </div>
                @if(!$isOptionalInstallment)
                <div class="bg-red-500/5 border border-red-500/20 rounded-xl p-3 text-center">
                    <div class="text-red-400 font-bold text-xl">{{ $overdueCount }}</div>
                    <div class="text-gray-400 text-xs mt-0.5">Overdue</div>
                </div>
                <div class="bg-dark-700 border border-white/5 rounded-xl p-3 text-center">
                    <div class="text-gray-300 font-bold text-xl">{{ $upcomingCount }}</div>
                    <div class="text-gray-400 text-xs mt-0.5">Upcoming</div>
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Legend --}}
        @if($totalCount > 0)
        <div class="flex flex-wrap gap-4 mb-5 text-xs text-gray-400 px-1">
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span> {{ $isOptionalInstallment ? 'Approved' : 'Paid' }}</span>
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-yellow-400 inline-block"></span> Awaiting Approval</span>
            @if(!$isOptionalInstallment)
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span> Overdue</span>
            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-gray-500 inline-block"></span> Upcoming</span>
            @endif
        </div>

        {{-- Timeline --}}
        <div class="relative">
            {{-- Vertical connecting line --}}
            <div class="absolute left-[18px] top-0 bottom-0 w-px bg-white/10"></div>

            <div class="space-y-1">
            @foreach($installments as $index => $inst)
                @php
                    $isLast      = $index === $installments->count() - 1;
                    $isCompleted = $inst->isCompleted();
                    $isSubmitted = $inst->isPaymentSubmitted();
                    // For optional members, records are donations — never treat as overdue
                    $isOverdue   = $isOptionalInstallment ? false : $inst->isOverdue();

                    if ($isCompleted) {
                        $dotColor   = 'bg-green-500';
                        $cardBorder = 'border-green-500/20';
                        $cardBg     = 'bg-green-500/5';
                    } elseif ($isSubmitted) {
                        $dotColor   = 'bg-yellow-400';
                        $cardBorder = 'border-yellow-400/30';
                        $cardBg     = 'bg-yellow-400/5';
                    } elseif ($isOverdue) {
                        $dotColor   = 'bg-red-500';
                        $cardBorder = 'border-red-500/30';
                        $cardBg     = 'bg-red-500/5';
                    } else {
                        $dotColor   = 'bg-gray-500';
                        $cardBorder = 'border-white/10';
                        $cardBg     = 'bg-dark-800';
                    }
                @endphp

                <div class="flex gap-4 {{ $isLast ? '' : 'pb-2' }}">
                    {{-- Dot --}}
                    <div class="relative shrink-0 flex flex-col items-center" style="width:38px;padding-top:18px;">
                        <div class="w-3 h-3 rounded-full {{ $dotColor }} z-10 ring-2 ring-dark-900 shadow-lg
                                    @if($isCompleted) shadow-green-500/30 @elseif($isSubmitted) shadow-yellow-400/30 @elseif($isOverdue) shadow-red-500/30 @endif">
                        </div>
                    </div>

                    {{-- Card --}}
                    <div class="flex-1 mb-3 rounded-2xl border {{ $cardBorder }} {{ $cardBg }} p-5"
                         id="installment-row-{{ $inst->id }}">
                        <div class="flex flex-wrap items-start justify-between gap-4">

                            {{-- Left: details --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="text-white font-bold">
                                        {{ $isOptionalInstallment ? $inst->due_date->format('M j, Y') : $inst->due_date->format('F Y') }}
                                    </span>
                                    <span class="text-gray-500 text-xs bg-dark-700 rounded-full px-2 py-0.5">
                                        #{{ $inst->installment_number }}
                                    </span>
                                    @if($isOverdue && !$isSubmitted && !$isCompleted)
                                        <span class="text-xs bg-red-500/15 text-red-400 border border-red-500/20 rounded-full px-2 py-0.5 font-medium">
                                            {{ (int) $inst->due_date->diffInDays(now()) }}d overdue
                                        </span>
                                    @endif
                                </div>

                                <div class="text-accent font-extrabold text-2xl leading-tight mb-1">
                                    ৳{{ number_format($inst->amount, 2) }}
                                </div>

                                <div class="text-gray-500 text-xs">
                                    {{ $isOptionalInstallment ? 'Donated' : 'Due' }}: {{ $inst->due_date->format('M j, Y') }}
                                </div>

                                @if($isCompleted)
                                    <div class="flex items-center gap-1.5 mt-3 text-green-400 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span class="font-medium">
                                            {{ $isOptionalInstallment ? 'Approved' : 'Paid' }} on {{ $inst->paid_at?->format('M j, Y') }}
                                        </span>
                                    </div>
                                @elseif($isSubmitted)
                                    <div class="mt-3 bg-yellow-400/5 border border-yellow-400/20 rounded-xl p-3">
                                        <div class="flex items-center gap-2 text-yellow-400 text-sm font-medium mb-1.5">
                                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                            </svg>
                                            Awaiting admin approval
                                        </div>
                                        <div class="text-xs text-gray-400 space-y-0.5">
                                            @if($inst->memberPaymentMethod)
                                                <div>Method: <span class="text-white">{{ $inst->memberPaymentMethod->name }}</span></div>
                                            @endif
                                            <div>TXN ID: <span class="text-white font-mono">{{ $inst->member_txn_id }}</span></div>
                                            @if($inst->member_submitted_at)
                                                <div>Submitted: {{ $inst->member_submitted_at->format('M j, Y H:i') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Right: badge + action --}}
                            <div class="flex flex-col items-end gap-3 shrink-0">
                                @if($isCompleted)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-500/15 border border-green-500/30 text-green-400 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ $isOptionalInstallment ? 'Approved' : 'Paid' }}
                                    </span>
                                @elseif($isSubmitted)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-yellow-400/15 border border-yellow-400/30 text-yellow-400 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Pending Review
                                    </span>
                                @elseif($isOverdue)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-red-500/15 border border-red-500/30 text-red-400 text-xs font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Overdue
                                    </span>
                                    <button type="button"
                                            onclick="openPaymentModal({{ $inst->id }}, '{{ $inst->due_date->format('F Y') }}', '{{ number_format($inst->amount, 2) }}')"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-red-500/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        Pay Now
                                    </button>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-500/15 border border-gray-500/30 text-gray-400 text-xs font-semibold">
                                        Upcoming
                                    </span>
                                    <button type="button"
                                            onclick="openPaymentModal({{ $inst->id }}, '{{ $inst->due_date->format('F Y') }}', '{{ number_format($inst->amount, 2) }}')"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-accent hover:bg-accent-dark text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-accent/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        Pay Now
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        @else
        {{-- No records yet --}}
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-12 text-center">
            <div class="w-16 h-16 rounded-2xl bg-dark-700 border border-white/10 flex items-center justify-center mx-auto mb-4">
                @if($isOptionalInstallment)
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                @else
                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                @endif
            </div>
            @if($isOptionalInstallment)
            <p class="text-gray-300 font-semibold mb-1">No donations yet</p>
            <p class="text-gray-500 text-sm mb-5">Your membership has no mandatory fees. Click below to make a voluntary donation.</p>
            <button type="button" onclick="openDonateModal()"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-accent/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Make a Donation
            </button>
            @else
            <p class="text-gray-300 font-semibold mb-1">No installments yet</p>
            <p class="text-gray-500 text-sm">Your payment schedule will appear here once your membership is activated.</p>
            @endif
        </div>
        @endif

    </div>
</section>

{{-- ===================== PAYMENT MODAL ===================== --}}
<div id="payment-modal" class="fixed inset-0 z-50 hidden">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closePaymentModal()"></div>

    {{-- Panel --}}
    <div class="absolute inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div id="modal-panel"
             class="relative bg-dark-800 border border-white/10 rounded-t-3xl sm:rounded-2xl w-full sm:max-w-lg max-h-[90vh] overflow-y-auto
                    opacity-0 scale-95 transition-all duration-300">

            {{-- Handle (mobile) --}}
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

                {{-- Payment methods --}}
                <div>
                    <p class="text-sm font-semibold text-gray-300 mb-3">Select Payment Method <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-3 gap-3" id="modal-payment-methods">
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
                            <img id="modal-qr-img" src="" alt="QR" class="w-24 h-24 object-contain border border-accent/20 rounded-lg p-1 mx-auto">
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

                {{-- Payment Proof --}}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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

@if($isOptionalInstallment)
{{-- ===================== DONATE MODAL ===================== --}}
<div id="donate-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeDonateModal()"></div>
    <div class="absolute inset-0 flex items-end sm:items-center justify-center p-0 sm:p-4">
        <div id="donate-modal-panel"
             class="relative bg-dark-800 border border-white/10 rounded-t-3xl sm:rounded-2xl w-full sm:max-w-lg max-h-[90vh] overflow-y-auto
                    opacity-0 scale-95 transition-all duration-300">

            <div class="flex justify-center pt-3 pb-1 sm:hidden">
                <div class="w-10 h-1 bg-white/20 rounded-full"></div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
                <div>
                    <h3 class="text-white font-bold text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Make a Donation
                    </h3>
                    <p class="text-gray-400 text-sm mt-0.5">Support The Bengal Club voluntarily</p>
                </div>
                <button type="button" onclick="closeDonateModal()"
                        class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-gray-400 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-5">

                {{-- Amount input --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Donation Amount (৳) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="donate-amount" min="1" step="1" placeholder="Enter amount"
                           class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent outline-none transition-all text-sm">
                    <p id="donate-amount-error" class="text-red-400 text-xs mt-1 hidden"></p>
                </div>

                {{-- Payment methods --}}
                <div>
                    <p class="text-sm font-semibold text-gray-300 mb-3">Select Payment Method <span class="text-red-500">*</span></p>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($paymentMethods as $method)
                            <label class="cursor-pointer">
                                <input type="radio" name="donate_payment_method" value="{{ $method->id }}"
                                       class="peer sr-only donate-method-radio"
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
                    <p id="donate-method-error" class="text-red-400 text-xs mt-1 hidden"></p>
                </div>

                {{-- Method info --}}
                <div id="donate-method-info" class="hidden bg-dark-700 border border-accent/20 rounded-xl p-4 space-y-3">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">How to pay</p>
                            <p id="donate-instruction" class="text-gray-300 text-sm leading-relaxed whitespace-pre-line"></p>
                            <p id="donate-wallet-wrap" class="hidden mt-2">
                                <span class="text-xs text-gray-500">Wallet:</span>
                                <span id="donate-wallet" class="ml-1 text-accent font-mono font-bold text-sm"></span>
                                <button type="button" onclick="copyWalletNumber('donate-wallet', this)"
                                        class="ml-2 inline-flex items-center gap-1 px-2 py-0.5 text-xs rounded bg-accent/10 border border-accent/30 text-accent hover:bg-accent/20 transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="copy-label">Copy</span>
                                </button>
                            </p>
                        </div>
                        <div id="donate-qr-wrap" class="hidden shrink-0 text-center">
                            <p class="text-xs text-gray-500 mb-1">Scan to pay</p>
                            <img id="donate-qr-img" src="" alt="QR" class="w-24 h-24 object-contain border border-accent/20 rounded-lg p-1 mx-auto">
                        </div>
                    </div>
                </div>

                {{-- Transaction ID --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Transaction ID <span class="text-red-500">*</span></label>
                    <input type="text" id="donate-txn-id" placeholder="Enter the transaction / reference ID"
                           class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent outline-none transition-all text-sm">
                    <p id="donate-txn-error" class="text-red-400 text-xs mt-1 hidden"></p>
                </div>

                {{-- Payment Proof --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Proof Screenshot <span class="text-red-500 text-xs font-normal">*</span>
                    </label>
                    <div id="donate-proof-area"
                         class="relative border-2 border-dashed border-white/15 rounded-xl p-5 text-center cursor-pointer hover:border-accent/50 transition-all bg-dark-700">
                        <input type="file" id="donate-proof-input" accept="image/png,image/jpeg,image/jpg"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div id="donate-proof-placeholder">
                            <svg class="w-8 h-8 text-gray-500 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 text-xs">Click to upload screenshot</p>
                        </div>
                        <div id="donate-proof-preview" class="hidden">
                            <img id="donate-proof-img" src="" alt="" class="max-h-28 mx-auto rounded-lg border border-accent/20">
                            <p id="donate-proof-name" class="text-gray-400 text-xs mt-1"></p>
                            <button type="button" id="donate-proof-remove"
                                    class="mt-1 text-red-400 hover:text-red-300 text-xs font-semibold">Remove</button>
                        </div>
                    </div>
                    <p id="donate-proof-error" class="text-red-400 text-xs mt-1 hidden"></p>
                </div>

                {{-- Messages --}}
                <div id="donate-error" class="hidden bg-red-500/10 border border-red-500/30 rounded-xl p-3 text-red-400 text-sm"></div>
                <div id="donate-success" class="hidden bg-green-500/10 border border-green-500/30 rounded-xl p-3 text-green-400 text-sm"></div>

            </div>

            <div class="px-6 pb-6 pt-2 border-t border-white/10 flex gap-3">
                <button type="button" onclick="closeDonateModal()"
                        class="flex-1 px-4 py-3 bg-dark-700 border border-white/10 text-gray-300 font-semibold rounded-xl hover:border-white/20 transition-all text-sm">
                    Cancel
                </button>
                <button type="button" id="donate-submit-btn" onclick="submitDonation()"
                        class="flex-1 px-4 py-3 bg-accent hover:bg-accent-dark text-white font-semibold rounded-xl transition-all text-sm disabled:opacity-50 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Submit Donation
                </button>
            </div>
        </div>
    </div>
</div>
{{-- ===================== END DONATE MODAL ===================== --}}

<script>
function openDonateModal() {
    document.getElementById('donate-amount').value = '';
    document.getElementById('donate-txn-id').value = '';
    document.getElementById('donate-proof-input').value = '';
    document.getElementById('donate-proof-preview').classList.add('hidden');
    document.getElementById('donate-proof-placeholder').classList.remove('hidden');
    document.getElementById('donate-method-info').classList.add('hidden');
    document.getElementById('donate-error').classList.add('hidden');
    document.getElementById('donate-success').classList.add('hidden');
    document.getElementById('donate-amount-error').classList.add('hidden');
    document.getElementById('donate-method-error').classList.add('hidden');
    document.getElementById('donate-txn-error').classList.add('hidden');
    document.getElementById('donate-proof-error').classList.add('hidden');
    document.getElementById('donate-submit-btn').disabled = false;
    document.querySelectorAll('input[name="donate_payment_method"]').forEach(r => r.checked = false);

    const modal = document.getElementById('donate-modal');
    const panel = document.getElementById('donate-modal-panel');
    modal.classList.remove('hidden');
    requestAnimationFrame(() => {
        panel.classList.remove('opacity-0', 'scale-95');
        panel.classList.add('opacity-100', 'scale-100');
    });
    document.body.style.overflow = 'hidden';
}

function closeDonateModal() {
    const modal = document.getElementById('donate-modal');
    const panel = document.getElementById('donate-modal-panel');
    panel.classList.remove('opacity-100', 'scale-100');
    panel.classList.add('opacity-0', 'scale-95');
    setTimeout(() => { modal.classList.add('hidden'); document.body.style.overflow = ''; }, 280);
}

document.querySelectorAll('.donate-method-radio').forEach(radio => {
    radio.addEventListener('change', () => {
        if (!radio.checked) return;
        const infoBox = document.getElementById('donate-method-info');
        document.getElementById('donate-instruction').textContent =
            radio.dataset.instruction || 'Send payment and enter your transaction ID below.';
        const walletWrap = document.getElementById('donate-wallet-wrap');
        if (radio.dataset.wallet) {
            document.getElementById('donate-wallet').textContent = radio.dataset.wallet;
            walletWrap.classList.remove('hidden');
        } else { walletWrap.classList.add('hidden'); }
        const qrWrap = document.getElementById('donate-qr-wrap');
        if (radio.dataset.qr) {
            document.getElementById('donate-qr-img').src = radio.dataset.qr;
            qrWrap.classList.remove('hidden');
        } else { qrWrap.classList.add('hidden'); }
        infoBox.classList.remove('hidden');
    });
});

document.getElementById('donate-proof-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    if (file.size > 5 * 1024 * 1024) { alert('File size must be less than 5MB.'); this.value = ''; return; }
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('donate-proof-img').src = e.target.result;
        document.getElementById('donate-proof-name').textContent = file.name;
        document.getElementById('donate-proof-placeholder').classList.add('hidden');
        document.getElementById('donate-proof-preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

document.getElementById('donate-proof-remove').addEventListener('click', function (e) {
    e.preventDefault(); e.stopPropagation();
    document.getElementById('donate-proof-input').value = '';
    document.getElementById('donate-proof-preview').classList.add('hidden');
    document.getElementById('donate-proof-placeholder').classList.remove('hidden');
});

// Auto-open modal if arriving via #donate anchor
if (window.location.hash === '#donate') { openDonateModal(); }

async function submitDonation() {
    const btn = document.getElementById('donate-submit-btn');
    let valid = true;

    const amount = document.getElementById('donate-amount').value.trim();
    if (!amount || parseFloat(amount) < 1) {
        document.getElementById('donate-amount-error').textContent = 'Please enter a valid amount.';
        document.getElementById('donate-amount-error').classList.remove('hidden');
        valid = false;
    } else { document.getElementById('donate-amount-error').classList.add('hidden'); }

    const methodRadio = document.querySelector('input[name="donate_payment_method"]:checked');
    if (!methodRadio) {
        document.getElementById('donate-method-error').textContent = 'Please select a payment method.';
        document.getElementById('donate-method-error').classList.remove('hidden');
        valid = false;
    } else { document.getElementById('donate-method-error').classList.add('hidden'); }

    const txnId = document.getElementById('donate-txn-id').value.trim();
    if (!txnId) {
        document.getElementById('donate-txn-error').textContent = 'Transaction ID is required.';
        document.getElementById('donate-txn-error').classList.remove('hidden');
        valid = false;
    } else { document.getElementById('donate-txn-error').classList.add('hidden'); }

    const proofFile = document.getElementById('donate-proof-input').files[0];
    if (!proofFile) {
        document.getElementById('donate-proof-error').textContent = 'Payment proof screenshot is required.';
        document.getElementById('donate-proof-error').classList.remove('hidden');
        valid = false;
    } else { document.getElementById('donate-proof-error').classList.add('hidden'); }

    if (!valid) return;

    document.getElementById('donate-error').classList.add('hidden');
    document.getElementById('donate-success').classList.add('hidden');

    const formData = new FormData();
    formData.append('amount', amount);
    formData.append('payment_method_id', methodRadio.value);
    formData.append('txn_id', txnId);
    formData.append('proof', proofFile);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('_token', csrfToken);

    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Submitting…`;

    try {
        const res  = await fetch('{{ route("member.donate") }}', {
            method:      'POST',
            credentials: 'same-origin',
            headers:     { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body:        formData,
        });
        const data = await res.json();

        if (res.ok && data.success) {
            document.getElementById('donate-success').textContent = data.message;
            document.getElementById('donate-success').classList.remove('hidden');
            btn.disabled = true;
            btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Submitted`;
            setTimeout(() => { closeDonateModal(); window.location.reload(); }, 2000);
        } else {
            document.getElementById('donate-error').textContent = data.message || 'Something went wrong. Please try again.';
            document.getElementById('donate-error').classList.remove('hidden');
            btn.disabled = false;
            btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> Submit Donation`;
        }
    } catch (err) {
        document.getElementById('donate-error').textContent = 'Network error. Please try again.';
        document.getElementById('donate-error').classList.remove('hidden');
        btn.disabled = false;
        btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> Submit Donation`;
    }
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDonateModal(); });
</script>
@endif

<script>
let currentInstallmentId = null;

function openPaymentModal(installmentId, monthLabel, amount) {
    currentInstallmentId = installmentId;

    document.getElementById('modal-title').textContent = 'Submit Payment';
    document.getElementById('modal-subtitle').textContent = monthLabel;
    document.getElementById('modal-amount').textContent = '৳' + amount;
    document.getElementById('modal-txn-id').value = '';
    document.getElementById('modal-txn-error').classList.add('hidden');
    document.getElementById('modal-error').classList.add('hidden');
    document.getElementById('modal-success').classList.add('hidden');
    document.getElementById('modal-method-info').classList.add('hidden');
    document.getElementById('modal-proof-input').value = '';
    document.getElementById('modal-proof-preview').classList.add('hidden');
    document.getElementById('modal-proof-placeholder').classList.remove('hidden');
    document.getElementById('modal-submit-btn').disabled = false;
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

// ── Copy wallet number to clipboard ─────────────────────────────────────────
function copyWalletNumber(spanId, btn) {
    const text = document.getElementById(spanId).textContent.trim();
    navigator.clipboard.writeText(text).then(function () {
        const label = btn.querySelector('.copy-label');
        label.textContent = 'Copied!';
        setTimeout(function () { label.textContent = 'Copy'; }, 2000);
    });
}

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

    const formData = new FormData();
    formData.append('payment_method_id', methodRadio.value);
    formData.append('txn_id', txnId);
    const proofFile = document.getElementById('modal-proof-input').files[0];
    if (!proofFile) { showModalError('Payment proof screenshot is required.'); return; }
    formData.append('proof', proofFile);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    formData.append('_token', csrfToken);

    btn.disabled = true;
    btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Submitting…`;

    try {
        const res  = await fetch(`/member/installments/${currentInstallmentId}/submit-payment`, {
            method:      'POST',
            credentials: 'same-origin',
            headers:     { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body:        formData,
        });
        const data = await res.json();

        if (res.ok && data.success) {
            showModalSuccess(data.message);
            updateInstallmentRow(currentInstallmentId);
            setTimeout(() => closePaymentModal(), 1800);
        } else {
            showModalError(data.message || 'Something went wrong. Please try again.');
            btn.disabled = false;
            btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Submit Payment`;
        }
    } catch (err) {
        showModalError('Network error. Please try again.');
        btn.disabled = false;
        btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Submit Payment`;
    }
}

function updateInstallmentRow(id) {
    const row = document.getElementById('installment-row-' + id);
    if (!row) return;

    // Re-style card border + bg
    row.className = row.className
        .replace(/border-red-500\/30|border-white\/10/g, 'border-yellow-400/30')
        .replace(/bg-red-500\/5|bg-dark-800/g, 'bg-yellow-400/5');

    // Replace action column
    const actionsDiv = row.querySelector('.flex.flex-col.items-end');
    if (actionsDiv) {
        actionsDiv.innerHTML = `
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-yellow-400/15 border border-yellow-400/30 text-yellow-400 text-xs font-semibold">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Pending Review
            </span>`;
    }

    // Update dot
    const dot = row.closest('.flex.gap-4')?.querySelector('.rounded-full.ring-2');
    if (dot) {
        dot.className = dot.className.replace(/bg-red-500|bg-gray-500/g, 'bg-yellow-400');
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
@endsection

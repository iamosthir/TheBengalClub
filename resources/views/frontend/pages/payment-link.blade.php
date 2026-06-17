@extends('frontend.layouts.master')

@section('page_title', 'Pay ৳' . number_format($paymentLink->amount, 2))

@section('content')

<section class="pt-32 pb-20 px-4 relative">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-accent/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-accent/4 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-2xl mx-auto relative z-10">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-accent/10 border border-accent/20 mb-4">
                <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-1">Payment Request</h1>
            <p class="text-gray-400">Hello <span class="text-white font-semibold">{{ $paymentLink->name }}</span></p>
        </div>

        {{-- Amount card --}}
        <div class="bg-gradient-to-br from-accent/15 to-accent/5 border border-accent/30 rounded-2xl p-6 mb-6 text-center">
            <p class="text-gray-300 text-sm mb-1">Amount Due</p>
            <p class="text-4xl font-bold text-white">৳{{ number_format($paymentLink->amount, 2) }}</p>
            @if($paymentLink->purpose)
                <p class="text-gray-400 text-sm mt-2">{{ $paymentLink->purpose }}</p>
            @endif
        </div>

        {{-- Flash --}}
        @if(session('success'))
        <div class="mb-6 bg-green-500/10 border border-green-500/30 rounded-2xl p-5 flex items-start gap-3">
            <svg class="w-6 h-6 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-green-300 font-semibold">Payment Submitted!</p>
                <p class="text-green-400/80 text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-2xl p-5 text-red-300 text-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- States --}}
        @if($paymentLink->isVerified())
            <div class="bg-dark-800 border border-green-500/30 rounded-2xl p-8 text-center">
                <svg class="w-14 h-14 text-green-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="text-xl font-bold text-white mb-1">Payment Confirmed</h2>
                <p class="text-gray-400 text-sm">This payment has been received and verified. Thank you!</p>
            </div>
        @elseif($paymentLink->isCanceled())
            <div class="bg-dark-800 border border-red-500/30 rounded-2xl p-8 text-center">
                <svg class="w-14 h-14 text-red-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
                <h2 class="text-xl font-bold text-white mb-1">Link No Longer Active</h2>
                <p class="text-gray-400 text-sm">This payment link has been canceled. Please contact us if you have questions.</p>
            </div>
        @else
            @if($paymentLink->isSubmitted())
            <div class="mb-6 bg-yellow-500/10 border border-yellow-500/30 rounded-2xl p-4 text-yellow-200/90 text-sm flex items-start gap-2">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>We have received your payment and it is under review. If you need to correct it, you can re-submit below.</span>
            </div>
            @endif

            <form action="{{ route('payment-link.submit', $paymentLink->token) }}" method="POST" enctype="multipart/form-data" id="payment-form">
                @csrf

                @if($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-2xl p-5">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-400 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="bg-dark-800 border border-white/10 rounded-2xl p-6 mb-5">
                    <h2 class="text-white font-bold text-lg mb-5">Payment Details</h2>

                    @if($paymentMethods->isEmpty())
                        <p class="text-gray-500 text-sm text-center py-4">No payment methods available at the moment. Please contact us.</p>
                    @else
                    <p class="text-sm text-gray-400 mb-3">Select a payment method, send the amount, then submit your transaction details:</p>
                    <div class="grid grid-cols-1 gap-3 mb-5">
                        @foreach($paymentMethods as $method)
                        <label class="payment-method-card cursor-pointer block">
                            <input type="radio" name="payment_method_id" value="{{ $method->id }}"
                                   class="sr-only peer" {{ old('payment_method_id') == $method->id ? 'checked' : '' }}
                                   required>
                            <div class="flex items-center gap-4 p-4 rounded-xl border border-white/10 bg-dark-900 peer-checked:border-accent peer-checked:bg-accent/5 hover:border-accent/40 transition-all duration-200">
                                <div class="w-12 h-12 rounded-xl bg-dark-700 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    @if($method->logo_path)
                                        <img src="{{ asset('storage/' . $method->logo_path) }}" alt="{{ $method->name }}" class="w-10 h-10 object-contain">
                                    @else
                                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-semibold">{{ $method->name }}</p>
                                    @if($method->wallet_number)
                                        <p class="text-gray-400 text-sm">{{ $method->wallet_number }}</p>
                                    @endif
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 border-white/20 peer-checked:border-accent peer-checked:bg-accent flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            @if($method->qr_image_path || $method->instruction)
                            <div class="method-qr-{{ $method->id }} hidden mt-2 p-3 bg-dark-900 border border-accent/20 rounded-xl flex items-center gap-4">
                                @if($method->qr_image_path)
                                <img src="{{ asset('storage/' . $method->qr_image_path) }}" alt="QR Code" class="w-24 h-24 rounded-lg border border-accent/20">
                                @endif
                                <div>
                                    <p class="text-white font-semibold text-sm">{{ $method->name }}</p>
                                    @if($method->wallet_number)
                                        <p class="text-accent text-sm font-mono mt-1">{{ $method->wallet_number }}</p>
                                    @endif
                                    @if($method->instruction)
                                        <p class="text-gray-400 text-xs mt-1">{{ $method->instruction }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </label>
                        @endforeach
                    </div>

                    {{-- Transaction ID --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Transaction / Reference ID <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="transaction_id"
                               class="w-full bg-dark-900 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 font-mono focus:outline-none focus:border-accent transition-colors"
                               placeholder="e.g. TXN123456789"
                               value="{{ old('transaction_id') }}" required>
                    </div>

                    {{-- Payment Proof --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Payment Screenshot <span class="text-red-400">*</span>
                        </label>
                        <div id="proof-upload-area"
                             class="relative border-2 border-dashed border-accent/20 rounded-2xl p-8 text-center cursor-pointer hover:border-accent/50 transition-all duration-300 bg-dark-900">
                            <input type="file" id="payment_proof" name="payment_proof"
                                   accept="image/png,image/jpeg,image/jpg"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                            <div id="proof-placeholder" class="flex flex-col items-center pointer-events-none">
                                <div class="w-14 h-14 rounded-2xl bg-accent/10 border border-accent/20 flex items-center justify-center mb-3">
                                    <svg class="w-7 h-7 text-accent/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-300 font-medium mb-1">Upload payment screenshot</p>
                                <p class="text-gray-500 text-sm">PNG or JPG, max 5MB</p>
                            </div>
                            <div id="proof-preview" class="hidden flex flex-col items-center pointer-events-none">
                                <img id="proof-preview-img" src="" alt="Preview" class="max-h-40 rounded-xl border border-accent/20 mb-2">
                                <p id="proof-file-name" class="text-gray-400 text-sm"></p>
                                <button type="button" id="proof-remove"
                                        class="mt-2 text-red-400 hover:text-red-300 text-xs font-semibold pointer-events-auto z-20 relative">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($paymentMethods->isNotEmpty())
                <button type="submit" id="submit-btn"
                        class="w-full btn-primary py-4 text-lg font-bold rounded-xl flex items-center justify-center gap-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Submit Payment of ৳{{ number_format($paymentLink->amount, 2) }}
                </button>
                <p class="text-gray-500 text-xs text-center mt-3">
                    Your payment will be reviewed and confirmed shortly.
                </p>
                @endif
            </form>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
// ---- Payment method QR / instruction toggle ----
document.querySelectorAll('input[name="payment_method_id"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('[class*="method-qr-"]').forEach(el => el.classList.add('hidden'));
        const panel = document.querySelector('.method-qr-' + this.value);
        if (panel) panel.classList.remove('hidden');
    });
});

// ---- Payment proof upload ----
const proofInput       = document.getElementById('payment_proof');
const proofPlaceholder = document.getElementById('proof-placeholder');
const proofPreview     = document.getElementById('proof-preview');
const proofImg         = document.getElementById('proof-preview-img');
const proofName        = document.getElementById('proof-file-name');

if (proofInput) {
    proofInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        if (file.size > 5 * 1024 * 1024) {
            alert('File size must be less than 5MB.');
            this.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = e => {
            proofImg.src = e.target.result;
            proofName.textContent = file.name;
            proofPlaceholder.classList.add('hidden');
            proofPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('proof-remove').addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        proofInput.value = '';
        proofImg.src = '';
        proofPlaceholder.classList.remove('hidden');
        proofPreview.classList.add('hidden');
    });
}
</script>
@endpush

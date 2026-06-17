@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-20 px-4">
    <div class="max-w-4xl mx-auto">

        {{-- Back --}}
        <a href="{{ route('shop') }}"
           class="inline-flex items-center gap-2 text-gray-400 hover:text-accent text-sm mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Shop
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Order Form --}}
            <div class="lg:col-span-2">
                <h1 class="text-2xl font-bold text-white mb-6">Place Your Order</h1>

                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li class="text-red-400 text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('shop.order.place', $product) }}" method="POST" enctype="multipart/form-data"
                      class="space-y-6">
                    @csrf

                    {{-- Customer Info --}}
                    <div class="bg-dark-800 border border-white/10 rounded-2xl p-6">
                        <h2 class="text-white font-bold mb-5 flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Customer Information
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="full_name"
                                       value="{{ old('full_name', $user?->name) }}"
                                       class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                              focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all
                                              @error('full_name') border-red-500 @enderror"
                                       placeholder="Enter your full name" required>
                                @error('full_name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email"
                                       value="{{ old('email', $user?->email) }}"
                                       class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                              focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all
                                              @error('email') border-red-500 @enderror"
                                       placeholder="your@email.com" required>
                                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Phone <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="phone"
                                       value="{{ old('phone', $user?->profile?->mobile) }}"
                                       class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                              focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all
                                              @error('phone') border-red-500 @enderror"
                                       placeholder="+880..." required>
                                @error('phone')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Addresses --}}
                    <div class="bg-dark-800 border border-white/10 rounded-2xl p-6">
                        <h2 class="text-white font-bold mb-5 flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Addresses
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Billing Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="billing_address" rows="3"
                                          class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                                 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all resize-none
                                                 @error('billing_address') border-red-500 @enderror"
                                          placeholder="House, Road, Area, City..." required>{{ old('billing_address', $user?->profile?->address) }}</textarea>
                                @error('billing_address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="same-address" class="accent-accent cursor-pointer">
                                <label for="same-address" class="text-sm text-gray-400 cursor-pointer">
                                    Shipping address same as billing
                                </label>
                            </div>
                            <div id="shipping-address-field">
                                <label class="block text-sm font-medium text-gray-300 mb-2">
                                    Shipping Address <span class="text-red-500">*</span>
                                </label>
                                <textarea name="shipping_address" id="shipping-address" rows="3"
                                          class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                                 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all resize-none
                                                 @error('shipping_address') border-red-500 @enderror"
                                          placeholder="Delivery address (if different)..." required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Payment --}}
                    <div class="bg-dark-800 border border-white/10 rounded-2xl p-6">
                        <h2 class="text-white font-bold mb-5 flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Payment
                        </h2>

                        {{-- Method selection --}}
                        <p class="text-sm text-gray-400 mb-3">Select payment method <span class="text-red-500">*</span></p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5">
                            @foreach($paymentMethods as $method)
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method_id" value="{{ $method->id }}"
                                           class="peer sr-only"
                                           data-instruction="{{ $method->instruction }}"
                                           data-wallet="{{ $method->wallet_number }}"
                                           data-qr="{{ $method->qr_image_path ? asset('storage/' . $method->qr_image_path) : '' }}"
                                           {{ old('payment_method_id') == $method->id ? 'checked' : '' }}>
                                    <div class="flex flex-col items-center gap-2 p-4 bg-dark-700 border-2 border-white/10 rounded-xl
                                                transition-all peer-checked:border-accent peer-checked:bg-accent/5 hover:border-accent/40">
                                        @if($method->logo_path)
                                            <img src="{{ asset('storage/' . $method->logo_path) }}"
                                                 alt="{{ $method->name }}" class="w-14 h-14 object-contain">
                                        @else
                                            <div class="w-14 h-14 rounded-full bg-accent/20 flex items-center justify-center">
                                                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="text-white text-xs font-semibold text-center">{{ $method->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('payment_method_id')<p class="text-red-400 text-xs mb-4">{{ $message }}</p>@enderror

                        {{-- Instruction box --}}
                        <div id="payment-info-box"
                             class="hidden bg-dark-700 border border-accent/20 rounded-xl p-4 mb-5 space-y-3">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1">
                                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">How to pay</p>
                                    <p id="payment-instruction" class="text-gray-300 text-sm leading-relaxed whitespace-pre-line"></p>
                                    <p id="payment-wallet-wrap" class="hidden mt-2">
                                        <span class="text-xs text-gray-500">Wallet:</span>
                                        <span id="payment-wallet" class="ml-1 text-accent font-mono font-bold text-sm"></span>
                                        <button type="button" onclick="copyWalletNumber('payment-wallet', this)"
                                                class="ml-2 inline-flex items-center gap-1 px-2 py-0.5 text-xs rounded bg-accent/10 border border-accent/30 text-accent hover:bg-accent/20 transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="copy-label">Copy</span>
                                        </button>
                                    </p>
                                </div>
                                <div id="payment-qr-wrap" class="hidden shrink-0 text-center">
                                    <p class="text-xs text-gray-500 mb-1">Scan to pay</p>
                                    <img id="payment-qr-img" src="" alt="QR"
                                         class="w-28 h-28 object-contain border border-accent/20 rounded-lg p-1 mx-auto">
                                </div>
                            </div>
                        </div>

                        {{-- TXN ID --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Transaction ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                                   class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500
                                          focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all
                                          @error('transaction_id') border-red-500 @enderror"
                                   placeholder="Enter the transaction / reference ID" required>
                            @error('transaction_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Payment Proof --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">
                                Payment Screenshot
                                <span class="text-red text-xs font-normal">*</span>
                            </label>
                            <div id="proof-area"
                                 class="relative border-2 border-dashed border-white/15 rounded-xl p-6 text-center
                                        cursor-pointer hover:border-accent/50 transition-all bg-dark-700">
                                <input type="file" name="payment_proof" id="proof-input" accept="image/png,image/jpeg,image/jpg"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div id="proof-placeholder">
                                    <svg class="w-8 h-8 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Click to upload screenshot</p>
                                    <p class="text-gray-600 text-xs mt-1">PNG, JPG — Max 5MB</p>
                                </div>
                                <div id="proof-preview" class="hidden">
                                    <img id="proof-img" src="" alt="" class="max-h-32 mx-auto rounded-lg border border-accent/20 mb-2">
                                    <p id="proof-name" class="text-gray-400 text-xs"></p>
                                    <button type="button" id="proof-remove"
                                            class="mt-1 text-red-400 hover:text-red-300 text-xs font-semibold relative z-20">
                                        Remove
                                    </button>
                                </div>
                            </div>
                            @error('payment_proof')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <button type="submit"
                            class="btn-primary w-full py-4 text-base flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Confirm Order
                    </button>
                </form>
            </div>

            {{-- Order Summary Sidebar --}}
            <div class="lg:col-span-1">
                <div class="sticky top-28">
                    <div class="bg-dark-800 border border-white/10 rounded-2xl overflow-hidden">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}"
                                 alt="{{ $product->title }}"
                                 class="w-full object-cover" style="max-height:200px;">
                        @endif
                        <div class="p-5">
                            <h3 class="text-white font-bold text-lg mb-1">{{ $product->title }}</h3>
                            @if($product->description)
                                <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                            @endif
                            <div class="space-y-2 border-t border-white/5 pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Product Price</span>
                                    <span class="text-white font-medium">৳{{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">Delivery</span>
                                    <span class="text-white font-medium">
                                        @if($product->delivery_charge > 0)
                                            ৳{{ number_format($product->delivery_charge, 2) }}
                                        @else
                                            <span class="text-green-400">Free</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between text-base font-bold border-t border-white/5 pt-2 mt-2">
                                    <span class="text-white">Total</span>
                                    <span class="text-accent text-xl">
                                        ৳{{ number_format($product->price + $product->delivery_charge, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
// ── Same address checkbox ────────────────────────────────────────────────────
document.getElementById('same-address').addEventListener('change', function() {
    const billingVal = document.querySelector('[name="billing_address"]').value;
    const shippingField = document.getElementById('shipping-address-field');
    const shippingInput = document.getElementById('shipping-address');
    if (this.checked) {
        shippingInput.value = billingVal;
        shippingField.style.opacity = '0.5';
        shippingInput.readOnly = true;
    } else {
        shippingField.style.opacity = '1';
        shippingInput.readOnly = false;
    }
});

document.querySelector('[name="billing_address"]').addEventListener('input', function() {
    if (document.getElementById('same-address').checked) {
        document.getElementById('shipping-address').value = this.value;
    }
});

// ── Copy wallet number to clipboard ─────────────────────────────────────────
function copyWalletNumber(spanId, btn) {
    const text = document.getElementById(spanId).textContent.trim();
    navigator.clipboard.writeText(text).then(function () {
        const label = btn.querySelector('.copy-label');
        label.textContent = 'Copied!';
        setTimeout(function () { label.textContent = 'Copy'; }, 2000);
    });
}

// ── Payment method info ──────────────────────────────────────────────────────
document.querySelectorAll('input[name="payment_method_id"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        if (!this.checked) return;
        const box        = document.getElementById('payment-info-box');
        const instruction = this.dataset.instruction || '';
        const wallet     = this.dataset.wallet || '';
        const qr         = this.dataset.qr || '';

        document.getElementById('payment-instruction').textContent =
            instruction || 'Send payment and enter your transaction ID below.';

        const walletWrap = document.getElementById('payment-wallet-wrap');
        if (wallet) {
            document.getElementById('payment-wallet').textContent = wallet;
            walletWrap.classList.remove('hidden');
        } else {
            walletWrap.classList.add('hidden');
        }

        const qrWrap = document.getElementById('payment-qr-wrap');
        if (qr) {
            document.getElementById('payment-qr-img').src = qr;
            qrWrap.classList.remove('hidden');
        } else {
            qrWrap.classList.add('hidden');
        }

        box.classList.remove('hidden');
    });

    // Trigger on page load if already checked (validation fail repopulate)
    if (radio.checked) radio.dispatchEvent(new Event('change'));
});

// ── Proof upload preview ─────────────────────────────────────────────────────
document.getElementById('proof-input').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    if (file.size > 5 * 1024 * 1024) { alert('File must be under 5MB.'); this.value = ''; return; }
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('proof-img').src = e.target.result;
        document.getElementById('proof-name').textContent = file.name;
        document.getElementById('proof-placeholder').classList.add('hidden');
        document.getElementById('proof-preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

document.getElementById('proof-remove').addEventListener('click', function(e) {
    e.preventDefault(); e.stopPropagation();
    document.getElementById('proof-input').value = '';
    document.getElementById('proof-preview').classList.add('hidden');
    document.getElementById('proof-placeholder').classList.remove('hidden');
});
</script>
@endsection

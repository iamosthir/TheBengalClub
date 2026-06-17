@extends('frontend.layouts.master')

@php
    $activeCategory = $categories->firstWhere('id', $activeCategoryId);
    $metaTitle       = $activeCategory ? $activeCategory->name . ' — Donate' : 'Donate';
    $metaDescription = $activeCategory?->description
        ? Str::limit(strip_tags($activeCategory->description), 160)
        : 'Make a donation to Bengal Club and help us build a stronger community. Every contribution makes a difference.';
    $metaImage = $activeCategory?->image_path
        ? asset('storage/' . $activeCategory->image_path)
        : null;
    $pageUrl = url()->current() . ($activeCategoryId ? '?category=' . $activeCategoryId : '');
@endphp

@section('page_title', $metaTitle)

@push('head_meta')
    <meta name="description" content="{{ $metaDescription }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ $pageUrl }}">
    <meta property="og:title"       content="{{ $metaTitle }} — {{ $siteSetting?->site_name ?? 'The Bengal Club' }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    @if($metaImage)
    <meta property="og:image"       content="{{ $metaImage }}">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    @endif
    @if($siteSetting?->site_name)
    <meta property="og:site_name"   content="{{ $siteSetting->site_name }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="{{ $metaImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title"       content="{{ $metaTitle }} — {{ $siteSetting?->site_name ?? 'The Bengal Club' }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    @if($metaImage)
    <meta name="twitter:image"       content="{{ $metaImage }}">
    @endif

    <link rel="canonical" href="{{ $pageUrl }}">
@endpush

@section('content')

{{-- ===================== CATEGORY HERO BANNER ===================== --}}
@if($categories->isNotEmpty())
<div id="category-hero" class="relative w-full overflow-hidden mt-30" style="height:460px;">
    {{-- Background image layers (one per category) --}}
    @foreach($categories as $cat)
    <div class="category-bg absolute inset-0 transition-opacity duration-700"
         data-cat-id="{{ $cat->id }}"
         style="opacity:{{ $cat->id == $activeCategoryId ? '1' : '0' }};
                background-image:url('{{ $cat->image_path ? asset('storage/'.$cat->image_path) : '' }}');
                background-size:cover;background-position:center;">
    </div>
    @endforeach

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-dark-900/70 via-dark-900/50 to-dark-900"></div>

    {{-- Hero text (one per category) --}}
    <div class="relative z-10 h-full flex flex-col items-center justify-center text-center px-4 pt-24">
        @foreach($categories as $cat)
        <div class="category-info transition-all duration-500"
             data-cat-id="{{ $cat->id }}"
             style="display:{{ $cat->id == $activeCategoryId ? 'block' : 'none' }}">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-accent/20 border border-accent/40 mb-3">
                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $cat->name }}</h1>
            @if($cat->description)
            <p class="text-gray-300 max-w-xl mx-auto text-sm md:text-base leading-relaxed">
                {{ Str::limit($cat->description, 160) }}
            </p>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Category Tab Switcher --}}
    <div class="absolute bottom-0 left-0 right-0 z-20">
        <div class="flex justify-center px-4 pb-0">
            <div class="flex gap-2 bg-dark-800/80 backdrop-blur border border-white/10 rounded-t-2xl px-4 py-3 overflow-x-auto max-w-full">
                @foreach($categories as $cat)
                <button type="button"
                        class="category-tab flex-shrink-0 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 whitespace-nowrap
                               {{ $cat->id == $activeCategoryId ? 'bg-accent text-white' : 'text-gray-400 hover:text-white hover:bg-white/10' }}"
                        data-cat-id="{{ $cat->id }}">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
@else
{{-- Fallback header when no categories --}}
<div class="pt-32 pb-6 text-center px-4">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-accent/10 border border-accent/20 mb-4">
        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
    </div>
    <h1 class="text-4xl font-bold text-white mb-3">Make a Donation</h1>
    <p class="text-gray-400 max-w-md mx-auto">Your generosity helps us build a stronger community.</p>
</div>
@endif

{{-- ===================== FORM SECTION ===================== --}}
<section class="pb-20 px-4 relative">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-accent/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-accent/4 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-2xl mx-auto relative z-10 pt-8">

        {{-- Success / Error Flash --}}
        @if(session('success'))
        <div class="mb-8 bg-green-500/10 border border-green-500/30 rounded-2xl p-5 flex items-start gap-3">
            <svg class="w-6 h-6 text-green-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-green-300 font-semibold">Donation Submitted!</p>
                <p class="text-green-400/80 text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <form action="{{ route('donate.submit') }}" method="POST" enctype="multipart/form-data" id="donation-form">
            @csrf

            {{-- Hidden category id --}}
            <input type="hidden" name="donation_category_id" id="donation-category-id"
                   value="{{ old('donation_category_id', $activeCategoryId) }}">

            @if($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/30 rounded-2xl p-5">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="text-red-400 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- STEP 1: Donation Amount --}}
            <div class="bg-dark-800 border border-white/10 rounded-2xl p-6 mb-5">
                <h2 class="text-white font-bold text-lg mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-accent/20 text-accent text-sm font-bold flex items-center justify-center">1</span>
                    Donation Amount
                </h2>

                {{-- Quick amount buttons --}}
                <div class="grid grid-cols-4 gap-3 mb-4">
                    @foreach([500, 1000, 5000, 10000] as $preset)
                    <button type="button"
                            class="quick-amount-btn py-3 rounded-xl border border-accent/30 text-accent font-semibold text-sm hover:bg-accent hover:text-white hover:border-accent transition-all duration-200"
                            data-amount="{{ $preset }}">
                        ৳{{ number_format($preset) }}
                    </button>
                    @endforeach
                </div>

                {{-- Amount input --}}
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl font-bold text-accent select-none">৳</span>
                    <input type="number" name="amount" id="amount-input"
                           class="w-full bg-dark-900 border @error('amount') border-red-500 @else border-white/10 @enderror rounded-2xl pl-12 pr-5 py-5 text-3xl font-bold text-white placeholder-gray-600 focus:outline-none focus:border-accent transition-colors"
                           placeholder="0" min="1"
                           value="{{ old('amount') }}" required>
                </div>
                @error('amount')<p class="text-red-400 text-sm mt-2">{{ $message }}</p>@enderror
                <p class="text-gray-500 text-xs mt-2 text-center">Minimum donation: ৳1 BDT</p>
            </div>

            {{-- STEP 2: Donor Info --}}
            <div class="bg-dark-800 border border-white/10 rounded-2xl p-6 mb-5">
                <h2 class="text-white font-bold text-lg mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-accent/20 text-accent text-sm font-bold flex items-center justify-center">2</span>
                    Your Information
                </h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Full Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="full_name"
                               class="w-full bg-dark-900 border @error('full_name') border-red-500 @else border-white/10 @enderror rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                               placeholder="Enter your full name"
                               value="{{ old('full_name') }}" required>
                        @error('full_name')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Email Address <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email"
                               class="w-full bg-dark-900 border @error('email') border-red-500 @else border-white/10 @enderror rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                               placeholder="your@email.com"
                               value="{{ old('email') }}" required>
                        @error('email')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- STEP 3: Payment --}}
            <div class="bg-dark-800 border border-white/10 rounded-2xl p-6 mb-5">
                <h2 class="text-white font-bold text-lg mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-accent/20 text-accent text-sm font-bold flex items-center justify-center">3</span>
                    Payment Details
                </h2>

                @if($paymentMethods->isEmpty())
                    <p class="text-gray-500 text-sm text-center py-4">No payment methods available at the moment.</p>
                @else
                <p class="text-sm text-gray-400 mb-3">Select a payment method:</p>
                <div class="grid grid-cols-1 gap-3 mb-5" id="payment-methods-list">
                    @foreach($paymentMethods as $method)
                    <label class="payment-method-card cursor-pointer block">
                        <input type="radio" name="payment_method_id" value="{{ $method->id }}"
                               class="sr-only peer" {{ old('payment_method_id') == $method->id ? 'checked' : '' }}
                               required>
                        <div class="flex items-center gap-4 p-4 rounded-xl border border-white/10 bg-dark-900 peer-checked:border-accent peer-checked:bg-accent/5 hover:border-accent/40 transition-all duration-200">
                            <div class="w-12 h-12 rounded-xl bg-dark-700 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($method->logo_path)
                                    <img src="{{ asset('storage/' . $method->logo_path) }}" alt="{{ $method->name }}"
                                         class="w-10 h-10 object-contain">
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
                                @if($method->instruction)
                                    <p class="text-gray-500 text-xs mt-0.5 truncate">{{ $method->instruction }}</p>
                                @endif
                            </div>
                            @if($method->qr_image_path)
                            <div class="flex-shrink-0 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <img src="{{ asset('storage/' . $method->qr_image_path) }}" alt="QR"
                                     class="w-14 h-14 rounded-lg border border-accent/20">
                            </div>
                            @endif
                            <div class="w-5 h-5 rounded-full border-2 border-white/20 peer-checked:border-accent peer-checked:bg-accent flex items-center justify-center flex-shrink-0">
                                <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @if($method->qr_image_path)
                        <div class="method-qr-{{ $method->id }} hidden mt-2 p-3 bg-dark-900 border border-accent/20 rounded-xl flex items-center gap-4">
                            <img src="{{ asset('storage/' . $method->qr_image_path) }}" alt="QR Code"
                                 class="w-24 h-24 rounded-lg border border-accent/20">
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
                @error('payment_method_id')<p class="text-red-400 text-sm mb-4">{{ $message }}</p>@enderror

                {{-- Transaction ID --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Transaction / Reference ID <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="transaction_id"
                           class="w-full bg-dark-900 border @error('transaction_id') border-red-500 @else border-white/10 @enderror rounded-xl px-4 py-3 text-white placeholder-gray-500 font-mono focus:outline-none focus:border-accent transition-colors"
                           placeholder="e.g. TXN123456789"
                           value="{{ old('transaction_id') }}" required>
                    @error('transaction_id')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Payment Proof --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                        Payment Screenshot <span class="text-red-400">*</span>
                    </label>
                    <div id="proof-upload-area"
                         class="relative border-2 border-dashed @error('payment_proof') border-red-500/50 @else border-accent/20 @enderror rounded-2xl p-8 text-center cursor-pointer hover:border-accent/50 transition-all duration-300 bg-dark-900">
                        <input type="file" id="payment_proof" name="payment_proof"
                               accept="image/png,image/jpeg,image/jpg"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                               required>
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
                            <img id="proof-preview-img" src="" alt="Preview"
                                 class="max-h-40 rounded-xl border border-accent/20 mb-2">
                            <p id="proof-file-name" class="text-gray-400 text-sm"></p>
                            <button type="button" id="proof-remove"
                                    class="mt-2 text-red-400 hover:text-red-300 text-xs font-semibold pointer-events-auto z-20 relative">
                                Remove
                            </button>
                        </div>
                    </div>
                    @error('payment_proof')<p class="text-red-400 text-sm mt-2">{{ $message }}</p>@enderror
                </div>
                @endif
            </div>

            {{-- Summary & Submit --}}
            <div class="bg-gradient-to-br from-accent/10 to-accent/5 border border-accent/20 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-gray-300 font-medium">Donation Amount</span>
                    <span class="text-2xl font-bold text-white">৳<span id="summary-value">0</span></span>
                </div>
                <button type="submit" id="submit-btn"
                        class="w-full btn-primary py-4 text-lg font-bold rounded-xl flex items-center justify-center gap-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Submit Donation
                </button>
                <p class="text-gray-500 text-xs text-center mt-3">
                    Your donation will be reviewed and confirmed within 24 hours.
                </p>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
// ---- Category meta data (server-rendered) ----
const categoryMeta = {
    @foreach($categories as $cat)
    {{ $cat->id }}: {
        name:        @json($cat->name),
        description: @json($cat->description ? Str::limit(strip_tags($cat->description), 160) : 'Make a donation to Bengal Club and help us build a stronger community.'),
        image:       @json($cat->image_path ? asset('storage/'.$cat->image_path) : null),
    },
    @endforeach
};
const siteName = @json($siteSetting?->site_name ?? 'The Bengal Club');

// ---- Category switcher ----
const categoryTabs  = document.querySelectorAll('.category-tab');
const categoryBgs   = document.querySelectorAll('.category-bg');
const categoryInfos = document.querySelectorAll('.category-info');
const catIdInput    = document.getElementById('donation-category-id');

function setMeta(name, content) {
    let el = document.querySelector(`meta[name="${name}"]`) ||
             document.querySelector(`meta[property="${name}"]`);
    if (el) el.setAttribute('content', content);
}

function switchCategory(catId) {
    catId = parseInt(catId);

    categoryTabs.forEach(tab => {
        const active = parseInt(tab.dataset.catId) === catId;
        tab.classList.toggle('bg-accent',     active);
        tab.classList.toggle('text-white',    active);
        tab.classList.toggle('text-gray-400', !active);
    });

    categoryBgs.forEach(bg => {
        bg.style.opacity = parseInt(bg.dataset.catId) === catId ? '1' : '0';
    });

    categoryInfos.forEach(info => {
        info.style.display = parseInt(info.dataset.catId) === catId ? 'block' : 'none';
    });

    if (catIdInput) catIdInput.value = catId;

    // Update page title + meta tags dynamically
    const meta = categoryMeta[catId];
    if (meta) {
        const fullTitle = meta.name + ' — Donate — ' + siteName;
        document.title = fullTitle;
        setMeta('description',          meta.description);
        setMeta('og:title',             fullTitle);
        setMeta('og:description',       meta.description);
        setMeta('twitter:title',        fullTitle);
        setMeta('twitter:description',  meta.description);
        if (meta.image) {
            setMeta('og:image',         meta.image);
            setMeta('twitter:image',    meta.image);
        }
    }

    // Update URL without reload
    const url = new URL(window.location.href);
    url.searchParams.set('category', catId);
    window.history.replaceState({ catId }, '', url.toString());
}

categoryTabs.forEach(tab => {
    tab.addEventListener('click', function() {
        switchCategory(this.dataset.catId);
    });
});

// ---- Quick amount buttons ----
document.querySelectorAll('.quick-amount-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const amount = this.dataset.amount;
        document.getElementById('amount-input').value = amount;
        document.getElementById('summary-value').textContent = parseInt(amount).toLocaleString('en-BD');
        document.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('bg-accent','text-white','border-accent'));
        this.classList.add('bg-accent','text-white','border-accent');
    });
});

// ---- Live amount sync ----
document.getElementById('amount-input').addEventListener('input', function() {
    const val = parseFloat(this.value) || 0;
    document.getElementById('summary-value').textContent = val > 0 ? val.toLocaleString('en-BD') : '0';
    document.querySelectorAll('.quick-amount-btn').forEach(b => b.classList.remove('bg-accent','text-white','border-accent'));
});

// ---- Payment method QR toggle ----
document.querySelectorAll('input[name="payment_method_id"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('[class*="method-qr-"]').forEach(el => el.classList.add('hidden'));
        const qrPanel = document.querySelector('.method-qr-' + this.value);
        if (qrPanel) qrPanel.classList.remove('hidden');
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

// ---- Init summary with old value ----
const initAmount = parseFloat(document.getElementById('amount-input')?.value) || 0;
if (initAmount > 0) document.getElementById('summary-value').textContent = initAmount.toLocaleString('en-BD');
</script>
@endpush

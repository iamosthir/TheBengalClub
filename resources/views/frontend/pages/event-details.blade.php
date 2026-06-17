@extends('frontend.layouts.master')

@section("content")
<!-- Event Details Page -->
<div class="event-details-page">
    <!-- Hero Section with Image Slideshow -->
    <section class="event-hero relative overflow-hidden">
        <div class="hero-overlay"></div>

        @if($event->gallery_images && count($event->gallery_images) > 0)
            <!-- Gallery Slideshow -->
            <div class="slideshow-container">
                @foreach($event->gallery_images as $index => $image)
                    <div class="slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ asset('storage/' . $image) }}');">
                        <div class="slide-overlay"></div>
                    </div>
                @endforeach

                <!-- Navigation Arrows -->
                @if(count($event->gallery_images) > 1)
                    <button class="slide-prev" onclick="changeSlide(-1)">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="slide-next" onclick="changeSlide(1)">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Slide Indicators -->
                    <div class="slide-indicators">
                        @foreach($event->gallery_images as $index => $image)
                            <button class="indicator {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        @elseif($event->thumbnail_path)
            <!-- Single Thumbnail Image -->
            <div class="single-image" style="background-image: url('{{ asset('storage/' . $event->thumbnail_path) }}');">
                <div class="slide-overlay"></div>
            </div>
        @else
            <!-- Fallback Gradient -->
            <div class="fallback-gradient"></div>
        @endif

        <!-- Hero Content -->
        <div class="hero-content container mx-auto px-6 relative z-10">
            <div class="max-w-4xl">
                <!-- Event Status Badge -->
                @php
                    $isUpcoming = $event->date >= now()->startOfDay();
                @endphp
                <div class="event-badge {{ $isUpcoming ? 'badge-upcoming' : 'badge-past' }}">
                    @if($isUpcoming)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Upcoming Event</span>
                    @else
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Past Event</span>
                    @endif
                </div>

                <!-- Event Title -->
                <h1 class="event-hero-title">{{ $event->title }}</h1>

                <!-- Event Meta Info -->
                <div class="event-meta-info">
                    <div class="meta-item">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $event->date->format('l, F j, Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $event->venue }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Event Details Section -->
    <section class="event-details-section py-24 lg:py-32">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <!-- Event Description -->
                <div class="event-description-card">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="card-title">Event Details</h2>
                    </div>
                    <div class="card-content">
                        <div class="event-description-content">
                            {!! $event->description !!}
                        </div>
                    </div>
                </div>

                <!-- Event Information Grid -->
                <div class="event-info-grid">
                    <!-- Date Card -->
                    <div class="info-card">
                        <div class="info-icon">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="info-content">
                            <h3 class="info-label">Date & Time</h3>
                            <p class="info-value">{{ $event->date->format('l, F j, Y') }}</p>
                            <p class="info-subtext">{{ $event->date->format('g:i A') }}</p>
                        </div>
                    </div>

                    <!-- Venue Card -->
                    <div class="info-card">
                        <div class="info-icon">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="info-content">
                            <h3 class="info-label">Venue</h3>
                            <p class="info-value">{{ $event->venue }}</p>
                            <p class="info-subtext">The Bengal Club</p>
                        </div>
                    </div>
                </div>

                <!-- Registration Section -->
                @php
                    $isUpcomingEvent = $event->date >= now()->startOfDay();
                    $alreadyRegistered = false;
                    if (Auth::check()) {
                        $alreadyRegistered = $event->registrations()
                            ->where('user_id', Auth::id())
                            ->whereNotIn('status', ['cancelled'])
                            ->exists();
                    }
                @endphp

                @if($isUpcomingEvent)
                <div class="event-registration-card mt-12">
                    <div class="card-header">
                        <div class="card-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="card-title">Register for This Event</h2>
                    </div>
                    <div class="card-content">
                        <!-- Fee Info -->
                        <div class="event-fee-badge {{ $event->is_free ? 'fee-free' : 'fee-paid' }} mb-6">
                            @if($event->is_free)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>Free Entry</span>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Registration Fee: BDT {{ number_format($event->fee, 2) }}</span>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="reg-alert reg-alert-success">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="reg-alert reg-alert-error">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @if($alreadyRegistered)
                            <div class="reg-alert reg-alert-info">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>You have already registered for this event. We will notify you once your registration is approved.</span>
                            </div>
                        @elseif(!session('success'))
                            <form action="{{ route('frontend.events.register', $event) }}" method="POST" enctype="multipart/form-data" class="reg-form">
                                @csrf

                                @if($errors->any())
                                    <div class="reg-alert reg-alert-error mb-4">
                                        <ul class="list-none m-0 p-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(!Auth::check())
                                    <!-- Guest fields -->
                                    <div class="reg-form-grid">
                                        <div class="reg-form-group">
                                            <label class="reg-label">Full Name <span class="text-red-500">*</span></label>
                                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                                   class="reg-input" placeholder="Your full name" required>
                                        </div>
                                        <div class="reg-form-group">
                                            <label class="reg-label">Email Address <span class="text-red-500">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                   class="reg-input" placeholder="your@email.com" required>
                                        </div>
                                        <div class="reg-form-group">
                                            <label class="reg-label">Phone Number <span class="text-red-500">*</span></label>
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                   class="reg-input" placeholder="+880..." required>
                                        </div>
                                        <div class="reg-form-group">
                                            <label class="reg-label">Address <span class="text-red-500">*</span></label>
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                   class="reg-input" placeholder="Your address" required>
                                        </div>
                                    </div>
                                @else
                                    <p class="reg-member-info">
                                        Registering as <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
                                    </p>
                                @endif

                                @if(!$event->is_free)
                                    <!-- Payment section -->
                                    <div class="reg-payment-section">
                                        <h3 class="reg-section-title">Payment Details</h3>
                                        @php $paymentMethods = \App\Models\PaymentMethod::where('status', true)->get(); @endphp

                                        @if($paymentMethods->isNotEmpty())
                                            <p class="reg-payment-hint">Choose a payment method</p>
                                            <div class="reg-payment-methods">
                                                @foreach($paymentMethods as $method)
                                                    <label class="reg-payment-method {{ old('payment_method_id') == $method->id ? 'selected' : '' }}">
                                                        <input type="radio" name="payment_method_id" value="{{ $method->id }}"
                                                               {{ old('payment_method_id') == $method->id ? 'checked' : '' }}
                                                               onchange="showPaymentInstruction({{ $method->id }})">
                                                        <span class="reg-payment-check">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </span>
                                                        <div class="reg-payment-body">
                                                            @if($method->logo_path)
                                                                <div class="reg-payment-logo-wrap">
                                                                    <img src="{{ asset('storage/' . $method->logo_path) }}" alt="{{ $method->name }}" class="reg-payment-logo">
                                                                </div>
                                                            @else
                                                                <div class="reg-payment-logo-wrap reg-payment-logo-fallback">
                                                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                            <span class="reg-payment-name">{{ $method->name }}</span>
                                                            @if($method->wallet_number)
                                                                <span class="reg-payment-number">{{ $method->wallet_number }}</span>
                                                            @endif
                                                        </div>
                                                    </label>
                                                @endforeach
                                            </div>

                                            @foreach($paymentMethods as $method)
                                                <div id="payment-instruction-{{ $method->id }}" class="reg-payment-instruction" style="display:none;">
                                                    <div class="reg-payment-instruction-header">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span>How to pay with {{ $method->name }}</span>
                                                    </div>
                                                    @if($method->wallet_number)
                                                        <div class="reg-payment-wallet">
                                                            <span class="reg-payment-wallet-label">Send to</span>
                                                            <span class="reg-payment-wallet-number">{{ $method->wallet_number }}</span>
                                                            <button type="button" class="reg-payment-copy" data-copy="{{ $method->wallet_number }}" aria-label="Copy number">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                    @if($method->instruction)
                                                        <p class="reg-payment-instruction-text">{{ $method->instruction }}</p>
                                                    @endif
                                                    @if($method->qr_image_path)
                                                        <img src="{{ asset('storage/' . $method->qr_image_path) }}" alt="QR Code" class="reg-qr-image">
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="reg-form-group mt-4">
                                            <label class="reg-label">Transaction ID <span class="text-gray-400">(optional)</span></label>
                                            <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                                                   class="reg-input" placeholder="Payment transaction ID">
                                        </div>

                                        <div class="reg-form-group mt-4">
                                            <label class="reg-label">Payment Proof / Screenshot <span class="text-red-500">*</span></label>
                                            <input type="file" name="payment_proof" accept=".jpg,.jpeg,.png"
                                                   class="reg-file-input" required>
                                            <p class="reg-file-hint">JPG, JPEG or PNG. Max 5MB.</p>
                                        </div>
                                    </div>
                                @endif

                                <button type="submit" class="reg-submit-btn">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Register Now
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Back to Events Button -->
                <div class="text-center mt-16">
                    <a href="/#events" class="back-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Back to All Events</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function showPaymentInstruction(methodId) {
    document.querySelectorAll('.reg-payment-instruction').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.reg-payment-method').forEach(el => el.classList.remove('selected'));
    const instruction = document.getElementById('payment-instruction-' + methodId);
    if (instruction) instruction.style.display = 'block';
    const radio = document.querySelector('input[name="payment_method_id"][value="' + methodId + '"]');
    if (radio && radio.closest('.reg-payment-method')) {
        radio.closest('.reg-payment-method').classList.add('selected');
    }
}

// Show instruction for pre-selected payment method on page load
document.addEventListener('DOMContentLoaded', function () {
    const checked = document.querySelector('input[name="payment_method_id"]:checked');
    if (checked) showPaymentInstruction(checked.value);

    document.querySelectorAll('.reg-payment-copy').forEach(btn => {
        btn.addEventListener('click', async () => {
            const value = btn.getAttribute('data-copy') || '';
            try {
                await navigator.clipboard.writeText(value);
                btn.classList.add('copied');
                setTimeout(() => btn.classList.remove('copied'), 1500);
            } catch (e) {}
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* ===== Registration Card (Dark Theme) ===== */
.event-registration-card {
    background: linear-gradient(180deg, rgba(15, 112, 191, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%);
    border: 1px solid rgba(15, 112, 191, 0.25);
    border-radius: 24px;
    padding: 3rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}
.event-registration-card:hover {
    border-color: rgba(15, 112, 191, 0.45);
    transform: translateY(-4px);
    box-shadow: 0 24px 70px rgba(15, 112, 191, 0.18);
}

/* Fee badge */
.event-fee-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.25rem;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.01em;
    border: 1px solid transparent;
}
.fee-free {
    background: rgba(34, 197, 94, 0.12);
    border-color: rgba(34, 197, 94, 0.4);
    color: #4ade80;
}
.fee-paid {
    background: rgba(245, 158, 11, 0.12);
    border-color: rgba(245, 158, 11, 0.4);
    color: #fbbf24;
}

/* Alerts */
.reg-alert {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.25rem;
    font-size: 0.95rem;
    border: 1px solid transparent;
    line-height: 1.5;
}
.reg-alert svg { flex-shrink: 0; margin-top: 2px; }
.reg-alert-success {
    background: rgba(34, 197, 94, 0.08);
    border-color: rgba(34, 197, 94, 0.3);
    color: #86efac;
}
.reg-alert-error {
    background: rgba(239, 68, 68, 0.08);
    border-color: rgba(239, 68, 68, 0.3);
    color: #fca5a5;
}
.reg-alert-info {
    background: rgba(15, 112, 191, 0.1);
    border-color: rgba(15, 112, 191, 0.35);
    color: #93c5fd;
}
.reg-alert ul { margin: 0; padding: 0; list-style: none; }
.reg-alert ul li { margin-bottom: 4px; }
.reg-alert ul li:last-child { margin-bottom: 0; }

/* Form */
.reg-form { margin-top: 0.5rem; }
.reg-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.25rem;
}
@media (max-width: 640px) {
    .reg-form-grid { grid-template-columns: 1fr; }
    .event-registration-card { padding: 1.75rem 1.25rem; border-radius: 18px; }
}
.reg-form-group { display: flex; flex-direction: column; gap: 0.4rem; }
.reg-label {
    font-weight: 600;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.85);
    letter-spacing: 0.02em;
}
.reg-label .text-red-500 { color: #f87171 !important; }
.reg-label .text-gray-400 { color: rgba(255, 255, 255, 0.45) !important; font-weight: 400; font-size: 0.8rem; }

.reg-input {
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 10px;
    padding: 0.7rem 1rem;
    font-size: 0.95rem;
    color: #fff;
    width: 100%;
    transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
}
.reg-input::placeholder { color: rgba(255, 255, 255, 0.35); }
.reg-input:hover { border-color: rgba(255, 255, 255, 0.22); }
.reg-input:focus {
    outline: none;
    border-color: rgba(15, 112, 191, 0.7);
    background: rgba(255, 255, 255, 0.06);
    box-shadow: 0 0 0 4px rgba(15, 112, 191, 0.15);
}

/* Signed-in user info */
.reg-member-info {
    background: rgba(15, 112, 191, 0.08);
    border: 1px solid rgba(15, 112, 191, 0.25);
    border-radius: 12px;
    padding: 0.9rem 1.1rem;
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 1.25rem;
}
.reg-member-info strong { color: #fff; }

/* Payment section */
.reg-payment-section {
    margin-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 1.75rem;
}
.reg-section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.reg-section-title::before {
    content: '';
    width: 4px;
    height: 20px;
    background: linear-gradient(180deg, #0f70bf, #1a8fe0);
    border-radius: 4px;
}
.reg-payment-hint {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.55);
    margin: 0 0 1rem 0;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-weight: 600;
}

/* ===== Payment Methods Grid ===== */
.reg-payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 0.85rem;
    margin-bottom: 1.5rem;
}
@media (max-width: 480px) {
    .reg-payment-methods { grid-template-columns: repeat(2, 1fr); gap: 0.65rem; }
}

.reg-payment-method {
    position: relative;
    display: block;
    padding: 1.1rem 0.9rem;
    background: rgba(255, 255, 255, 0.03);
    border: 2px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    cursor: pointer;
    transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    overflow: hidden;
}
.reg-payment-method input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.reg-payment-method:hover {
    transform: translateY(-3px);
    border-color: rgba(15, 112, 191, 0.45);
    background: rgba(15, 112, 191, 0.06);
}
.reg-payment-method.selected {
    border-color: #0f70bf;
    background: linear-gradient(180deg, rgba(15, 112, 191, 0.18) 0%, rgba(15, 112, 191, 0.06) 100%);
    box-shadow: 0 10px 30px rgba(15, 112, 191, 0.25);
}

.reg-payment-check {
    position: absolute;
    top: 0.6rem;
    right: 0.6rem;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    transition: all 0.25s ease;
}
.reg-payment-method.selected .reg-payment-check {
    background: #0f70bf;
    border-color: #0f70bf;
    color: #fff;
}

.reg-payment-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.55rem;
    text-align: center;
}
.reg-payment-logo-wrap {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}
.reg-payment-logo-fallback {
    background: rgba(15, 112, 191, 0.15);
    color: #1a8fe0;
    box-shadow: none;
}
.reg-payment-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.reg-payment-name {
    font-weight: 600;
    font-size: 0.95rem;
    color: #fff;
    line-height: 1.2;
}
.reg-payment-number {
    font-size: 0.78rem;
    color: rgba(255, 255, 255, 0.55);
    font-family: 'Courier New', monospace;
    letter-spacing: 0.02em;
}

/* Payment instruction panel */
.reg-payment-instruction {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(15, 112, 191, 0.3);
    border-radius: 14px;
    padding: 1.25rem 1.4rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 1rem;
    animation: regFadeIn 0.3s ease-out;
}
@keyframes regFadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
}
.reg-payment-instruction-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 0.85rem;
    font-size: 1rem;
}
.reg-payment-instruction-header svg { color: #1a8fe0; }
.reg-payment-instruction-text {
    margin: 0.5rem 0 0;
    font-size: 0.9rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.7);
}

.reg-payment-wallet {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(0, 0, 0, 0.25);
    border: 1px dashed rgba(15, 112, 191, 0.45);
    border-radius: 10px;
    padding: 0.7rem 0.9rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}
.reg-payment-wallet-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(255, 255, 255, 0.5);
    font-weight: 600;
}
.reg-payment-wallet-number {
    font-family: 'Courier New', monospace;
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.02em;
    flex: 1;
}
.reg-payment-copy {
    background: rgba(15, 112, 191, 0.18);
    border: 1px solid rgba(15, 112, 191, 0.4);
    color: #93c5fd;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}
.reg-payment-copy:hover { background: #0f70bf; color: #fff; }
.reg-payment-copy.copied { background: #16a34a; border-color: #16a34a; color: #fff; }

.reg-qr-image {
    max-width: 180px;
    margin-top: 0.85rem;
    border-radius: 10px;
    padding: 6px;
    background: #fff;
    display: block;
}

/* File input */
.reg-file-input {
    display: block;
    width: 100%;
    padding: 0.85rem 1rem;
    border: 2px dashed rgba(255, 255, 255, 0.18);
    border-radius: 12px;
    font-size: 0.9rem;
    background: rgba(255, 255, 255, 0.02);
    color: rgba(255, 255, 255, 0.75);
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
}
.reg-file-input:hover {
    border-color: rgba(15, 112, 191, 0.55);
    background: rgba(15, 112, 191, 0.06);
}
.reg-file-input::file-selector-button {
    background: rgba(15, 112, 191, 0.25);
    border: 1px solid rgba(15, 112, 191, 0.5);
    color: #fff;
    padding: 0.4rem 0.9rem;
    border-radius: 8px;
    margin-right: 0.85rem;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.85rem;
    transition: background 0.2s;
}
.reg-file-input::file-selector-button:hover { background: #0f70bf; }
.reg-file-hint {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.45);
    margin-top: 0.35rem;
}

/* Submit button */
.reg-submit-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    margin-top: 1.75rem;
    padding: 0.95rem 2.5rem;
    background: linear-gradient(135deg, #0f70bf 0%, #0a5a9c 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    box-shadow: 0 8px 24px rgba(15, 112, 191, 0.35);
}
.reg-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(15, 112, 191, 0.5);
    background: linear-gradient(135deg, #1a8fe0 0%, #0f70bf 100%);
}
.reg-submit-btn:active { transform: translateY(0); }
@media (max-width: 480px) {
    .reg-submit-btn { width: 100%; }
}
</style>
@endpush
@endsection

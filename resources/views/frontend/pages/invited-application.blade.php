@extends('frontend.layouts.master')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/membership-application.css') }}">

<!-- Membership Application Section -->
<section id="membership-application" class="py-24 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%), linear-gradient(45deg, rgba(15, 112, 191, 0.1) 25%, transparent 25%, transparent 75%, rgba(15, 112, 191, 0.1) 75%); background-size: 60px 60px; background-position: 0 0, 30px 30px;"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-up">
            <span class="section-caption">You've Been Invited</span>
            <h1 class="section-title">Membership Application</h1>
            <p class="section-text">
                You have received an exclusive invitation to join The Bengal Club. Complete the form below to submit your membership application.
            </p>
        </div>

        <!-- Invitation Banner -->
        <div class="max-w-5xl mx-auto mb-8 reveal-up">
            <div class="bg-accent/10 border border-accent/30 rounded-2xl p-5 flex flex-col sm:flex-row items-center gap-4">
                <div class="shrink-0 w-12 h-12 rounded-full bg-accent/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-semibold">Invitation ID: <span class="text-accent font-mono tracking-widest">{{ $invitation->invite_id }}</span></p>
                    <p class="text-gray-400 text-sm">This application is pre-filled with your invitation details. Your email address cannot be changed.</p>
                </div>
            </div>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="bg-dark-700 border border-accent/20 rounded-2xl p-8 lg:p-12 reveal-up">

                <!-- Step Progress Indicator -->
                <div id="step-indicator" class="flex items-center justify-center mb-10">
                    <div class="flex items-center gap-3">
                        <!-- Step 1 -->
                        <div class="flex items-center gap-2">
                            <div id="step-dot-1" class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-accent text-white">1</div>
                            <span id="step-label-1" class="text-sm font-semibold text-white hidden sm:block">Application Info</span>
                        </div>
                        <!-- Connector -->
                        <div class="w-12 sm:w-20 h-0.5 bg-accent/30 rounded" id="step-connector"></div>
                        <!-- Step 2 -->
                        <div class="flex items-center gap-2">
                            <div id="step-dot-2" class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 bg-dark-800 border-2 border-accent/30 text-gray-400">2</div>
                            <span id="step-label-2" class="text-sm font-semibold text-gray-400 hidden sm:block">Payment</span>
                        </div>
                    </div>
                </div>

                <form id="membership-application-form"
                      action="{{ route('invites.submit', $invitation->invite_id) }}"
                      class="space-y-8">
                    @csrf

                    {{-- ===== STEP 1 ===== --}}
                    <div id="step-1">

                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Personal Information
                            </h3>

                            <div class="grid md:grid-cols-3 gap-6">
                                {{-- Left column: Name + DOB --}}
                                <div class="md:col-span-2 grid md:grid-cols-2 gap-6">
                                    <div class="form-group md:col-span-2">
                                        <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">
                                            Full Name <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="name" name="name"
                                               class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                               placeholder="Enter your full name" required>
                                        <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                    </div>

                                    <div class="form-group md:col-span-2">
                                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-300 mb-2">
                                            Date of Birth <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="date_of_birth" name="date_of_birth"
                                               class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                               placeholder="Select your date of birth" required>
                                        <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                    </div>
                                </div>

                                {{-- Right column: Passport Photo --}}
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                                        Passport Size Photo <span class="text-red-500 text-xs font-normal">*</span>
                                    </label>
                                    <div id="photo-upload-area" class="relative border-2 border-dashed border-accent/30 rounded-xl text-center cursor-pointer hover:border-accent/60 transition-all duration-300 bg-dark-800 aspect-3/4 flex items-center justify-center overflow-hidden">
                                        <input type="file" id="photo" name="photo" accept="image/png,image/jpeg,image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                        <div id="photo-placeholder" class="flex flex-col items-center p-4">
                                            <svg class="w-10 h-10 text-accent/50 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            <p class="text-gray-400 text-xs mb-1">Click to upload</p>
                                            <p class="text-gray-500 text-[10px]">Passport size photo</p>
                                        </div>
                                        <div id="photo-preview" class="inset-0 z-5" style="display: none;">
                                            <img id="photo-preview-img" src="" alt="Photo Preview" class="w-full h-full object-cover">
                                            <button type="button" id="remove-photo" class="absolute top-2 right-2 bg-red-500/80 hover:bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs z-20 transition-colors">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>

                                <div class="form-group md:col-span-3">
                                    <label for="nid_passport" class="block text-sm font-semibold text-gray-300 mb-2">
                                        NID / Passport Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nid_passport" name="nid_passport"
                                           class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                           placeholder="Enter your NID or Passport number" required>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>

                                <div class="form-group md:col-span-3">
                                    <label for="profession_organization" class="block text-sm font-semibold text-gray-300 mb-2">
                                        Profession / Organization <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="profession_organization" name="profession_organization"
                                           class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                           placeholder="e.g., Software Engineer at ABC Company" required>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Contact Details
                            </h3>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label for="mobile" class="block text-sm font-semibold text-gray-300 mb-2">
                                        Mobile Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="mobile" name="mobile"
                                           class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                           placeholder="+880 1234-567890" required>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>

                                <!-- Email: pre-filled and readonly -->
                                <div class="form-group">
                                    <label for="email_display" class="block text-sm font-semibold text-gray-300 mb-2">
                                        Email Address
                                        <span class="ml-2 text-xs font-normal text-accent bg-accent/10 px-2 py-0.5 rounded-full">Locked by invite</span>
                                    </label>
                                    <input type="email" id="email_display"
                                           class="w-full px-4 py-3 bg-dark-900 border border-accent/20 rounded-lg text-gray-400 cursor-not-allowed opacity-75"
                                           value="{{ $invitation->email }}" readonly>
                                </div>

                                <div class="form-group md:col-span-2">
                                    <label for="address" class="block text-sm font-semibold text-gray-300 mb-2">
                                        Present Address <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="address" name="address" rows="3"
                                              class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors resize-none"
                                              placeholder="Your current residential address" required></textarea>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Reference -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Reference
                            </h3>

                            <div class="form-group">
                                <label for="reference" class="block text-sm font-semibold text-gray-300 mb-2">
                                    Reference (If any) <span class="text-gray-500 text-xs font-normal">— Optional</span>
                                </label>
                                <input type="text" id="reference" name="reference"
                                       class="w-full px-4 py-3 bg-dark-800 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                       placeholder="Name of the person who referred you">
                                <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                            </div>
                        </div>

                        <!-- NID / Passport Photo -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                                </svg>
                                NID / Passport Photo <span class="text-red-500">*</span>
                            </h3>

                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-300 mb-2">
                                    Upload NID or Passport Photo <span class="text-gray-500 text-xs font-normal">— PNG, JPG (Max 2MB)</span>
                                </label>
                                <div id="nid-photo-upload-area" class="relative border-2 border-dashed border-accent/30 rounded-xl p-8 text-center cursor-pointer hover:border-accent/60 transition-all duration-300 bg-dark-800">
                                    <input type="file" id="nid_photo" name="nid_photo" accept="image/png,image/jpeg,image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div id="nid-photo-placeholder" class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-accent/50 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-gray-400 text-sm mb-1">Click to upload or drag and drop</p>
                                        <p class="text-gray-500 text-xs">PNG, JPG up to 2MB</p>
                                    </div>
                                    <div id="nid-photo-preview" class="hidden">
                                        <img id="nid-photo-preview-img" src="" alt="NID Photo Preview" class="max-h-48 mx-auto rounded border border-accent/20">
                                        <p id="nid-photo-file-name" class="text-gray-400 text-sm mt-2"></p>
                                        <button type="button" id="remove-nid-photo" class="mt-2 text-red-400 hover:text-red-300 text-sm font-semibold transition-colors">Remove</button>
                                    </div>
                                </div>
                                <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                            </div>
                        </div>

                        <!-- Membership Category (locked from invitation) -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                Membership Category
                                <span class="ml-3 text-xs font-normal text-accent bg-accent/10 px-2 py-0.5 rounded-full">Assigned by invite</span>
                            </h3>

                            <!-- Pre-checked hidden radio so JS validation passes -->
                            <input type="radio" name="membership_category_id" value="{{ $invitation->membership_category_id }}" checked class="sr-only" aria-hidden="true">

                            <div class="p-6 bg-dark-800 border-2 border-accent rounded-xl">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="w-5 h-5 rounded-full border-2 border-accent bg-accent flex items-center justify-center">
                                        <div class="w-2 h-2 rounded-full bg-white"></div>
                                    </div>
                                    @if($invitation->membershipCategory->badge_text)
                                        <span class="badge px-2 py-1 bg-accent/20 text-accent text-xs font-semibold rounded">{{ $invitation->membershipCategory->badge_text }}</span>
                                    @endif
                                </div>
                                <div class="membership-details">
                                    <h4 class="text-xl font-bold text-white mb-2">{{ $invitation->membershipCategory->title }}</h4>
                                    @if($invitation->membershipCategory->bio)
                                        <p class="text-sm text-gray-400 mb-3">{{ $invitation->membershipCategory->bio }}</p>
                                    @endif
                                    <div class="price-duration mt-4 pt-4 border-t border-accent/10">
                                        <div class="flex items-baseline justify-between">
                                            <span class="price text-2xl font-bold text-accent">৳{{ number_format($invitation->membershipCategory->price, 2) }}</span>
                                            <span class="duration text-sm text-gray-400 bg-dark-900 px-3 py-1 rounded-full">{{ $invitation->membershipCategory->duration }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 1 Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="button" id="next-btn"
                                    class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-accent text-white rounded-lg hover:bg-accent-dark transition-all duration-300 font-semibold">
                                <span>Next — Payment</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <button type="reset" id="reset-btn"
                                    class="flex-1 px-8 py-4 bg-dark-800 border border-accent/20 text-white rounded-lg hover:border-accent/40 transition-all duration-300 font-semibold">
                                Reset Form
                            </button>
                        </div>

                    </div>{{-- end step-1 --}}

                    {{-- ===== STEP 2 ===== --}}
                    <div id="step-2" class="hidden space-y-8">

                        <!-- Application Fee Banner (custom from invitation) -->
                        <div class="bg-accent/10 border border-accent/30 rounded-2xl p-6 text-center">
                            <p class="text-gray-400 text-sm mb-1 uppercase tracking-widest font-semibold">Application Fee</p>
                            <p class="text-5xl font-extrabold text-accent mb-2">
                                ৳{{ number_format($invitation->application_fee, 2) }}
                            </p>
                            <p class="text-gray-400 text-sm">Please pay this amount using one of the methods below and provide your transaction details.</p>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Select Payment Method <span class="text-red-500 ml-1">*</span>
                            </h3>

                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                                @foreach($paymentMethods as $method)
                                    <label class="payment-method-radio-card cursor-pointer">
                                        <input type="radio" name="payment_method_id"
                                               value="{{ $method->id }}"
                                               class="peer sr-only"
                                               data-instruction="{{ $method->instruction }}"
                                               data-wallet="{{ $method->wallet_number }}"
                                               data-qr="{{ $method->qr_image_path ? asset('storage/' . $method->qr_image_path) : '' }}"
                                               data-label="{{ $method->label }}"
                                               required>
                                        <div class="flex flex-col items-center gap-3 p-5 bg-dark-800 border-2 border-accent/20 rounded-xl transition-all duration-300 peer-checked:border-accent peer-checked:bg-accent/5 hover:border-accent/40 hover:shadow-lg">
                                            @if($method->logo_path)
                                                <img src="{{ asset('storage/' . $method->logo_path) }}"
                                                     alt="{{ $method->name }}"
                                                     class="w-16 h-16 object-contain">
                                            @else
                                                <div class="w-16 h-16 rounded-full bg-accent/20 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span class="font-semibold text-white text-sm text-center leading-tight">{{ $method->name }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <span class="error-message text-red-500 text-sm hidden" id="payment-method-error"></span>

                            <!-- Payment details box — shown when a method is selected -->
                            <div id="payment-details-box" class="hidden bg-dark-800 border border-accent/30 rounded-xl p-6 space-y-5">

                                <!-- Instruction + QR -->
                                <div class="flex flex-col md:flex-row gap-6">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-300 mb-2">How to pay:</p>
                                        <div id="payment-instruction" class="text-gray-400 text-sm leading-relaxed whitespace-pre-line"></div>
                                        <div id="payment-wallet-wrap" class="mt-3 hidden">
                                            <span id="wallet-display-label" class="text-sm font-semibold text-gray-300">Wallet Number:</span>
                                            <span id="payment-wallet" class="ml-2 text-accent font-mono font-semibold text-base"></span>
                                            <button type="button" onclick="copyWalletNumber('payment-wallet', this)"
                                                    class="ml-2 inline-flex items-center gap-1 px-2 py-0.5 text-xs rounded bg-accent/10 border border-accent/30 text-accent hover:bg-accent/20 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="copy-label">Copy</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="payment-qr-wrap" class="hidden shrink-0 text-center">
                                        <p class="text-sm font-semibold text-gray-300 mb-2">Scan QR to pay:</p>
                                        <img id="payment-qr-img" src="" alt="QR Code" class="w-36 h-36 object-contain border border-accent/20 rounded-lg p-1 mx-auto">
                                    </div>
                                </div>

                                <hr class="border-accent/20">

                                <!-- Transaction ID -->
                                <div class="form-group">
                                    <label for="transaction_id" class="block text-sm font-semibold text-gray-300 mb-2">
                                        Transaction ID <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="transaction_id" name="transaction_id"
                                           class="w-full px-4 py-3 bg-dark-900 border border-accent/20 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-accent transition-colors"
                                           placeholder="Enter the transaction / reference ID">
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>

                                <!-- Payment Proof -->
                                <div class="form-group">
                                    <label class="block text-sm font-semibold text-gray-300 mb-2">
                                        Payment Proof Screenshot <span class="text-red-500 text-xs font-normal">*</span>
                                    </label>
                                    <div id="proof-upload-area" class="relative border-2 border-dashed border-accent/30 rounded-xl p-6 text-center cursor-pointer hover:border-accent/60 transition-all duration-300 bg-dark-900">
                                        <input type="file" id="payment_proof" name="payment_proof" accept="image/png,image/jpeg,image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                                        <div id="proof-placeholder" class="flex flex-col items-center">
                                            <svg class="w-10 h-10 text-accent/50 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="text-gray-400 text-sm mb-1">Click to upload screenshot</p>
                                            <p class="text-gray-500 text-xs">PNG, JPG up to 5MB</p>
                                        </div>
                                        <div id="proof-preview" class="hidden">
                                            <img id="proof-preview-img" src="" alt="Payment Proof" class="max-h-40 mx-auto rounded border border-accent/20">
                                            <p id="proof-file-name" class="text-gray-400 text-sm mt-2"></p>
                                            <button type="button" id="remove-proof" class="mt-2 text-red-400 hover:text-red-300 text-sm font-semibold transition-colors">Remove</button>
                                        </div>
                                    </div>
                                    <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="bg-dark-800 border border-accent/20 rounded-lg p-6">
                            <h4 class="text-lg font-bold text-white mb-4">Terms & Conditions</h4>

                            <div class="flex items-start mt-6">
                                <input type="checkbox" id="is_tos_accepted" name="is_tos_accepted" class="peer sr-only" required>
                                <label for="is_tos_accepted" class="flex items-start cursor-pointer group">
                                    <div class="w-5 h-5 rounded border-2 border-accent/40 mr-3 flex items-center justify-center peer-checked:bg-accent peer-checked:border-accent transition-all shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-300 text-sm">
                                        I have read and agree to the
                                        <button type="button" id="open-tos-modal" class="text-accent hover:text-accent-light underline font-semibold">Terms & Conditions</button>
                                        <span class="text-red-500">*</span>
                                    </span>
                                </label>
                            </div>
                            <span class="error-message text-red-500 text-sm mt-2 hidden"></span>
                        </div>

                        <!-- Step 2 Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="button" id="back-btn"
                                    class="sm:w-auto px-8 py-4 bg-dark-800 border border-accent/20 text-white rounded-lg hover:border-accent/40 transition-all duration-300 font-semibold inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Back
                            </button>
                            <button type="submit" id="submit-btn"
                                    class="flex-1 btn-primary inline-flex items-center justify-center px-8 py-4 bg-accent text-white rounded-lg hover:bg-accent-dark transition-all duration-300 font-semibold disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Submit Application</span>
                            </button>
                        </div>

                    </div>{{-- end step-2 --}}

                </form>

                <!-- Success Message (Hidden by default) -->
                <div id="success-message" class="hidden mt-8 p-8 bg-green-500/10 border border-green-500/30 rounded-xl">
                    <div class="flex items-center text-green-400 mb-4">
                        <svg class="w-8 h-8 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold text-lg" id="success-message-text"></span>
                    </div>
                    <div id="application-info" class="hidden mt-4 p-4 bg-dark-800 rounded-lg border border-accent/20">
                        <p class="text-gray-300 text-sm mb-1">Your Application ID:</p>
                        <p class="text-accent text-2xl font-bold mb-4" id="application-id-display"></p>
                        <a id="download-pdf-btn" href="#" target="_blank"
                           class="inline-flex items-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-dark transition-all duration-300 font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Application Form (PDF)
                        </a>
                    </div>
                </div>

                <!-- Error Message (Hidden by default) -->
                <div id="error-message" class="hidden mt-8 p-6 bg-red-500/10 border border-red-500/30 rounded-lg">
                    <div class="flex items-center text-red-400">
                        <svg class="w-6 h-6 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold" id="error-message-text"></span>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center reveal-up">
                <p class="text-gray-400 mb-4">
                    For any queries regarding membership, please contact us
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="mailto:membership@thebengal.club" class="text-accent hover:text-accent-light transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        membership@thebengal.club
                    </a>
                    <a href="tel:+1234567890" class="text-accent hover:text-accent-light transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +880 1234-567890
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Custom JS (reuses the same membership application JS) -->
<script src="{{ asset('js/membership-application.js') }}"></script>
@endsection

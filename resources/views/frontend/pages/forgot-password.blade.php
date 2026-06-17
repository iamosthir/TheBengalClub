@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen flex items-center justify-center px-4 pt-28 pb-16">
    <div class="w-full max-w-md">
        <!-- Forgot Password Card -->
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-8 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">Reset Password</h1>
                <p class="text-gray-400 mt-2">We'll send you an OTP to verify your identity</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                    <p class="text-green-400 text-sm text-center">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Global Errors -->
            @if($errors->has('email') && !session('step'))
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    <p class="text-red-400 text-sm text-center">{{ $errors->first('email') }}</p>
                </div>
            @endif

            @php
                $currentStep = session('step', 1);
                $email = session('email', old('email'));
            @endphp

            <!-- Step Indicator -->
            <div class="flex items-center justify-center gap-3 mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 1 ? 'bg-accent text-white' : 'bg-dark-600 text-gray-500' }}">1</div>
                    <span class="text-xs {{ $currentStep >= 1 ? 'text-accent' : 'text-gray-500' }} hidden sm:inline">Email</span>
                </div>
                <div class="w-8 h-0.5 {{ $currentStep >= 2 ? 'bg-accent' : 'bg-dark-600' }}"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 2 ? 'bg-accent text-white' : 'bg-dark-600 text-gray-500' }}">2</div>
                    <span class="text-xs {{ $currentStep >= 2 ? 'text-accent' : 'text-gray-500' }} hidden sm:inline">OTP</span>
                </div>
                <div class="w-8 h-0.5 {{ $currentStep >= 3 ? 'bg-accent' : 'bg-dark-600' }}"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold {{ $currentStep >= 3 ? 'bg-accent text-white' : 'bg-dark-600 text-gray-500' }}">3</div>
                    <span class="text-xs {{ $currentStep >= 3 ? 'text-accent' : 'text-gray-500' }} hidden sm:inline">Reset</span>
                </div>
            </div>

            <!-- Step 1: Enter Email -->
            <div id="step-1" class="{{ $currentStep != 1 ? 'hidden' : '' }}">
                <form method="POST" action="{{ route('member.forgot-password.send-otp') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email-step1" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </span>
                            <input type="email" id="email-step1" name="email" value="{{ old('email') }}"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                                placeholder="Enter your registered email" required autofocus>
                        </div>
                        @if($errors->has('email') && session('step', 1) == 1)
                            <p class="text-red-400 text-sm mt-2">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base">
                        Send OTP
                    </button>
                </form>
            </div>

            <!-- Step 2: Enter OTP -->
            <div id="step-2" class="{{ $currentStep != 2 ? 'hidden' : '' }}">
                <form method="POST" action="{{ route('member.forgot-password.verify-otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <p class="text-gray-400 text-sm text-center mb-5">OTP sent to <span class="text-accent font-medium">{{ $email }}</span></p>

                    <div class="mb-5">
                        <label for="otp" class="block text-sm font-medium text-gray-300 mb-2">Enter OTP</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </span>
                            <input type="text" id="otp" name="otp" maxlength="6"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white text-center text-xl tracking-[0.5em] placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                                placeholder="000000" required autofocus>
                        </div>
                        @if($errors->has('otp'))
                            <p class="text-red-400 text-sm mt-2">{{ $errors->first('otp') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base">
                        Verify OTP
                    </button>
                </form>

                <!-- Resend OTP -->
                <div class="mt-4 text-center">
                    <form method="POST" action="{{ route('member.forgot-password.send-otp') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="text-sm text-accent hover:text-accent-light transition-colors">
                            Resend OTP
                        </button>
                    </form>
                </div>
            </div>

            <!-- Step 3: New Password -->
            <div id="step-3" class="{{ $currentStep != 3 ? 'hidden' : '' }}">
                <form method="POST" action="{{ route('member.forgot-password.reset') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="otp" value="{{ old('otp', session('otp')) }}">

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                                placeholder="Min 6 characters" required>
                        </div>
                        @if($errors->has('password'))
                            <p class="text-red-400 text-sm mt-2">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                                placeholder="Confirm new password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base">
                        Reset Password
                    </button>
                </form>
            </div>

            <!-- Back to Login -->
            <div class="mt-6 text-center">
                <a href="{{ route('member.login') }}" class="text-sm text-gray-400 hover:text-accent transition-colors">
                    &larr; Back to Login
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

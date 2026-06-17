@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen flex items-center justify-center px-4 pt-28 pb-16">
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-8 shadow-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">Member Login</h1>
                <p class="text-gray-400 mt-2">Sign in to your member account</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                    <p class="text-green-400 text-sm text-center">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Error Message -->
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm text-center">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('member.login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Enter your email" required autofocus>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Enter your password" required>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-600 bg-dark-700 text-accent focus:ring-accent">
                        <span class="text-sm text-gray-400">Remember me</span>
                    </label>
                    <a href="{{ route('member.forgot-password') }}" class="text-sm text-accent hover:text-accent-light transition-colors">
                        Forgot Password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

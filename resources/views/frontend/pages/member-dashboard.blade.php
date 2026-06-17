@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-16 px-4 mt-30">
    <div class="max-w-3xl mx-auto">

        <!-- Impersonation Banner -->
        @if(session('impersonating_admin_id'))
            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-2xl p-4 mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <span class="text-yellow-300 text-sm font-medium">You are viewing this account as an admin.</span>
                </div>
                <form method="POST" action="{{ route('member.stop-impersonating') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500/20 border border-yellow-500/40 rounded-lg text-yellow-300 text-sm font-semibold hover:bg-yellow-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"/>
                        </svg>
                        Back to Admin
                    </button>
                </form>
            </div>
        @endif

        <!-- Payment Alerts -->
        @if($overdueCount > 0)
            <a href="{{ route('member.payments') }}"
               class="flex items-start gap-3 bg-red-500/10 border border-red-500/30 rounded-2xl p-4 mb-4 hover:bg-red-500/15 transition-all">
                <div class="w-9 h-9 rounded-xl bg-red-500/20 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-red-300 font-semibold text-sm">
                        {{ $overdueCount }} overdue payment{{ $overdueCount > 1 ? 's' : '' }}
                    </p>
                    <p class="text-red-400/70 text-xs mt-0.5">
                        Please settle your overdue installment{{ $overdueCount > 1 ? 's' : '' }} to avoid disruption to your membership.
                    </p>
                </div>
                <svg class="w-4 h-4 text-red-400/60 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif

        @if($pendingCount > 0)
            <a href="{{ route('member.payments') }}"
               class="flex items-start gap-3 bg-yellow-400/10 border border-yellow-400/30 rounded-2xl p-4 mb-4 hover:bg-yellow-400/15 transition-all">
                <div class="w-9 h-9 rounded-xl bg-yellow-400/20 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-yellow-300 font-semibold text-sm">
                        {{ $pendingCount }} payment{{ $pendingCount > 1 ? 's' : '' }} awaiting approval
                    </p>
                    <p class="text-yellow-400/70 text-xs mt-0.5">
                        Your submitted payment{{ $pendingCount > 1 ? 's are' : ' is' }} being reviewed by the admin.
                    </p>
                </div>
                <svg class="w-4 h-4 text-yellow-400/60 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif

        <!-- Profile Header -->
        <div class="bg-dark-800 rounded-2xl border border-white/10 overflow-hidden mb-6">
            <div class="flex flex-col items-center px-6 py-8">
                <div class="relative mb-4">
                    <div class="w-32 h-32 rounded-full border-4 border-accent/30 overflow-hidden bg-dark-600">
                        @if($user->profile?->photo)
                            <img src="{{ asset('storage/' . $user->profile->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                <p class="text-gray-400 mt-1">{{ $user->profile?->profession_organization ?? 'Member' }}</p>
                @if($user->profile?->membershipCategory)
                    <span class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        {{ $user->profile->membershipCategory->title }}
                    </span>
                @endif
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('member.profile', $user->id) }}" class="btn-outline px-6 py-2.5 text-sm rounded-xl" target="_blank">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Public Profile
                    </a>
                    <form method="POST" action="{{ route('member.logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl border-2 border-red-500/30 text-red-400 hover:bg-red-500/10 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Membership Details -->
        @if($user->profile?->membershipCategory)
            <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6">
                <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                    </svg>
                    Membership Details
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-dark-700 rounded-xl p-4 border border-white/5">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Category</p>
                        <p class="text-white font-semibold">{{ $user->profile->membershipCategory->title }}</p>
                    </div>
                    @if($user->profile->membershipCategory->duration)
                        <div class="bg-dark-700 rounded-xl p-4 border border-white/5">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Duration</p>
                            <p class="text-white font-semibold">{{ $user->profile->membershipCategory->duration }}</p>
                        </div>
                    @endif
                    @if($user->profile->membershipCategory->duration !== 'Lifetime')
                        <div class="bg-dark-700 rounded-xl p-4 border border-white/5">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Monthly Fee</p>
                            <p class="text-accent font-bold text-lg">৳{{ number_format($user->profile->membershipCategory->price, 2) }}</p>
                        </div>
                    @endif
                    <div class="bg-dark-700 rounded-xl p-4 border border-white/5">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Member Since</p>
                        <p class="text-white font-semibold">{{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                    @if($user->profile->membershipCategory->badge_text)
                        <div class="bg-dark-700 rounded-xl p-4 border border-white/5">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Badge</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-accent/10 border border-accent/20 text-accent text-sm font-medium">
                                {{ $user->profile->membershipCategory->badge_text }}
                            </span>
                        </div>
                    @endif
                </div>
                @if($user->profile->membershipCategory->features && count($user->profile->membershipCategory->features) > 0)
                    <div class="mt-5 pt-5 border-t border-white/5">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-3">Membership Benefits</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach($user->profile->membershipCategory->features as $feature)
                                <div class="flex items-center gap-2 text-sm text-gray-300">
                                    <svg class="w-4 h-4 text-accent shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $feature }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- ===================== PAYMENT QUICK ACCESS ===================== --}}
        @if($isOptionalInstallment)
        {{-- Optional: Donate button + history link --}}
        <div class="bg-dark-800 rounded-2xl border border-accent/20 p-5 mb-6">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Support The Club</p>
                        <p class="text-gray-400 text-sm">Your membership has no mandatory fees — donate if you wish</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <a href="{{ route('member.payments') }}"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-dark-700 border border-white/10 text-gray-300 text-sm font-semibold rounded-xl hover:border-accent/40 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Donation History
                    </a>
                    <a href="{{ route('member.payments') }}#donate"
                       class="inline-flex items-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-dark text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-accent/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Donate
                    </a>
                </div>
            </div>
        </div>
        @else
        <a href="{{ route('member.payments') }}"
           class="block bg-dark-800 rounded-2xl border border-white/10 p-5 mb-6 hover:border-accent/30 transition-all group">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center group-hover:bg-accent/20 transition-all">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Payment Timeline</p>
                        <p class="text-gray-400 text-sm">View & submit your monthly installments</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-500 group-hover:text-accent transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        @endif
        {{-- ===================== END PAYMENT QUICK ACCESS ===================== --}}

        {{-- ===================== ORDERS QUICK ACCESS ===================== --}}
        <a href="{{ route('member.orders') }}"
           class="block bg-dark-800 rounded-2xl border border-white/10 p-5 mb-6 hover:border-accent/30 transition-all group">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center group-hover:bg-accent/20 transition-all">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold">My Orders</p>
                        <p class="text-gray-400 text-sm">Track and review your shop orders</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-500 group-hover:text-accent transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        {{-- ===================== END ORDERS QUICK ACCESS ===================== --}}

        {{-- ===================== TAN SAMITI QUICK ACCESS ===================== --}}
        <a href="{{ route('member.tan-samiti.index') }}"
           class="block bg-dark-800 rounded-2xl border border-yellow-500/20 p-5 mb-6 hover:border-yellow-500/40 transition-all group">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center group-hover:bg-yellow-500/20 transition-all">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Investment Plan</p>
                        <p class="text-gray-400 text-sm">Join a savings circle &amp; track your installments</p>
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-500 group-hover:text-yellow-400 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
        {{-- ===================== END TAN SAMITI QUICK ACCESS ===================== --}}

        <!-- Edit Profile Section -->
        <div class="bg-dark-800 rounded-2xl border border-white/10 p-6 mb-6">
            <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Profile
            </h2>
            @if(session('profile_success'))
                <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                    <p class="text-green-400 text-sm">{{ session('profile_success') }}</p>
                </div>
            @endif
            <form method="POST" action="{{ route('member.dashboard.update-profile') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Profile Photo</label>
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 rounded-full overflow-hidden bg-dark-600 border-2 border-white/10 shrink-0">
                            @if($user->profile?->photo)
                                <img src="{{ asset('storage/' . $user->profile->photo) }}" alt="" class="w-full h-full object-cover" id="photo-preview">
                            @else
                                <div class="w-full h-full flex items-center justify-center" id="photo-placeholder">
                                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <img src="" alt="" class="w-full h-full object-cover hidden" id="photo-preview">
                            @endif
                        </div>
                        <div>
                            <input type="file" name="photo" id="photo-input" accept="image/*" class="hidden">
                            <label for="photo-input" class="inline-flex items-center gap-2 px-4 py-2 bg-dark-600 border border-white/10 rounded-lg text-sm text-gray-300 hover:border-accent/50 transition-all cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Change Photo
                            </label>
                            <p class="text-xs text-gray-500 mt-1">JPEG, PNG, GIF. Max 2MB.</p>
                        </div>
                    </div>
                    @error('photo')<p class="text-red-400 text-sm mt-2">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('name')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-gray-300 mb-2">Mobile</label>
                        <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $user->profile?->mobile) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('mobile')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="profession_organization" class="block text-sm font-medium text-gray-300 mb-2">Profession / Organization</label>
                        <input type="text" id="profession_organization" name="profession_organization" value="{{ old('profession_organization', $user->profile?->profession_organization) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('profession_organization')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-300 mb-2">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->profile?->date_of_birth?->format('Y-m-d')) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('date_of_birth')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="nid_passport" class="block text-sm font-medium text-gray-300 mb-2">NID / Passport</label>
                        <input type="text" id="nid_passport" name="nid_passport" value="{{ old('nid_passport', $user->profile?->nid_passport) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('nid_passport')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="mt-5">
                    <label for="address" class="block text-sm font-medium text-gray-300 mb-2">Address</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all resize-none" required>{{ old('address', $user->profile?->address) }}</textarea>
                    @error('address')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Social Media Links -->
                <div class="mt-8 pt-6 border-t border-white/10">
                    <h3 class="text-sm font-semibold text-gray-300 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        Social Media Links <span class="text-gray-500 font-normal">(Optional)</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-300 mb-2">Facebook URL</label>
                            <input type="url" id="facebook_url" name="facebook_url"
                                value="{{ old('facebook_url', $user->profile?->facebook_url) }}"
                                placeholder="https://facebook.com/yourprofile"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                            @error('facebook_url')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-300 mb-2">Instagram URL</label>
                            <input type="url" id="instagram_url" name="instagram_url"
                                value="{{ old('instagram_url', $user->profile?->instagram_url) }}"
                                placeholder="https://instagram.com/yourprofile"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                            @error('instagram_url')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="linkedin_url" class="block text-sm font-medium text-gray-300 mb-2">LinkedIn URL</label>
                            <input type="url" id="linkedin_url" name="linkedin_url"
                                value="{{ old('linkedin_url', $user->profile?->linkedin_url) }}"
                                placeholder="https://linkedin.com/in/yourprofile"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                            @error('linkedin_url')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-300 mb-2">Twitter / X URL</label>
                            <input type="url" id="twitter_url" name="twitter_url"
                                value="{{ old('twitter_url', $user->profile?->twitter_url) }}"
                                placeholder="https://twitter.com/yourprofile"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                            @error('twitter_url')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label for="youtube_url" class="block text-sm font-medium text-gray-300 mb-2">YouTube URL</label>
                            <input type="url" id="youtube_url" name="youtube_url"
                                value="{{ old('youtube_url', $user->profile?->youtube_url) }}"
                                placeholder="https://youtube.com/@yourchannel"
                                class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all">
                            @error('youtube_url')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn-primary px-8 py-3 text-sm">Save Profile</button>
                </div>
            </form>
        </div>

        <!-- Account Settings -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Change Email -->
            <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
                <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Change Email
                </h2>
                @if(session('email_success'))
                    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                        <p class="text-green-400 text-sm">{{ session('email_success') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('member.dashboard.update-email') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">New Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all" required>
                        @error('email')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-5">
                        <label for="current_password_email" class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                        <input type="password" id="current_password_email" name="current_password_email"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Enter current password" required>
                        @error('current_password_email')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-primary px-6 py-2.5 text-sm">Update Email</button>
                </form>
            </div>

            <!-- Change Password -->
            <div class="bg-dark-800 rounded-2xl border border-white/10 p-6">
                <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Change Password
                </h2>
                @if(session('password_success'))
                    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6">
                        <p class="text-green-400 text-sm">{{ session('password_success') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('member.dashboard.update-password') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Enter current password" required>
                        @error('current_password')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                        <input type="password" id="new_password" name="password"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Min 6 characters" required>
                        @error('password')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-5">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full bg-dark-700 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-accent focus:ring-1 focus:ring-accent outline-none transition-all"
                            placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn-primary px-6 py-2.5 text-sm">Update Password</button>
                </form>
            </div>
        </div>

    </div>
</section>

<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet">

<!-- Profile Photo Cropper Modal -->
<div id="cropper-modal" class="fixed inset-0 z-9999 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="bg-dark-800 border border-white/10 rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h3 class="text-white font-semibold text-lg flex items-center gap-2">
                <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Crop Profile Photo
            </h3>
            <button type="button" id="cropper-close" class="text-gray-400 hover:text-white transition-colors" aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-5">
            <p class="text-gray-400 text-xs mb-3 text-center">Drag to reposition &middot; scroll or use buttons to zoom. The circle is exactly how your photo will appear.</p>
            <div class="bg-black rounded-xl overflow-hidden" style="max-height: 60vh;">
                <img id="cropper-image" src="" alt="" style="max-width: 100%; display: block;">
            </div>
            <div class="flex items-center justify-center gap-2 mt-4">
                <button type="button" id="cropper-zoom-out" class="px-3 py-2 bg-dark-700 border border-white/10 rounded-lg text-gray-300 hover:border-accent/50 transition-all" title="Zoom out">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"/></svg>
                </button>
                <button type="button" id="cropper-zoom-in" class="px-3 py-2 bg-dark-700 border border-white/10 rounded-lg text-gray-300 hover:border-accent/50 transition-all" title="Zoom in">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m-3-3h6"/></svg>
                </button>
                <button type="button" id="cropper-rotate" class="px-3 py-2 bg-dark-700 border border-white/10 rounded-lg text-gray-300 hover:border-accent/50 transition-all" title="Rotate 90°">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-white/10 flex items-center justify-end gap-3">
            <button type="button" id="cropper-cancel" class="px-5 py-2.5 bg-dark-700 border border-white/10 rounded-lg text-sm text-gray-300 hover:border-white/30 transition-all">Cancel</button>
            <button type="button" id="cropper-save" class="btn-primary px-6 py-2.5 text-sm">Apply Crop</button>
        </div>
    </div>
</div>

<style>
    /* Force Cropper.js crop box to be circular */
    #cropper-modal .cropper-view-box,
    #cropper-modal .cropper-face {
        border-radius: 50%;
    }
    #cropper-modal .cropper-view-box {
        outline: 2px solid rgba(255, 255, 255, 0.85);
        box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.55);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script>
(function () {
    const input       = document.getElementById('photo-input');
    const modal       = document.getElementById('cropper-modal');
    const image       = document.getElementById('cropper-image');
    const closeBtn    = document.getElementById('cropper-close');
    const cancelBtn   = document.getElementById('cropper-cancel');
    const saveBtn     = document.getElementById('cropper-save');
    const zoomInBtn   = document.getElementById('cropper-zoom-in');
    const zoomOutBtn  = document.getElementById('cropper-zoom-out');
    const rotateBtn   = document.getElementById('cropper-rotate');

    let cropper = null;
    let baseFileName = 'profile';

    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function teardownCropper() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    function hideModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        teardownCropper();
    }

    function cancelModal() {
        // Cancel = discard selection so the same file can be re-picked
        input.value = '';
        hideModal();
    }

    input.addEventListener('change', function (e) {
        const file = e.target.files && e.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('Please choose an image file.');
            input.value = '';
            return;
        }

        // 2MB limit mirrors the server-side validation
        if (file.size > 2 * 1024 * 1024) {
            alert('Image must be 2MB or less.');
            input.value = '';
            return;
        }

        baseFileName = (file.name || 'profile').replace(/\.[^.]+$/, '') || 'profile';

        const reader = new FileReader();
        reader.onload = function (ev) {
            teardownCropper();
            image.src = ev.target.result;
            openModal();

            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.9,
                cropBoxMovable: false,
                cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
                background: false,
                guides: false,
                center: false,
                highlight: false,
                responsive: true,
                restore: false,
            });
        };
        reader.readAsDataURL(file);
    });

    closeBtn.addEventListener('click', cancelModal);
    cancelBtn.addEventListener('click', cancelModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) cancelModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            cancelModal();
        }
    });

    zoomInBtn.addEventListener('click', function () { if (cropper) cropper.zoom(0.1); });
    zoomOutBtn.addEventListener('click', function () { if (cropper) cropper.zoom(-0.1); });
    rotateBtn.addEventListener('click', function () { if (cropper) cropper.rotate(90); });

    saveBtn.addEventListener('click', function () {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 512,
            height: 512,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
            fillColor: '#000',
        });
        if (!canvas) return;

        canvas.toBlob(function (blob) {
            if (!blob) return;

            const croppedFile = new File([blob], baseFileName + '.jpg', { type: 'image/jpeg' });
            const dt = new DataTransfer();
            dt.items.add(croppedFile);
            input.files = dt.files;

            const preview     = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            if (placeholder) placeholder.classList.add('hidden');
            preview.src = URL.createObjectURL(blob);
            preview.classList.remove('hidden');

            // Close without clearing input.files (we just populated it)
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
            teardownCropper();
        }, 'image/jpeg', 0.92);
    });
})();
</script>
@endsection

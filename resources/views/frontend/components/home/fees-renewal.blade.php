<!-- Fees and Renewal Policy Section -->
<section id="fees" class="py-24 lg:py-32 bg-dark-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(15, 112, 191, 0.15) 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-up">
            <span class="section-caption">Investment</span>
            <h2 class="section-title">Fees and Renewal Policy</h2>
            <p class="section-text">
                The membership fees of The Bengal Club are determined by category and approved by the Executive Committee
            </p>
        </div>

        <div class="max-w-5xl mx-auto reveal-up">
            <!-- Fee Structure Table -->
            <div class="bg-dark-700 border border-accent/20 rounded-xl overflow-hidden">
                <!-- Table Header -->
                <div class="bg-dark-800 border-b border-accent/20 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 text-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Current Fee Structure
                    </h3>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-dark-800/50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent uppercase tracking-wider">
                                    Membership Category
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent uppercase tracking-wider">
                                    Membership Fee
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent uppercase tracking-wider">
                                    Installment
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-accent uppercase tracking-wider">
                                    Renewal Policy
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-accent/10">
                            @forelse($membershipCategories as $category)
                            <tr class="hover:bg-dark-800/50 transition-colors duration-200">

                                {{-- Category Name --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-white font-semibold block">{{ $category->title }}</span>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @if($category->badge_text)
                                                    <span class="inline-block text-xs px-2 py-0.5 rounded-full bg-accent/20 text-accent border border-accent/30">
                                                        {{ $category->badge_text }}
                                                    </span>
                                                @endif
                                                @if($category->is_invite_only)
                                                    <span class="inline-block text-xs px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                                        Invite Only
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Membership Fee --}}
                                <td class="px-6 py-5">
                                    <span class="text-2xl font-bold text-accent">
                                        ৳ {{ number_format($category->price, 0) }}
                                    </span>
                                    <span class="block text-xs text-gray-500 mt-0.5">One-time fee</span>
                                </td>

                                {{-- Installment --}}
                                <td class="px-6 py-5">
                                    @if($category->duration === 'Lifetime' || (float)$category->installment_price === 0.0)
                                        <span class="text-gray-500 font-medium">—</span>
                                        <span class="block text-xs text-gray-600 mt-0.5">No installments</span>
                                    @else
                                        <span class="text-xl font-bold text-white">
                                            ৳ {{ number_format($category->installment_price, 0) }}
                                        </span>
                                        <span class="block text-xs text-gray-400 mt-0.5">
                                            per {{ $category->duration === 'Monthly' ? 'month' : 'year' }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Renewal Policy --}}
                                <td class="px-6 py-5">
                                    @if($category->duration === 'Lifetime')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Lifetime — No Renewal
                                        </span>
                                    @elseif($category->duration === 'Yearly')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            Annual Renewal
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-500/10 text-orange-400 border border-orange-500/20">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Monthly Renewal
                                        </span>
                                    @endif
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    No membership categories available.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="mt-8 grid md:grid-cols-2 gap-6 reveal-up" style="animation-delay: 0.2s">
                <div class="bg-dark-700 border border-accent/20 rounded-xl p-6">
                    <h4 class="text-lg font-bold text-white mb-3 flex items-center">
                        <svg class="w-5 h-5 text-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Payment Terms
                    </h4>
                    <ul class="space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>All fees are subject to approval by the Executive Committee</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>Payment methods: Bank transfer, Cash, or Cheque</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>Fees are non-refundable once approved</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-dark-700 border border-accent/20 rounded-xl p-6">
                    <h4 class="text-lg font-bold text-white mb-3 flex items-center">
                        <svg class="w-5 h-5 text-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Renewal Reminders
                    </h4>
                    <ul class="space-y-2 text-gray-300 text-sm">
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>Renewals due on membership anniversary date</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>Grace period of 30 days for late renewals</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-accent mr-2">•</span>
                            <span>Membership may be suspended after grace period expires</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

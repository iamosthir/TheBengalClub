@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-20 px-4 flex items-center justify-center">
    <div class="max-w-lg w-full text-center">

        <div class="bg-dark-800 border border-white/10 rounded-2xl p-10">

            {{-- Success icon --}}
            <div class="w-20 h-20 rounded-full bg-green-500/15 border border-green-500/30 flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white mb-3">Order Placed!</h1>
            <p class="text-gray-400 mb-6">
                Thank you for your order, <strong class="text-white">{{ $order->full_name }}</strong>.<br>
                We'll process it and get back to you at <strong class="text-accent">{{ $order->email }}</strong>.
            </p>

            {{-- Order summary --}}
            <div class="bg-dark-700 rounded-xl p-5 text-left space-y-3 mb-8">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Order #</span>
                    <span class="text-white font-mono font-bold">{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Items</span>
                    <span class="text-white">
                        @foreach($order->items as $item)
                            {{ $item->product?->title ?? 'Product' }}@if(!$loop->last), @endif
                        @endforeach
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Total Paid</span>
                    <span class="text-accent font-bold text-base">৳{{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Status</span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-yellow-400/15 border border-yellow-400/30 text-yellow-400 text-xs font-semibold">
                        Pending Review
                    </span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Ship to</span>
                    <span class="text-white text-right max-w-48">{{ $order->shipping_address }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('shop') }}"
                   class="btn-outline px-6 py-3 text-sm">
                    Continue Shopping
                </a>
                @auth
                    <a href="{{ route('member.orders') }}"
                       class="btn-primary px-6 py-3 text-sm">
                        Track My Orders
                    </a>
                @endauth
            </div>

        </div>
    </div>
</section>
@endsection

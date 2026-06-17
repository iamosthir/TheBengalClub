@extends('frontend.layouts.master')

@section('page_title', 'My Orders')

@section('content')
<section class="min-h-screen pt-28 pb-20 px-4 mt-8">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-white">My Orders</h1>
                <p class="text-gray-400 text-sm mt-1">Track and review your shop orders</p>
            </div>
            <a href="{{ route('shop') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 border border-white/10 rounded-xl text-gray-300 hover:text-white hover:border-accent/40 transition-all text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Shop
            </a>
        </div>

        @if($orders->isEmpty())
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <div class="w-20 h-20 rounded-full bg-dark-700 border border-white/10 flex items-center justify-center mb-5">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">No orders yet</h3>
                <p class="text-gray-500 text-sm mb-6">You haven't placed any orders. Visit our shop to get started.</p>
                <a href="{{ route('shop') }}" class="btn-primary px-6 py-3 text-sm">Browse Shop</a>
            </div>
        @else

        {{-- Orders list --}}
        <div class="space-y-4">
            @foreach($orders as $order)
            @php
                $statusConfig = match($order->status) {
                    'pending'    => ['label' => 'Pending',    'bg' => 'bg-yellow-400/10', 'border' => 'border-yellow-400/30', 'text' => 'text-yellow-400',  'dot' => 'bg-yellow-400'],
                    'processing' => ['label' => 'Processing', 'bg' => 'bg-blue-400/10',   'border' => 'border-blue-400/30',   'text' => 'text-blue-400',    'dot' => 'bg-blue-400'],
                    'shipped'    => ['label' => 'Shipped',    'bg' => 'bg-indigo-400/10', 'border' => 'border-indigo-400/30', 'text' => 'text-indigo-400',  'dot' => 'bg-indigo-400'],
                    'delivered'  => ['label' => 'Delivered',  'bg' => 'bg-green-400/10',  'border' => 'border-green-400/30',  'text' => 'text-green-400',   'dot' => 'bg-green-400'],
                    'cancelled'  => ['label' => 'Cancelled',  'bg' => 'bg-red-400/10',    'border' => 'border-red-400/30',    'text' => 'text-red-400',     'dot' => 'bg-red-400'],
                    default      => ['label' => ucfirst($order->status), 'bg' => 'bg-gray-400/10', 'border' => 'border-gray-400/30', 'text' => 'text-gray-400', 'dot' => 'bg-gray-400'],
                };
            @endphp
            <div class="bg-dark-800 border border-white/8 rounded-2xl overflow-hidden hover:border-white/15 transition-colors">

                {{-- Order header --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-white/6">
                    <div class="flex items-center gap-4">
                        <div>
                            <span class="text-white font-bold font-mono text-sm">
                                #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="text-gray-500 text-xs ml-2">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['border'] }} border {{ $statusConfig['text'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                        {{ $statusConfig['label'] }}
                    </span>
                </div>

                {{-- Order body --}}
                <div class="px-5 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">

                        {{-- Product list --}}
                        <div class="flex-1 space-y-3">
                            @foreach($order->items as $item)
                            <div class="flex items-center gap-3">
                                {{-- Product image --}}
                                <div class="w-14 h-14 rounded-xl bg-dark-700 border border-white/8 overflow-hidden shrink-0">
                                    @if($item->product?->image_path)
                                        <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                             alt="{{ $item->product->title }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-white font-medium text-sm truncate">
                                        {{ $item->product?->title ?? 'Product (removed)' }}
                                    </p>
                                    <p class="text-gray-500 text-xs mt-0.5">
                                        Qty: {{ $item->quantity }} &nbsp;·&nbsp; ৳{{ number_format($item->unit_price, 2) }} each
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Right: pricing + info --}}
                        <div class="sm:text-right sm:shrink-0 space-y-2 sm:min-w-40">
                            <div>
                                <p class="text-xs text-gray-500">Subtotal</p>
                                <p class="text-white text-sm">৳{{ number_format($order->subtotal, 2) }}</p>
                            </div>
                            @if($order->delivery_charge > 0)
                            <div>
                                <p class="text-xs text-gray-500">Delivery</p>
                                <p class="text-white text-sm">৳{{ number_format($order->delivery_charge, 2) }}</p>
                            </div>
                            @endif
                            <div class="pt-1 border-t border-white/8">
                                <p class="text-xs text-gray-500">Total</p>
                                <p class="text-accent font-bold text-lg">৳{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Shipping + payment row --}}
                    <div class="mt-4 pt-4 border-t border-white/6 grid sm:grid-cols-2 gap-3 text-xs">
                        <div class="flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <span class="text-gray-500 block">Ships to</span>
                                <span class="text-gray-300">{{ Str::limit($order->shipping_address, 60) }}</span>
                            </div>
                        </div>
                        @if($order->paymentMethod)
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <div>
                                <span class="text-gray-500 block">Payment</span>
                                <span class="text-gray-300">{{ $order->paymentMethod->name }} · {{ $order->transaction_id }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Admin note --}}
                    @if($order->admin_notes)
                    <div class="mt-3 flex items-start gap-2 px-3 py-2.5 bg-accent/5 border border-accent/20 rounded-xl">
                        <svg class="w-3.5 h-3.5 text-accent mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        <p class="text-accent/80 text-xs leading-relaxed">
                            <strong class="text-accent">Note from us:</strong> {{ $order->admin_notes }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
        <div class="mt-8 flex justify-center gap-2">
            @if($orders->onFirstPage())
                <span class="px-4 py-2 rounded-xl bg-dark-700 border border-white/8 text-gray-600 text-sm cursor-not-allowed">← Prev</span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 rounded-xl bg-dark-700 border border-white/10 text-gray-300 hover:text-white hover:border-accent/30 text-sm transition-colors">← Prev</a>
            @endif

            <span class="px-4 py-2 rounded-xl bg-dark-700 border border-white/8 text-gray-400 text-sm">
                Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}
            </span>

            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="px-4 py-2 rounded-xl bg-dark-700 border border-white/10 text-gray-300 hover:text-white hover:border-accent/30 text-sm transition-colors">Next →</a>
            @else
                <span class="px-4 py-2 rounded-xl bg-dark-700 border border-white/8 text-gray-600 text-sm cursor-not-allowed">Next →</span>
            @endif
        </div>
        @endif

        @endif
    </div>
</section>
@endsection

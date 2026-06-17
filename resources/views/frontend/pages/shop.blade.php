@extends("frontend.layouts.master")

@section("content")
<section class="min-h-screen pt-28 pb-20 px-4 mt-30">
    <div class="max-w-6xl mx-auto">

        {{-- Page Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-3">Our Shop</h1>
            <p class="text-gray-400 max-w-xl mx-auto">
                Official membership cards, certificates, and exclusive club merchandise.
            </p>
        </div>

        @if($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <p class="text-gray-400 text-lg">No products available yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div class="bg-dark-800 border border-white/10 rounded-2xl overflow-hidden flex flex-col hover:border-accent/30 transition-all group">

                        {{-- Image --}}
                        <div class="relative overflow-hidden bg-dark-700" style="aspect-ratio:4/3;">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="text-white font-bold text-lg mb-2 group-hover:text-accent transition-colors">
                                {{ $product->title }}
                            </h2>
                            @if($product->description)
                                <p class="text-gray-400 text-sm leading-relaxed mb-4 flex-1">
                                    {{ Str::limit($product->description, 120) }}
                                </p>
                            @else
                                <div class="flex-1"></div>
                            @endif

                            {{-- Pricing --}}
                            <div class="border-t border-white/5 pt-4 mt-2">
                                <div class="flex items-end justify-between mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-0.5">Price</p>
                                        <p class="text-accent font-extrabold text-2xl">৳{{ number_format($product->price, 2) }}</p>
                                    </div>
                                    @if($product->delivery_charge > 0)
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-0.5">Delivery</p>
                                            <p class="text-gray-300 font-semibold">৳{{ number_format($product->delivery_charge, 2) }}</p>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-semibold">
                                            Free Delivery
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('shop.order', $product) }}"
                                   class="btn-primary w-full flex items-center justify-center gap-2 py-3 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Order Now
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection

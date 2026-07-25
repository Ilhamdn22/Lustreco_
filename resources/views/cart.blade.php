@extends('layouts.store')

@section('title', 'lustreco® | Cart')
@section('navbar_style', 'sticky')

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
</style>
@endpush

@section('content')

    <div class="w-full max-w-[1000px] mx-auto px-4 sm:px-6 py-12 flex flex-col items-center">
        <!-- Cart Title -->
        <h1 class="text-[22px] font-bold mb-14 self-start">Cart</h1>

        @if(session('success'))
        <div class="w-full mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <!-- Cart Items -->
        <div class="w-full mb-16">
            @if(empty($cart))
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <i class="fa-solid fa-bag-shopping text-5xl text-gray-200 mb-6"></i>
                    <h2 class="text-xl font-semibold text-gray-400 mb-2">Your cart is empty</h2>
                    <p class="text-sm text-gray-400 mb-8">Looks like you haven't added anything yet.</p>
                    <a href="{{ url('/products') }}" class="px-8 py-3.5 bg-black text-white rounded-xl text-sm font-medium hover:bg-gray-800 transition">Shop Now</a>
                </div>
            @else
                @foreach($cart as $key => $item)
                <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-32 bg-gray-100 rounded-md overflow-hidden flex-shrink-0">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h2 class="text-[15px] font-medium mb-1">{{ $item['name'] }}</h2>
                            <p class="text-[13px] text-gray-500 mb-3">Size: {{ $item['size'] ?? 'One Size' }}</p>
                            <span class="text-sm font-medium">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-4">
                        <!-- Remove button -->
                        <form method="POST" action="{{ route('cart.remove', $key) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                <i class="fa-solid fa-trash text-sm"></i>
                            </button>
                        </form>
                        <!-- Quantity update -->
                        <form method="POST" action="{{ route('cart.update', $key) }}" class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="px-3 py-1.5 hover:bg-gray-50 text-sm font-medium">−</button>
                            <span class="px-3 text-sm font-medium">{{ $item['quantity'] }}</span>
                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1.5 hover:bg-gray-50 text-sm font-medium">+</button>
                        </form>
                    </div>
                </div>
                @endforeach

                <!-- Cart Summary & Checkout -->
                <div class="flex flex-col items-end w-full mt-8">
                    <div class="w-full max-w-sm">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[15px] font-medium">Subtotal</span>
                            <span class="text-[18px] font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-[13px] text-gray-500 mb-6 text-right">Shipping & taxes calculated at checkout.</p>
                        <a href="{{ route('checkout') }}" class="w-full block text-center px-8 py-4 bg-black text-white rounded-[12px] text-sm font-bold hover:bg-gray-800 transition">Proceed to Checkout</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Recently Ordered -->
        @if($products->isNotEmpty())
        <div class="w-full">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-[14px] text-gray-800">Recently Ordered</h3>
                <div class="flex space-x-3 text-gray-600">
                    <button class="hover:text-black focus:outline-none"><i class="fa-solid fa-chevron-left text-[10px]"></i></button>
                    <span class="text-[10px]">|</span>
                    <button class="hover:text-black focus:outline-none"><i class="fa-solid fa-chevron-right text-[10px]"></i></button>
                </div>
            </div>

            <!-- Carousel Container -->
            <div class="flex space-x-5 overflow-x-auto pb-6 scrollbar-hide snap-x pt-2" style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($products as $index => $product)
                <!-- Product Card -->
                <a href="{{ url('/products/' . $product->id) }}" class="w-[180px] flex-shrink-0 snap-start group">
                    <div class="relative mb-3 bg-white flex items-center justify-center aspect-[4/5] rounded-sm group cursor-pointer">
                        <!-- Image -->
                        <img src="{{ $product->image ?? 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=f3f4f6&color=9ca3af&size=200' }}" alt="{{ $product->name }}" class="object-cover w-full h-full rounded-sm">

                        @if($index < 2)
                        <!-- Low Stock Badge -->
                        <div class="absolute bottom-2 left-2 bg-black text-white text-[9px] px-1.5 py-0.5 rounded-sm">
                            Low Stock
                        </div>
                        @endif

                        <!-- Add to bag button -->
                        <form action="{{ route('cart.add') }}" method="POST" class="absolute -bottom-3 -right-1 z-10" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="bg-white w-7 h-7 rounded-[4px] shadow-sm border border-gray-100 flex items-center justify-center text-black hover:bg-gray-50 transition focus:outline-none">
                                <span class="relative inline-block">
                                    <i class="fa-solid fa-bag-shopping text-[11px]"></i>
                                    <i class="fa-solid fa-plus text-[6px] absolute -bottom-0.5 -right-0.5 bg-white rounded-full"></i>
                                </span>
                            </button>
                        </form>
                    </div>
                    <div>
                        <h4 class="text-[12px] font-medium text-gray-900 leading-tight mb-0.5 line-clamp-2">{{ $product->name }}</h4>
                        <p class="text-[11px] text-gray-500 mb-0.5">Lustreco</p>
                        <p class="text-[12px] font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

@endsection
{{-- resources/views/checkout.blade.php --}}
@extends('layouts.store')

@section('title', 'Checkout | lustreco®')

@section('navbar_style', 'sticky')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    @if(isset($items) && $items->count() > 0)
        <div class="flex items-center gap-3 mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Checkout</h1>
            <span class="text-sm text-gray-400">| {{ $items->sum('quantity') }} item(s)</span>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Left Column: Forms --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Shipping Details --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Details</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Recipient Name</label>
                                <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name ?? '') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-black focus:ring-1 focus:ring-black outline-none transition"
                                       placeholder="Full name" required>
                                @error('recipient_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-black focus:ring-1 focus:ring-black outline-none transition"
                                       placeholder="08xxx" required>
                                @error('phone') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                                <textarea name="shipping_address" rows="3"
                                          class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-black focus:ring-1 focus:ring-black outline-none transition resize-none"
                                          placeholder="Street, district, city, postal code" required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                                <select name="payment_method"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:border-black focus:ring-1 focus:ring-black outline-none transition"
                                        required>
                                    <option value="">Select payment method</option>
                                    <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer (BCA/Mandiri)</option>
                                    <option value="QRIS" {{ old('payment_method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                    <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit / Debit Card</option>
                                    <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (OVO, GoPay, DANA)</option>
                                </select>
                                @error('payment_method') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Order Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>

                        {{-- Items --}}
                        <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                            @foreach($items as $item)
                                <div class="flex gap-3 border-b border-gray-100 pb-3">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-contain bg-gray-50 rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 line-clamp-2">{{ $item['name'] }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                        <p class="text-sm font-semibold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Total --}}
                        <div class="border-t border-gray-200 pt-4 mt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-green-600 font-medium">Free</span>
                            </div>
                            <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Place Order Button --}}
                        <button type="submit" class="w-full bg-black text-white text-sm font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition mt-4 shadow-lg shadow-black/20">
                            <i class="fa-solid fa-lock mr-2"></i> Place Order
                        </button>

                        <p class="text-xs text-gray-400 text-center mt-3">
                            <i class="fa-solid fa-shield-halved mr-1"></i> Your payment is secure
                        </p>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="text-center py-16">
            <i class="fa-solid fa-cart-shopping text-4xl text-gray-300 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-700">Your cart is empty</h2>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800 transition">Continue Shopping</a>
        </div>
    @endif
</div>
@endsection
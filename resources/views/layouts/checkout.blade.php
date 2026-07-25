@extends('layouts.checkout')

@section('title', 'lustreco® | Checkout')

@section('content')

<form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    <main class="flex-grow max-w-[1100px] mx-auto w-full px-4 sm:px-6 py-10 flex flex-col lg:flex-row gap-12">

        <!-- Left Column: Forms -->
        <div class="w-full lg:w-3/5 space-y-10">

            <!-- Address Details -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Address Details</h2>
                @guest
                <p class="text-[14px] text-gray-700 mb-6">Do you have a account? <a href="{{ route('login') }}" class="font-medium underline hover:text-black transition">Login</a></p>
                @endguest

                @if($errors->any())
                <div class="mb-4 text-[13px] text-red-700 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="Email Address (Optional)" class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">
                        <p class="text-[11px] text-gray-500 mt-1.5 ml-1">We will send your order details to your email.</p>
                    </div>

                    <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name ?? '') }}" placeholder="Recipient Full Name" required class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">

                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Recipient Phone Number" required class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">

                    <div class="relative">
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition appearance-none bg-white text-gray-900 cursor-pointer pt-6 pb-2">
                            <option>Indonesia</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[10px] text-gray-600 pointer-events-none"></i>
                        <span class="absolute left-4 top-2 text-[10px] text-gray-400">Country</span>
                    </div>

                    <div class="relative">
                        <input type="text" name="sub_district" value="{{ old('sub_district') }}" placeholder="Sub-district, District, City" class="w-full border border-gray-200 rounded-xl pl-4 pr-10 py-3.5 text-[14px] outline-none focus:border-black transition">
                        <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <textarea name="shipping_address" placeholder="Address Details" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition resize-none">{{ old('shipping_address') }}</textarea>
                </div>
            </div>

            <!-- Shipment Method -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Shipment Method</h2>
                <div class="bg-gray-100 rounded-xl p-4 text-[13px] text-gray-500">
                    Complete address detail to see available shipping methods.
                </div>
            </div>

            <!-- Payment Method -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Payment Method</h2>
                <div class="space-y-3">
                    @foreach([
                        'Bank Transfer - Mandiri' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_of_Bank_Mandiri.svg',
                        'Bank Transfer - BCA' => null,
                        'QRIS' => null,
                    ] as $method => $logo)
                    <label class="border border-gray-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:border-gray-400 transition bg-white has-[:checked]:border-black has-[:checked]:ring-1 has-[:checked]:ring-black">
                        <input type="radio" name="payment_method" value="{{ $method }}" class="mr-3" {{ old('payment_method') === $method ? 'checked' : '' }} required>
                        @if($logo)
                            <img src="{{ $logo }}" alt="{{ $method }}" class="h-5 object-contain">
                        @else
                            <span class="text-[14px] text-gray-800">{{ $method }}</span>
                        @endif
                        <span class="flex-grow"></span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-500"></i>
                    </label>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Right Column: Order Summary -->
        <div class="w-full lg:w-2/5">
            <div class="sticky top-24 space-y-6">

                <!-- Product Cards -->
                <div class="space-y-3">
                    @foreach($items as $item)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-start space-x-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-md border border-gray-100 flex items-center justify-center flex-shrink-0">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded-md p-1">
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-[13px] font-medium text-gray-900 leading-tight mb-1 pr-4">{{ $item['name'] }}</h3>
                            <p class="text-[11px] text-gray-500 mb-1">Lustreco</p>
                            <p class="text-[11px] text-gray-500 mb-2">Quantity: {{ $item['quantity'] }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="text-[13px] font-medium text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Extras -->
                <div class="space-y-3">
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex justify-between items-center cursor-pointer hover:border-gray-300 transition text-[13px] text-gray-600">
                        <span>Leave a message for delivery (Optional)</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex justify-between items-center cursor-pointer hover:border-gray-300 transition text-[13px] text-gray-600">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-ticket text-gray-400"></i>
                            <span>Vouchers</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    </div>
                </div>

                <!-- Summary -->
                <div class="pt-2">
                    <div class="flex justify-between items-center mb-3 text-[14px]">
                        <span class="text-gray-600">Subtotal <span class="text-gray-400 text-[12px]">• {{ $items->sum('quantity') }} Items</span></span>
                        <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 text-[14px]">
                        <span class="text-gray-600">Shipping</span>
                        <span class="text-gray-400">-</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 text-[14px]">
                        <span class="font-bold text-gray-900">Total Payment</span>
                        <span class="font-bold text-[16px] text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex items-center justify-center space-x-1.5 text-[11px] text-gray-500 mb-6">
                        <i class="fa-solid fa-lock"></i>
                        <span>Secure Payment | Your payment is encrypted.</span>
                    </div>

                    <div class="bg-[#F3F4F8] text-[12px] text-gray-600 p-4 rounded-xl leading-relaxed mb-6">
                        Import duty or tax might be charged depending on your delivery country.
                    </div>

                    <button type="submit" class="block w-full bg-black text-white font-medium text-center py-3.5 rounded-xl hover:bg-gray-800 transition shadow-md mb-3 text-[14px]">
                        Order Now
                    </button>

                    <p class="text-[11px] text-gray-500 text-center">
                        By placing your order, you agree to our <a href="#" class="underline hover:text-black">Terms & Conditions</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
</form>

@endsection
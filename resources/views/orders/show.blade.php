@extends('layouts.store')

@section('title', 'Order #' . $order->id . ' | lustreco®')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
            <span class="text-sm font-semibold px-3 py-1 rounded-full
                @if($order->status == 'completed') bg-green-100 text-green-700
                @elseif($order->status == 'processing') bg-yellow-100 text-yellow-700
                @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                @else bg-gray-100 text-gray-700 @endif">
                {{ ucfirst($order->status ?? 'Pending') }}
            </span>
        </div>
        <p class="text-sm text-gray-500">Order Date: {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p class="text-sm text-gray-500">Payment Method: {{ $order->payment_method }}</p>

        <div class="border-t border-gray-200 my-6"></div>

        <h3 class="font-semibold mb-3">Items</h3>
        <div class="space-y-3">
            @foreach($order->items as $item)
                <div class="flex items-center gap-4 border-b border-gray-100 pb-3">
                    <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="w-16 h-16 object-contain bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p class="text-sm font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <div class="border-t border-gray-200 mt-6 pt-4 flex justify-end">
            <div class="text-right">
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-xl font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
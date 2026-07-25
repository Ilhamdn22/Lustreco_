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

        {{-- Payment Status Section --}}
        <div class="flex flex-col md:flex-row justify-between gap-4 mt-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Payment Status</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-sm font-bold @if($order->payment_status == 'success') text-green-600 @else text-yellow-600 @endif">
                        {{ strtoupper($order->payment_status ?? 'PENDING') }}
                    </span>
                </div>
            </div>
            @if($order->payment_status == 'pending')
                <div class="flex flex-wrap gap-2 items-center">
                    <button id="pay-button" class="bg-black text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-gray-800 transition shadow-md">
                        <i class="fa-solid fa-credit-card mr-2"></i> Pay Now
                    </button>
                    <a href="{{ route('payment.simulate-success', $order) }}" class="bg-white border border-gray-300 text-gray-700 text-xs font-medium px-4 py-2.5 rounded-full hover:bg-gray-50 transition">
                        <i class="fa-solid fa-circle-check text-green-500 mr-1.5"></i> Simulate Success (Local Dev)
                    </a>
                </div>
            @endif
        </div>

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
                    <p class="text-sm font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
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

@push('scripts')
@if(config('services.midtrans.is_production'))
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endif
<script>
    const payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', function () {
            // Disable button
            payButton.disabled = true;
            payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Generating transaction...';

            // Ambil snap token dari backend
            fetch("{{ route('payment.snap-token', $order) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        snap.pay(data.snap_token, {
                            onSuccess: function (result) {
                                window.location.reload();
                            },
                            onPending: function (result) {
                                window.location.reload();
                            },
                            onError: function (result) {
                                alert("Pembayaran gagal!");
                                payButton.disabled = false;
                                payButton.innerHTML = '<i class="fa-solid fa-credit-card mr-2"></i> Pay Now';
                            },
                            onClose: function () {
                                payButton.disabled = false;
                                payButton.innerHTML = '<i class="fa-solid fa-credit-card mr-2"></i> Pay Now';
                            }
                        });
                    } else {
                        alert(data.error || 'Gagal memulai pembayaran.');
                        payButton.disabled = false;
                        payButton.innerHTML = '<i class="fa-solid fa-credit-card mr-2"></i> Pay Now';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan.');
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="fa-solid fa-credit-card mr-2"></i> Pay Now';
                });
        });
    }
</script>
@endpush
@endsection
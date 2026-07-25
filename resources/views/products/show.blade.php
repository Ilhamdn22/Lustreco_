{{-- resources/views/products/show.blade.php --}}
@extends('layouts.store') {{-- atau 'layouts.app' --}}

@section('title', $product->name . ' | lustreco®')

@section('content')
<div class="flex-grow w-full max-w-[1200px] mx-auto px-4 sm:px-6 py-12 flex flex-col lg:flex-row gap-12">
    <!-- Left: Images -->
    <div class="w-full lg:w-3/5 flex flex-col">
        <div class="w-full bg-white border border-gray-100 rounded-sm mb-4 flex items-center justify-center p-8 aspect-square lg:aspect-[4/3]">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="object-contain w-full h-full max-h-[600px]">
        </div>
        <div class="flex space-x-4">
            <div class="w-24 h-24 border-2 border-black rounded-sm flex items-center justify-center p-2 cursor-pointer">
                <img src="{{ $product->image }}" alt="Thumbnail 1" class="object-contain w-full h-full">
            </div>
            <div class="w-24 h-24 border border-gray-200 rounded-sm flex items-center justify-center p-2 cursor-pointer opacity-70 hover:opacity-100 transition">
                <img src="{{ $product->image }}" alt="Thumbnail 2" class="object-contain w-full h-full">
            </div>
        </div>
    </div>

    <!-- Right: Details -->
    <div class="w-full lg:w-2/5 flex flex-col">
        <div class="mb-4">
            <span class="inline-block bg-black text-white text-[11px] font-bold px-2 py-1 mb-4">In Stock</span>
            <h1 class="text-[24px] text-gray-900 leading-tight mb-4 pr-8">{{ $product->name }}</h1>
            <div class="flex items-center justify-between mb-8">
                <span class="text-[15px] font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <button class="text-gray-400 hover:text-red-500 transition focus:outline-none">
                    <i class="fa-regular fa-heart text-xl"></i>
                </button>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-[14px] text-gray-900 mb-3">Size</label>
            <div class="flex flex-wrap gap-3" id="size-selector">
                <button type="button" class="size-btn px-5 py-2 border border-gray-200 text-sm hover:border-black transition focus:outline-none" data-size="S">S</button>
                <button type="button" class="size-btn px-5 py-2 border border-gray-200 text-sm hover:border-black transition focus:outline-none" data-size="M">M</button>
                <button type="button" class="size-btn px-5 py-2 border border-gray-200 text-sm hover:border-black transition focus:outline-none" data-size="L">L</button>
                <button type="button" class="size-btn px-5 py-2 border border-gray-200 text-sm hover:border-black transition focus:outline-none" data-size="XL">XL</button>
            </div>
            <p id="size-warning" class="text-red-500 text-[12px] mt-2 hidden">Please select a size first.</p>
        </div>

        <div class="flex items-center space-x-0 border border-gray-200 w-fit mb-8 rounded-sm">
            <button type="button" class="px-4 py-2 text-gray-600 hover:text-black transition focus:outline-none" onclick="document.getElementById('qty').value = Math.max(1, parseInt(document.getElementById('qty').value) - 1)">
                <i class="fa-solid fa-minus text-[11px]"></i>
            </button>
            <input id="qty" type="text" value="1" class="w-12 text-center text-sm font-medium py-2 outline-none border-x border-gray-200" readonly>
            <button type="button" class="px-4 py-2 text-gray-600 hover:text-black transition focus:outline-none" onclick="document.getElementById('qty').value = parseInt(document.getElementById('qty').value) + 1">
                <i class="fa-solid fa-plus text-[11px]"></i>
            </button>
        </div>

        <div class="flex flex-col space-y-3 mb-10">
            <form id="cart-form" method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" id="selected-size" value="">
                <input type="hidden" name="quantity" id="form-qty" value="1">
                <button type="submit" id="add-to-cart-btn" class="w-full border border-black bg-white text-black text-center py-3.5 font-medium text-sm hover:bg-gray-50 transition rounded-xl">
                    Add to Cart
                </button>
            </form>
            <button type="button" id="buy-it-now-btn" class="w-full bg-black text-white text-center py-3.5 font-medium text-sm hover:bg-gray-800 transition rounded-xl">
                Buy It Now
            </button>
        </div>

        <div class="mb-6">
            <h3 class="text-[13px] font-bold text-black uppercase mb-3">Detail Product:</h3>
            <p class="text-[14px] text-gray-600 leading-relaxed">{{ $product->description }}</p>
        </div>

        <div>
            <h3 class="text-[13px] font-bold text-black uppercase mb-3">Material/Category:</h3>
            <p class="text-[14px] text-gray-600 capitalize">{{ $product->category }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- Size Selection & Validation ---
    let selectedSize = null;
    const sizeBtns = document.querySelectorAll('.size-btn');
    const sizeWarning = document.getElementById('size-warning');
    const selectedSizeInput = document.getElementById('selected-size');
    const formQtyInput = document.getElementById('form-qty');
    const qtyInput = document.getElementById('qty');
    
    sizeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            sizeBtns.forEach(b => {
                b.classList.remove('border-black', 'ring-1', 'ring-black');
                b.classList.add('border-gray-200');
            });
            btn.classList.remove('border-gray-200');
            btn.classList.add('border-black', 'ring-1', 'ring-black');
            selectedSize = btn.getAttribute('data-size');
            if (selectedSizeInput) selectedSizeInput.value = selectedSize;
            sizeWarning.classList.add('hidden');
        });
    });

    const cartForm = document.getElementById('cart-form');
    if (cartForm) {
        cartForm.addEventListener('submit', function(e) {
            if (!selectedSize) {
                e.preventDefault();
                sizeWarning.classList.remove('hidden');
                sizeBtns.forEach(b => {
                    b.classList.add('border-red-500');
                    setTimeout(() => b.classList.remove('border-red-500'), 500);
                });
            } else {
                // Sync qty before submit
                if (formQtyInput && qtyInput) formQtyInput.value = qtyInput.value;
            }
        });
    }

    const buyItNowBtn = document.getElementById('buy-it-now-btn');
    if (buyItNowBtn) {
        buyItNowBtn.addEventListener('click', function() {
            if (!selectedSize) {
                sizeWarning.classList.remove('hidden');
                sizeBtns.forEach(b => {
                    b.classList.add('border-red-500');
                    setTimeout(() => b.classList.remove('border-red-500'), 500);
                });
            } else {
                // Kirim ke checkout dengan produk ini
                // Bisa pakai form atau redirect dengan parameter
                window.location.href = '{{ url("/checkout") }}';
            }
        });
    }
</script>
@endpush
@extends('layouts.store')

@section('navbar_style', 'sticky')

@section('title', 'Products | lustreco®')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="flex flex-col md:flex-row gap-8">

        <!-- ===== SIDEBAR FILTER ===== -->
        <aside class="w-full md:w-64 lg:w-72 flex-shrink-0 space-y-6">
            <!-- Search -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-3">Search</h3>
                <form action="{{ route('products.index') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="w-full border border-gray-200 rounded-l-xl px-4 py-2 text-sm focus:outline-none focus:border-black transition">
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-r-xl text-sm hover:bg-gray-800 transition">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- Categories -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-3">Categories</h3>
                <ul class="space-y-1.5 text-sm">
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->query(), ['category' => 'all'])) }}"
                           class="{{ (!request('category') || request('category') == 'all') ? 'font-semibold text-black' : 'text-gray-500 hover:text-black' }} transition">
                            All Categories
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->query(), ['category' => $cat])) }}"
                               class="{{ request('category') == $cat ? 'font-semibold text-black' : 'text-gray-500 hover:text-black' }} transition">
                                {{ ucfirst($cat) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Product Type -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-3">Product Type</h3>
                <div class="space-y-1.5 text-sm">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="type" value="all"
                               {{ (!request('type') || request('type') == 'all') ? 'checked' : '' }}
                               onchange="window.location.href='{{ route('products.index', array_merge(request()->query(), ['type' => 'all'])) }}'"
                               class="mr-2 accent-black w-3.5 h-3.5">
                        All Products
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="type" value="discount"
                               {{ request('type') == 'discount' ? 'checked' : '' }}
                               onchange="window.location.href='{{ route('products.index', array_merge(request()->query(), ['type' => 'discount'])) }}'"
                               class="mr-2 accent-black w-3.5 h-3.5">
                        Discount
                    </label>
                </div>
            </div>

            <!-- Availability -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-3">Availability</h3>
                <div class="space-y-1.5 text-sm">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="availability" value="all"
                               {{ (!request('availability') || request('availability') == 'all') ? 'checked' : '' }}
                               onchange="window.location.href='{{ route('products.index', array_merge(request()->query(), ['availability' => 'all'])) }}'"
                               class="mr-2 accent-black w-3.5 h-3.5">
                        All
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="availability" value="in_stock"
                               {{ request('availability') == 'in_stock' ? 'checked' : '' }}
                               onchange="window.location.href='{{ route('products.index', array_merge(request()->query(), ['availability' => 'in_stock'])) }}'"
                               class="mr-2 accent-black w-3.5 h-3.5">
                        In Stock
                    </label>
                </div>
            </div>

            <!-- Reset Filter -->
            <div class="pt-3 border-t border-gray-200">
                <a href="{{ route('products.index') }}" class="text-sm text-gray-400 hover:text-black transition underline">
                    Clear all filters
                </a>
            </div>
        </aside>

        <!-- ===== PRODUCT GRID ===== -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Products <span class="text-sm font-normal text-gray-400">({{ $products->count() }})</span>
                </h2>
                @if(request()->hasAny(['search', 'category', 'type', 'availability']))
                    <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                        <i class="fa-solid fa-filter mr-1"></i> Filter aktif
                    </span>
                @endif
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No products found.</p>
                    <a href="{{ route('products.index') }}" class="text-sm text-black underline mt-2 inline-block">View all products</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                            <a href="{{ route('products.show', $product->id) }}" class="block">
                                <div class="h-52 bg-gray-50 flex items-center justify-center p-4">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-contain transition group-hover:scale-105 duration-300">
                                </div>
                            </a>
                            <div class="p-4">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="text-sm font-medium text-gray-900 hover:underline line-clamp-2">
                                    {{ $product->name }}
                                </a>
                                <p class="text-sm font-semibold text-gray-900 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 capitalize mt-0.5">{{ $product->category }}</p>
                                <div class="mt-3 grid grid-cols-2 gap-2">
                                    <form action="{{ route('cart.add') }}" method="POST" class="col-span-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                                class="w-full bg-black text-white text-sm py-2 rounded-xl hover:bg-gray-800 transition">
                                            <i class="fa-solid fa-cart-plus mr-1"></i> Add
                                        </button>
                                    </form>
                                    <a href="{{ route('checkout') }}?product_id={{ $product->id }}"
                                       class="flex items-center justify-center border border-black text-black text-sm py-2 rounded-xl hover:bg-gray-50 transition">
                                        <i class="fa-solid fa-bolt mr-1"></i> Buy
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@php
    $sticky = $sticky ?? false;
@endphp

<header id="main-header" class="{{ $sticky ? 'sticky w-full top-0 z-40 bg-white border-b border-gray-100 px-8 py-5' : 'fixed w-full top-0 z-40 transition-colors duration-300 bg-transparent px-8 py-5' }}">
    <div class="w-full flex items-center justify-between">
        <button id="menu-btn" class="text-gray-800 hover:text-black focus:outline-none transition">
            <i class="fa-solid fa-bars text-[24px]"></i>
        </button>

        <!-- Center: Logo -->
        <a href="/" class="text-[32px] font-black tracking-tight flex items-start text-black absolute left-1/2 transform -translate-x-1/2">
            lustreco<span class="text-sm font-normal ml-0.5 relative -top-1">®</span>
        </a>

        <!-- Right: Search, Cart, Profile -->
        <div class="flex items-center space-x-6 text-gray-800">
            <!-- Currency (sama seperti sebelumnya) -->
            <div class="relative">
                <button id="currency-btn" class="flex items-center space-x-2 mr-2 hover:opacity-70 transition focus:outline-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="IDR" class="w-5 h-[14px] object-cover rounded-[1px]">
                    <span class="text-[12px] font-medium tracking-wide mt-0.5">IDR</span>
                </button>
                <!-- Popover (sama) -->
                <div id="currency-popover" class="absolute top-8 right-0 w-72 bg-white shadow-2xl rounded-2xl border border-gray-100 p-5 hidden z-50 text-left">
                    <!-- ... isi popover sama seperti sebelumnya ... -->
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="hover:text-black transition">
                <i class="fa-solid fa-magnifying-glass text-[22px]"></i>
            </a>

            <!-- CART WITH BADGE -->
            <a href="{{ route('cart.index') }}" class="relative hover:text-black transition">
                <i class="fa-solid fa-bag-shopping text-[22px]"></i>
                @if(isset($cartCount) && $cartCount > 0)
                    <span class="absolute -top-2 -right-3 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-black transition" title="Admin Panel">
                        <i class="fa-solid fa-gauge-high text-[22px]"></i>
                    </a>
                @endif
            @endauth

            <a href="{{ route('account') }}" class="hover:text-black transition">
                <i class="fa-regular fa-user text-[22px]"></i>
            </a>
        </div>
    </div>
</header>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="fixed inset-y-0 left-0 w-80 bg-white z-50 transform -translate-x-full transition-transform duration-300 ease-in-out border-r border-gray-200">
    <div class="p-6 flex flex-col h-full mt-2">
        <div class="flex items-center justify-between mb-6 px-1">
            <button class="text-black hover:text-gray-600 transition">
                <i class="fa-solid fa-magnifying-glass text-[26px]"></i>
            </button>
            <button id="close-menu-btn" class="text-black hover:text-gray-600 transition focus:outline-none">
                <i class="fa-solid fa-xmark text-xl stroke-2"></i>
            </button>
        </div>
        <nav class="flex flex-col space-y-1 flex-grow">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[14px] font-bold tracking-wide text-zinc-950 bg-zinc-100 hover:bg-zinc-200 transition-colors px-4 py-3 rounded-lg block"><i class="fa-solid fa-gauge-high mr-2"></i>ADMIN PANEL</a>
                @endif
            @endauth
            <a href="{{ route('products.index') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">SHOP</a>
            <a href="{{ route('about') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">ABOUT</a>
            <a href="#" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">STORE</a>
        </nav>
    </div>
</div>
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden transition-opacity duration-300"></div>

@push('scripts')
<script>
    // Sidebar toggle
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-menu-btn');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        const isClosed = sidebar.classList.contains('-translate-x-full');
        if (isClosed) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }
    if (menuBtn) menuBtn.addEventListener('click', toggleSidebar);
    if (closeBtn) closeBtn.addEventListener('click', toggleSidebar);
    if (overlay) overlay.addEventListener('click', toggleSidebar);

    // Currency popover (sama)
    const currencyBtn = document.getElementById('currency-btn');
    const currencyPopover = document.getElementById('currency-popover');
    if (currencyBtn) {
        currencyBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            currencyPopover.classList.toggle('hidden');
        });
    }
    document.addEventListener('click', (e) => {
        if (currencyPopover && !currencyPopover.classList.contains('hidden') &&
            !currencyPopover.contains(e.target) && e.target !== currencyBtn) {
            currencyPopover.classList.add('hidden');
        }
    });

    // Sync dropdowns
    // ... (kode sync dropdown sama seperti sebelumnya) ...

    @if(!$sticky)
    // Header scroll effect (hanya untuk transparent)
    window.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        if (window.scrollY > 20) {
            header.classList.add('bg-white', 'border-b', 'border-gray-100');
            header.classList.remove('bg-transparent');
        } else {
            header.classList.remove('bg-white', 'border-b', 'border-gray-100');
            header.classList.add('bg-transparent');
        }
    });
    @endif
</script>
@endpush
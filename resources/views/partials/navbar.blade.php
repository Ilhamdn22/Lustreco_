{{-- Lustreco Shared Navbar Partial --}}
<header id="main-header" class="fixed w-full top-0 z-40 transition-colors duration-300 bg-transparent px-8 py-5">
    <div class="w-full flex items-center justify-between">
        <!-- Left: Menu Hamburger -->
        <button id="menu-btn" class="text-gray-800 hover:text-black focus:outline-none transition">
            <i class="fa-solid fa-bars text-[24px]"></i>
        </button>

        <!-- Center: Logo Lustreco -->
        <a href="/" class="text-[32px] font-black tracking-tight flex items-start text-black absolute left-1/2 transform -translate-x-1/2">
            lustreco<span class="text-sm font-normal ml-0.5 relative -top-1">®</span>
        </a>

        <!-- Right: Search, Cart, Profile Icons -->
        <div class="flex items-center space-x-6 text-gray-800">
            <div class="relative">
                <button id="currency-btn" class="flex items-center space-x-2 mr-2 hover:opacity-70 transition focus:outline-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="IDR" class="w-5 h-[14px] object-cover rounded-[1px]">
                    <span class="text-[12px] font-medium tracking-wide mt-0.5">IDR</span>
                </button>

                <!-- Currency Popover -->
                <div id="currency-popover" class="absolute top-8 right-0 w-72 bg-white shadow-2xl rounded-2xl border border-gray-100 p-5 hidden z-50 text-left transform origin-top-right transition-all">
                    <div class="mb-4 relative">
                        <label class="block text-[13px] text-gray-700 mb-1.5">Deliver to</label>
                        <div class="relative">
                            <div class="flex items-center justify-between border border-gray-200 rounded-xl p-3 cursor-pointer hover:border-gray-400 transition bg-white">
                                <div class="flex items-center space-x-3">
                                    <img id="deliver-flag" src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" class="w-6 h-4 object-cover rounded-[2px]">
                                    <span id="deliver-text" class="text-[14px] text-gray-800">Indonesia</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-800"></i>
                            </div>
                            <select id="deliver-select" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                                <option value="Indonesia" data-flag="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg">Indonesia</option>
                                <option value="Malaysia" data-flag="https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_Malaysia.svg">Malaysia</option>
                                <option value="Singapore" data-flag="https://upload.wikimedia.org/wikipedia/commons/4/48/Flag_of_Singapore.svg">Singapore</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 relative">
                        <label class="block text-[13px] text-gray-700 mb-1.5">Language</label>
                        <div class="relative">
                            <div class="flex items-center justify-between border border-gray-200 rounded-xl p-3 cursor-pointer hover:border-gray-400 transition bg-white">
                                <div class="flex items-center space-x-3 text-gray-500">
                                    <i class="fa-solid fa-globe text-lg"></i>
                                    <span id="language-text" class="text-[14px] text-gray-800">English</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-800"></i>
                            </div>
                            <select id="language-select" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                                <option value="Bahasa">Bahasa</option>
                                <option value="English" selected>English</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-5 relative">
                        <label class="block text-[13px] text-gray-700 mb-1.5">Currency</label>
                        <div class="relative">
                            <div class="flex items-center justify-between border border-gray-200 rounded-xl p-3 cursor-pointer hover:border-gray-400 transition bg-white">
                                <span id="currency-text" class="text-[14px] text-gray-800">IDR - Indonesian Rupiah</span>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-800"></i>
                            </div>
                            <select id="currency-select" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer appearance-none">
                                <option value="IDR - Indonesian Rupiah">IDR - Indonesian Rupiah</option>
                                <option value="USD - United States Dollar">USD - United States Dollar</option>
                                <option value="SGD - Singapore Dollar">SGD - Singapore Dollar</option>
                            </select>
                        </div>
                    </div>

                    <button id="save-currency-btn" class="w-full bg-black text-white font-medium py-3 rounded-xl hover:bg-gray-800 transition">Save</button>
                </div>
            </div>

            <a href="{{ url('/products') }}" class="hover:text-black transition">
                <i class="fa-solid fa-magnifying-glass text-[22px]"></i>
            </a>
            <a href="{{ url('/cart') }}" class="relative hover:text-black transition">
                <i class="fa-solid fa-bag-shopping text-[22px]"></i>
            </a>

            @auth
            <!-- Logged in: show user icon linking to profile -->
            <div class="relative group">
                <button class="hover:text-black transition focus:outline-none" id="profile-btn">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-gray-300">
                    @else
                        <i class="fa-regular fa-user text-[22px]"></i>
                    @endif
                </button>
                <!-- Dropdown -->
                <div id="profile-dropdown" class="absolute top-10 right-0 w-48 bg-white shadow-xl rounded-2xl border border-gray-100 py-2 hidden z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-5 py-2.5 text-[14px] text-gray-700 hover:bg-gray-50 transition">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-5 py-2.5 text-[14px] text-gray-700 hover:bg-gray-50 transition">Log Out</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ url('/login') }}" class="hover:text-black transition">
                <i class="fa-regular fa-user text-[22px]"></i>
            </a>
            @endauth
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
            <a href="{{ url('/products') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">SHOP</a>
            <a href="{{ url('/about') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">ABOUT</a>
            <a href="#" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">STORE</a>
        </nav>
    </div>
</div>

<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden transition-opacity duration-300"></div>

<!-- Navbar Script -->
<script>
    const menuBtn = document.getElementById('menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (menuBtn) menuBtn.addEventListener('click', () => {
        mobileSidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
    });
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', () => {
        mobileSidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    });
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', () => {
        mobileSidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    });

    const currencyBtn = document.getElementById('currency-btn');
    const currencyPopover = document.getElementById('currency-popover');
    if (currencyBtn) currencyBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        currencyPopover.classList.toggle('hidden');
    });
    document.addEventListener('click', () => { if(currencyPopover) currencyPopover.classList.add('hidden'); });

    const profileBtn = document.getElementById('profile-btn');
    const profileDropdown = document.getElementById('profile-dropdown');
    if (profileBtn) profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
    });
    document.addEventListener('click', () => { if(profileDropdown) profileDropdown.classList.add('hidden'); });

    // Header Scroll Effect
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
</script>

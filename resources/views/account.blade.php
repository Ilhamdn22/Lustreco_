<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | My Account</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 antialiased flex flex-col min-h-screen">

    <!-- Navbar Minimalis -->
    <header id="main-header" class="sticky w-full top-0 z-40 bg-white border-b border-gray-100 px-8 py-5">
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
                        <!-- Deliver to -->
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
                                    <option value="Cambodia" data-flag="https://upload.wikimedia.org/wikipedia/commons/8/83/Flag_of_Cambodia.svg">Cambodia</option>
                                    <option value="China" data-flag="https://upload.wikimedia.org/wikipedia/commons/f/fa/Flag_of_the_People%27s_Republic_of_China.svg">China</option>
                                    <option value="Japan" data-flag="https://upload.wikimedia.org/wikipedia/en/9/9e/Flag_of_Japan.svg">Japan</option>
                                    <option value="Malaysia" data-flag="https://upload.wikimedia.org/wikipedia/commons/2/28/Flag_of_Malaysia.svg">Malaysia</option>
                                    <option value="Philippines" data-flag="https://upload.wikimedia.org/wikipedia/commons/9/99/Flag_of_the_Philippines.svg">Philippines</option>
                                    <option value="Singapore" data-flag="https://upload.wikimedia.org/wikipedia/commons/4/48/Flag_of_Singapore.svg">Singapore</option>
                                    <option value="Taiwan" data-flag="https://upload.wikimedia.org/wikipedia/commons/7/72/Flag_of_the_Republic_of_China.svg">Taiwan</option>
                                    <option value="Thailand" data-flag="https://upload.wikimedia.org/wikipedia/commons/a/a9/Flag_of_Thailand.svg">Thailand</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Language -->
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

                        <!-- Currency -->
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
                                    <option value="MYR - Malaysian Ringgit">MYR - Malaysian Ringgit</option>
                                    <option value="THB - Thai Baht">THB - Thai Baht</option>
                                    <option value="EUR - Euro">EUR - Euro</option>
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
                <a href="{{ url('/account') }}" class="hover:text-black transition">
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
                <a href="{{ url('/products') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">SHOP</a>
                <a href="#" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">ABOUT</a>
                <a href="#" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">STORE</a>
            </nav>
        </div>
    </div>
    
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden transition-opacity duration-300"></div>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-[1000px] mx-auto px-4 sm:px-6 py-10">
        <h1 class="text-xl font-semibold mb-6">My Account</h1>
        
        @guest
        <!-- Promotional Banner -->
        <div class="bg-white rounded-[8px] shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row items-center justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h2 class="text-[15px] font-medium text-gray-900 mb-2">Enjoy Special Discounts and Stay Connected</h2>
                <p class="text-[13px] text-gray-500 max-w-3xl leading-relaxed">
                    Get access to exclusive discounts while keeping track of your orders and chats with ease. Stay updated on your purchases and engage with us seamlessly, all in one place.
                </p>
            </div>
            <div class="flex space-x-3 shrink-0 ml-0 md:ml-6 w-full md:w-auto">
                <a href="{{ route('login') }}" class="flex-1 md:flex-none text-center px-6 py-2 border border-gray-300 rounded-[20px] text-sm font-medium hover:bg-gray-50 transition">Login</a>
                <a href="{{ route('register') }}" class="flex-1 md:flex-none text-center px-6 py-2 bg-black text-white rounded-[20px] text-sm font-medium hover:bg-gray-800 transition">Signup</a>
            </div>
        </div>
        @endguest

        <!-- Tabs & Content -->
        <div class="bg-white rounded-[8px] shadow-sm border border-gray-100 overflow-hidden">
            <!-- Tabs -->
            <div class="flex border-b border-gray-200">
                <button class="flex-1 py-4 text-sm font-medium text-black border-b-2 border-black text-center">Orders</button>
                <button class="flex-1 py-4 text-sm font-medium text-gray-500 hover:text-black hover:bg-gray-50 transition text-center">Wishlist</button>
            </div>
            
            <!-- Content -->
            <div class="p-6 min-h-[400px] flex flex-col">
                <div class="flex justify-between items-center mb-16">
                    <h3 class="text-[15px] font-medium">My Orders (0)</h3>
                    <div class="relative">
                        <select class="appearance-none border border-gray-200 rounded-md text-[13px] px-4 py-2 pr-8 focus:outline-none focus:border-gray-400 bg-white cursor-pointer min-w-[120px]">
                            <option>All status</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-[10px] text-gray-500 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="flex-grow flex flex-col items-center justify-center text-center pb-10">
                    <i class="fa-solid fa-box-open text-5xl text-gray-300 mb-4 font-light"></i>
                    <h4 class="text-[15px] font-medium text-gray-900 mb-1.5">No Orders Found</h4>
                    <p class="text-[13px] text-gray-500">Place an order to see it listed here.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- JS for Mobile Sidebar -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const currencyBtn = document.getElementById('currency-btn');
        const currencyPopover = document.getElementById('currency-popover');

        function toggleMenu() {
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

        if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
        if(closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);

        if(currencyBtn) {
            currencyBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                currencyPopover.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', (e) => {
            if (currencyPopover && !currencyPopover.classList.contains('hidden') && !currencyPopover.contains(e.target) && e.target !== currencyBtn) {
                currencyPopover.classList.add('hidden');
            }
        });

        const saveCurrencyBtn = document.getElementById('save-currency-btn');
        if (saveCurrencyBtn) {
            saveCurrencyBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (currencyPopover) {
                    currencyPopover.classList.add('hidden');
                }
            });
        }

        const deliverSelect = document.getElementById('deliver-select');
        const deliverText = document.getElementById('deliver-text');
        const deliverFlag = document.getElementById('deliver-flag');
        
        if (deliverSelect) {
            deliverSelect.addEventListener('change', function() {
                deliverText.textContent = this.value;
                deliverFlag.src = this.options[this.selectedIndex].getAttribute('data-flag');
            });
        }

        const languageSelect = document.getElementById('language-select');
        const languageText = document.getElementById('language-text');
        
        if (languageSelect) {
            languageSelect.addEventListener('change', function() {
                languageText.textContent = this.value;
            });
        }

        const currencySelect = document.getElementById('currency-select');
        const currencyText = document.getElementById('currency-text');
        
        if (currencySelect) {
            currencySelect.addEventListener('change', function() {
                currencyText.textContent = this.value;
            });
        }
    </script>
</body>
</html>

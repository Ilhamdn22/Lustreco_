<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | Cart</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased flex flex-col min-h-screen">

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

    <!-- JS for Mobile Sidebar -->
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

    <main class="flex-grow w-full max-w-[1000px] mx-auto px-4 sm:px-6 py-12 flex flex-col items-center">
        <!-- Cart Title -->
        <h1 class="text-[22px] font-bold mb-14">Cart</h1>

        <!-- Cart Items (Simulated) -->
        <div class="w-full mb-16">
            <div class="flex items-center justify-between border-b border-gray-100 pb-6 mb-6">
                <div class="flex items-center space-x-6">
                    <div class="w-24 h-32 bg-gray-100 rounded-md overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=400&auto=format&fit=crop" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h2 class="text-[15px] font-medium mb-1">Lustreco Basic Tee</h2>
                        <p class="text-[13px] text-gray-500 mb-3">Color: Black | Size: M</p>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-medium">IDR 199.000</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end space-y-4">
                    <button class="text-gray-400 hover:text-black transition"><i class="fa-solid fa-trash text-sm"></i></button>
                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                        <button class="px-3 py-1 hover:bg-gray-50">-</button>
                        <span class="px-3 text-sm">1</span>
                        <button class="px-3 py-1 hover:bg-gray-50">+</button>
                    </div>
                </div>
            </div>

            <!-- Cart Summary & Checkout -->
            <div class="flex flex-col items-end w-full mt-8">
                <div class="w-full max-w-sm">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-[15px] font-medium">Subtotal</span>
                        <span class="text-[18px] font-bold">IDR 199.000</span>
                    </div>
                    <p class="text-[13px] text-gray-500 mb-6 text-right">Shipping & taxes calculated at checkout.</p>
                    <a href="{{ url('/checkout') }}" class="w-full block text-center px-8 py-4 bg-black text-white rounded-[12px] text-sm font-bold hover:bg-gray-800 transition">Proceed to Checkout</a>
                </div>
            </div>
        </div>

        <!-- Recently Ordered -->
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
                <div class="w-[180px] flex-shrink-0 snap-start group">
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
                        <button class="absolute -bottom-3 -right-1 bg-white w-7 h-7 rounded-[4px] shadow-sm border border-gray-100 flex items-center justify-center text-black hover:bg-gray-50 transition z-10 focus:outline-none">
                            <div class="relative">
                                <i class="fa-solid fa-bag-shopping text-[11px]"></i>
                                <i class="fa-solid fa-plus text-[6px] absolute -bottom-0.5 -right-0.5 bg-white rounded-full"></i>
                            </div>
                        </button>
                    </div>
                    <div class="cursor-pointer">
                        <h4 class="text-[12px] font-medium text-gray-900 leading-tight mb-0.5 line-clamp-2">{{ $product->name }}</h4>
                        <p class="text-[11px] text-gray-500 mb-0.5">Lustreco</p>
                        @if($index < 2)
                            <div class="flex items-center space-x-1.5 mb-1">
                                <p class="text-[11px] text-gray-400 line-through">Rp 200,000</p>
                                <p class="text-[12px] font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        @else
                            <p class="text-[12px] font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>

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

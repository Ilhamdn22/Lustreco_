<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | {{ $product->name }}</title>
    
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

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-[1200px] mx-auto px-4 sm:px-6 py-12 flex flex-col lg:flex-row gap-12">
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
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="image" value="{{ $product->image }}">
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
                    window.location.href = '{{ url("/checkout") }}';
                }
            });
        }
    </script>
</body>
</html>

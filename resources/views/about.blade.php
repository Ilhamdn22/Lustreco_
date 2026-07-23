<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | About</title>
    
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
    <header id="main-header" class="fixed w-full top-0 z-40 bg-white border-b border-gray-100 px-8 py-5">
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
                <a href="{{ url('/about') }}" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block bg-[#f0f0f0]">ABOUT</a>
                <a href="#" class="text-[14px] font-medium tracking-wide text-gray-900 hover:bg-[#d1d1d1] transition-colors px-4 py-3 rounded-lg block">STORE</a>
            </nav>
        </div>
    </div>
    
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden transition-opacity duration-300"></div>
    
    <!-- Main Content -->
    <main class="flex-grow pt-[140px] pb-10 px-8 flex flex-col justify-between">
        <div class="max-w-[1200px] mx-auto text-center w-full">
            <p class="text-[14px] leading-relaxed text-gray-800">
                <strong>Lustreco</strong> is an Indonesian lifestyle retail brand founded in 2013. The label creates original, youth-driven clothing and accessories inspired by pop culture, street style, and anime.
                <br><br>
                Known for unisex designs and graphic storytelling, Lustreco has become a notable presence in Indonesia's fashion scene. The brand operates online through its website and major e-commerce platforms and is headquartered in South Tangerang, Indonesia.
            </p>
        </div>
        
        <div class="mt-40">
            <!-- Section Informasi Payment & Shipment -->
            <section class="bg-white">
                <div class="max-w-5xl mx-auto px-4 text-center">
                    
                    <!-- Payment Method -->
                    <div class="mb-10">
                        <h3 class="text-[13px] font-medium text-gray-600 mb-6">
                            Payment Method
                        </h3>
                        <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 hover:opacity-100 transition-opacity">
                            <img src="https://tse1.mm.bing.net/th/id/OIP.SJk3_1NbGUAvZ-bJslHM4wHaC0?r=0&pid=Api&P=0&h=180" alt="QRIS" class="h-6 object-contain">
                            <img src="https://tse1.mm.bing.net/th/id/OIP.BgWRZO7z2VuHDvJVh4q-0gHaCT?r=0&pid=Api&P=0&h=180" alt="OVO" class="h-5 object-contain">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg" alt="Mandiri" class="h-5 object-contain">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" class="h-5 object-contain">
                            <img src="https://tse1.mm.bing.net/th/id/OIP.7ac-BBuYSK0mgmanTkM5hwHaCJ?r=0&pid=Api&P=0&h=180" alt="BNI" class="h-4 object-contain">
                            <img src="https://tse2.mm.bing.net/th/id/OIP.nisHwf4UfdBIJWh6EcVA6gHaB2?r=0&pid=Api&P=0&h=180" alt="Permata Bank" class="h-5 object-contain">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" class="h-5 object-contain">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/CIMB_Niaga_logo.svg" alt="CIMB Niaga" class="h-5 object-contain">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-6 object-contain">
                        </div>
                    </div>

                    <!-- Shipment Method -->
                    <div>
                        <h3 class="text-[13px] font-medium text-gray-600 mb-4">
                            Shipment Method
                        </h3>
                        <div class="flex justify-center items-center opacity-80">
                            <img src="https://tse4.mm.bing.net/th/id/OIP.2j4gL2L4bv2w5hByr8syMgHaC-?r=0&pid=Api&P=0&h=180" alt="JNE Express" class="h-7 object-contain">
                        </div>
                    </div>

                </div>
            </section>
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
                document.body.style.overflow = 'hidden'; // Prevent scrolling
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        if(menuBtn) menuBtn.addEventListener('click', toggleMenu);
        if(closeMenuBtn) closeMenuBtn.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);

        // Currency Popover Toggle
        if(currencyBtn) {
            currencyBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                currencyPopover.classList.toggle('hidden');
            });
        }

        // Close Popover when clicking outside
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

        // Sync Dropdowns with UI
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

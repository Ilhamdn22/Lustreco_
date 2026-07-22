<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | Official Store</title>
    
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
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-gray-100 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Left: Menu Hamburger -->
            <button class="text-gray-800 hover:text-black focus:outline-none transition">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            <!-- Center: Logo Lustreco -->
            <a href="/" class="text-2xl font-black tracking-tight flex items-start text-black">
                lustreco<span class="text-xs font-normal ml-0.5 relative -top-1">®</span>
            </a>

            <!-- Right: Search, Cart, Profile Icons -->
            <div class="flex items-center space-x-5 text-gray-800">
                <button class="hover:text-black transition">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>
                <a href="/products" class="relative hover:text-black transition">
                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-black text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        2
                    </span>
                </a>
                <button class="hover:text-black transition">
                    <i class="fa-regular fa-user text-lg"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content / Hero Banner -->
    <main class="flex-grow">
        <!-- Hero Image Banner -->
        <div class="w-full h-[60vh] md:h-[75vh] relative overflow-hidden bg-gray-100">
            <img 
                src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1600&auto=format&fit=crop" 
                alt="Lustreco Hero Banner" 
                class="w-full h-full object-cover object-center"
            >
        </div>

        <!-- Section Informasi Payment & Shipment (Dengan Logo Asli) -->
        <section class="py-12 bg-white border-t border-gray-100">
            <div class="max-w-5xl mx-auto px-4 text-center">
                
                <!-- Payment Method -->
                <div class="mb-10">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-6">
                        Payment Method
                    </h3>
                    <div class="flex flex-wrap items-center justify-center gap-6 md:gap-8 opacity-80 hover:opacity-100 transition-opacity">
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
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">
                        Shipment Method
                    </h3>
                    <div class="flex justify-center items-center opacity-80">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.2j4gL2L4bv2w5hByr8syMgHaC-?r=0&pid=Api&P=0&h=180" alt="JNE Express" class="h-7 object-contain">
                    </div>
                </div>

            </div>
        </section>
    </main>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" 
       class="fixed bottom-6 right-6 bg-black text-white w-12 h-12 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-200 z-50">
        <i class="fa-brands fa-whatsapp text-2xl"></i>
    </a>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | Checkout</title>
    
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
<body class="bg-[#FAFAFA] text-gray-900 antialiased min-h-screen flex flex-col">

    <!-- Minimal Header -->
    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
        <a href="javascript:history.back()" class="text-black hover:text-gray-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <a href="/" class="text-[28px] font-black tracking-tight flex items-start text-black absolute left-1/2 transform -translate-x-1/2">
            lustreco<span class="text-xs font-normal ml-0.5 relative -top-1">®</span>
        </a>
        <div class="w-4"></div> <!-- placeholder -->
    </header>

    <main class="flex-grow max-w-[1100px] mx-auto w-full px-4 sm:px-6 py-10 flex flex-col lg:flex-row gap-12">
        
        <!-- Left Column: Forms -->
        <div class="w-full lg:w-3/5 space-y-10">
            
            <!-- Address Details -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Address Details</h2>
                <p class="text-[14px] text-gray-700 mb-6">Do you have a account? <a href="/login" class="font-medium underline hover:text-black transition">Login</a></p>
                
                <div class="space-y-4">
                    <div>
                        <input type="email" placeholder="Email Address (Optional)" class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">
                        <p class="text-[11px] text-gray-500 mt-1.5 ml-1">We will send your order details to your email.</p>
                    </div>
                    
                    <input type="text" placeholder="Recipient Full Name" class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">
                    
                    <input type="text" placeholder="Recipient Phone Number" class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition">
                    
                    <div class="relative">
                        <select class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition appearance-none bg-white text-gray-900 cursor-pointer pt-6 pb-2">
                            <option>Indonesia</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[10px] text-gray-600 pointer-events-none"></i>
                        <span class="absolute left-4 top-2 text-[10px] text-gray-400">Country</span>
                    </div>

                    <div class="relative">
                        <input type="text" placeholder="Sub-district, District, City" class="w-full border border-gray-200 rounded-xl pl-4 pr-10 py-3.5 text-[14px] outline-none focus:border-black transition">
                        <i class="fa-solid fa-magnifying-glass absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>

                    <textarea placeholder="Address Details" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3.5 text-[14px] outline-none focus:border-black transition resize-none"></textarea>
                </div>
            </div>

            <!-- Shipment Method -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Shipment Method</h2>
                <div class="bg-gray-100 rounded-xl p-4 text-[13px] text-gray-500">
                    Complete address detail to see available shipping methods.
                </div>
            </div>

            <!-- Payment Method -->
            <div>
                <h2 class="text-[17px] font-bold mb-4">Payment Method</h2>
                <div class="border border-gray-200 rounded-xl p-4 flex items-center justify-between cursor-pointer hover:border-gray-400 transition bg-white">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_of_Bank_Mandiri.svg" alt="Mandiri" class="h-5 object-contain">
                    <div class="flex items-center space-x-3">
                        <span class="text-[14px] text-gray-800">Mandiri</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-500"></i>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Right Column: Order Summary -->
        <div class="w-full lg:w-2/5">
            <div class="sticky top-24 space-y-6">
                <!-- Product Card -->
                <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex items-start space-x-4">
                    <div class="w-16 h-16 bg-gray-50 rounded-md border border-gray-100 flex items-center justify-center flex-shrink-0">
                        <img src="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg" alt="Product" class="w-full h-full object-cover rounded-md p-1">
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-[13px] font-medium text-gray-900 leading-tight mb-1 pr-4">Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops</h3>
                        <p class="text-[11px] text-gray-500 mb-1">Lustreco</p>
                        <p class="text-[11px] text-gray-500 mb-2">Quantity: 1</p>
                    </div>
                    <div class="flex-shrink-0">
                        <p class="text-[13px] font-medium text-gray-900">Rp 1.649.250</p>
                    </div>
                </div>

                <!-- Extras -->
                <div class="space-y-3">
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex justify-between items-center cursor-pointer hover:border-gray-300 transition text-[13px] text-gray-600">
                        <span>Leave a message for delivery (Optional)</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-sm flex justify-between items-center cursor-pointer hover:border-gray-300 transition text-[13px] text-gray-600">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-ticket text-gray-400"></i>
                            <span>Vouchers</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                    </div>
                </div>

                <!-- Summary -->
                <div class="pt-2">
                    <div class="flex justify-between items-center mb-3 text-[14px]">
                        <span class="text-gray-600">Subtotal <span class="text-gray-400 text-[12px]">• 1 Items</span></span>
                        <span class="font-medium">Rp 1.649.250</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 text-[14px]">
                        <span class="text-gray-600">Shipping</span>
                        <span class="text-gray-400">-</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 text-[14px]">
                        <span class="font-bold text-gray-900">Total Payment</span>
                        <span class="font-bold text-[16px] text-gray-900">Rp 1.649.250</span>
                    </div>
                    
                    <div class="flex items-center justify-center space-x-1.5 text-[11px] text-gray-500 mb-6">
                        <i class="fa-solid fa-lock"></i>
                        <span>Secure Payment | Your payment is encrypted.</span>
                    </div>

                    <div class="bg-[#F3F4F8] text-[12px] text-gray-600 p-4 rounded-xl leading-relaxed mb-6">
                        Import duty or tax might be charged depending on your delivery country.
                    </div>

                    <a href="{{ url('/account') }}" class="block w-full bg-black text-white font-medium text-center py-3.5 rounded-xl hover:bg-gray-800 transition shadow-md mb-3 text-[14px]">
                        Order Now
                    </a>
                    
                    <p class="text-[11px] text-gray-500 text-center">
                        By placing your order, you agree to our <a href="#" class="underline hover:text-black">Terms & Conditions</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>

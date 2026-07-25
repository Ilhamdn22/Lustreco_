<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'lustreco® | Official Store')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Floating WhatsApp --}}
    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 right-6 bg-black text-white w-12 h-12 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-200 z-50">
        <i class="fa-brands fa-whatsapp text-2xl"></i>
    </a>

    @stack('scripts')
</body>
</html>
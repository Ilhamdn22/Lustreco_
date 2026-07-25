<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'lustreco® | Official Store')</title>
    <!-- Tailwind, Font Awesome, dll -->
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased flex flex-col min-h-screen">
    @include('partials.navbar')
    <main class="flex-grow">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>
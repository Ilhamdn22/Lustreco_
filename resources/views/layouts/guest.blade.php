<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>lustreco® | {{ config('app.name', 'Auth') }}</title>

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
    <body class="bg-[#B9B9B9] text-gray-900 antialiased font-sans flex items-center justify-center min-h-screen">
        <div class="w-full sm:max-w-[480px] bg-white overflow-hidden sm:rounded-[24px] shadow-2xl relative m-4">
            {{ $slot }}
        </div>
    </body>
</html>

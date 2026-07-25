<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lustreco® | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=1600&auto=format&fit=crop');
            background-size: cover;
            background-position: center 30%;
            background-repeat: no-repeat;
        }
        .card-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        input {
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus {
            border-color: #111;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col hero-bg">

    <header class="w-full px-6 py-4 flex items-center justify-between bg-white/80 backdrop-blur-sm border-b border-white/30">
        <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-gray-600 hover:text-black transition text-sm font-medium">
            <i class="fa-solid fa-arrow-left text-sm"></i>
            <span>Back</span>
        </a>
        <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight text-black">
            lustreco<span class="text-sm font-normal ml-0.5 relative -top-1">®</span>
        </a>
        <div class="flex items-center gap-1.5 text-gray-600 text-sm">
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg"
                 alt="IDR" class="w-5 h-3.5 object-cover rounded-sm">
            <span class="text-[11px] font-medium tracking-wide">IDR</span>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md card-glass rounded-3xl shadow-2xl p-8 md:p-10 relative">

            <button onclick="window.location.href='{{ route('home') }}'"
                    class="absolute top-4 right-4 text-gray-400 hover:text-black transition text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="text-center mb-7">
                <h1 class="text-2xl font-bold text-gray-900">Create Account</h1>
                <p class="text-sm text-gray-500 mt-1">Join the lustreco community</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                    <div class="relative">
                        <i class="fa-regular fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="John Doe"
                               class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm bg-white/70 focus:bg-white focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                    </div>
                    @error('name') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               placeholder="your@email.com"
                               class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm bg-white/70 focus:bg-white focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                    </div>
                    @error('email') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input id="password" type="password" name="password" required
                               placeholder="••••••••"
                               class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm bg-white/70 focus:bg-white focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                    </div>
                    @error('password') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-check-circle absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               placeholder="••••••••"
                               class="w-full border border-gray-200 rounded-xl pl-11 pr-4 py-3 text-sm bg-white/70 focus:bg-white focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white text-sm font-semibold py-3.5 rounded-xl hover:bg-gray-800 transition shadow-lg shadow-black/20">
                    Sign up
                </button>

                <p class="text-center text-sm text-gray-500 pt-1">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-black font-semibold hover:underline">Log in</a>
                </p>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200/70"></div>
                </div>
                <div class="relative flex justify-center text-xs">
                    <span class="bg-white/80 px-4 text-gray-400 backdrop-blur-sm">or continue with</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 border border-gray-200/70 rounded-xl py-3 hover:bg-white/50 transition text-sm font-medium text-gray-700 bg-white/30">
                    <i class="fa-brands fa-google text-red-500"></i> Google
                </button>
                <button class="flex items-center justify-center gap-2 border border-gray-200/70 rounded-xl py-3 hover:bg-white/50 transition text-sm font-medium text-gray-700 bg-white/30">
                    <i class="fa-brands fa-apple text-black"></i> Apple
                </button>
            </div>
        </div>
    </main>

    <footer class="text-center text-xs text-white/70 py-4 bg-black/20 backdrop-blur-sm">
        &copy; {{ date('Y') }} lustreco®. All rights reserved.
    </footer>

</body>
</html>
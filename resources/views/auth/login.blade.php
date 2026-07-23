<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="p-8 pb-10">
        @csrf

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-[22px] font-bold">Login</h2>
            <a href="{{ url('/') }}" class="text-black hover:text-gray-600 transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </a>
        </div>

        <p class="text-[15px] text-gray-700 mb-6">
            Log in to manage your orders, check out faster, and discover new styles.
        </p>

        <!-- Email Address -->
        <div class="mb-4 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-regular fa-user text-gray-400 text-lg"></i>
            </div>
            <input id="email" class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-6 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-gray-400 text-lg"></i>
            </div>
            <input id="password" class="block w-full pl-11 pr-4 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <button type="submit" class="w-full bg-[#B3B3B3] text-white font-medium py-3.5 rounded-2xl hover:bg-gray-400 transition mb-6">
            Login
        </button>

        <div class="text-center text-[14px] text-gray-800 mb-8">
            Don't have account? <a href="{{ route('register') }}" class="font-medium hover:underline">Signup here</a>
        </div>

        <div class="text-center text-[11px] text-gray-500 leading-relaxed px-4">
            This site is protected by reCAPTCHA and the Google <a href="#" class="font-medium hover:underline">Privacy Policy</a> and <a href="#" class="font-medium hover:underline">Terms of Service</a> apply.
        </div>
    </form>
</x-guest-layout>

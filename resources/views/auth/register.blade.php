<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="p-8 pb-10">
        @csrf

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-[22px] font-bold">Register</h2>
            <a href="{{ url('/') }}" class="text-black hover:text-gray-600 transition">
                <i class="fa-solid fa-xmark text-xl"></i>
            </a>
        </div>

        <p class="text-[15px] text-gray-700 mb-6 leading-relaxed">
            Create account to be our member to earn points, get free vouchers, and hear our news earlier.
        </p>

        <!-- Name -->
        <div class="mb-4">
            <input id="name" class="block w-full px-5 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your Full Name*" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="mb-4 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-regular fa-user text-gray-400 text-lg"></i>
            </div>
            <input id="email" class="block w-full pl-11 pr-5 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-gray-400 text-lg"></i>
            </div>
            <input id="password" class="block w-full pl-11 pr-5 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-lock text-gray-400 text-lg"></i>
            </div>
            <input id="password_confirmation" class="block w-full pl-11 pr-5 py-3.5 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px]" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Birthday (Visual Only) -->
        <div class="mb-8">
            <label class="block text-[15px] text-gray-800 mb-3">My Birthday (Optional)</label>
            <div class="grid grid-cols-3 gap-3">
                <div class="relative">
                    <select class="block w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px] appearance-none cursor-pointer bg-white text-gray-500">
                        <option value="" disabled selected>Day</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[11px] text-black pointer-events-none"></i>
                </div>
                <div class="relative">
                    <select class="block w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px] appearance-none cursor-pointer bg-white text-gray-500">
                        <option value="" disabled selected>Month</option>
                        @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $month)
                            <option value="{{ $month }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[11px] text-black pointer-events-none"></i>
                </div>
                <div class="relative">
                    <select class="block w-full px-4 py-3 rounded-2xl border border-gray-200 focus:border-black focus:ring-0 outline-none transition text-[15px] appearance-none cursor-pointer bg-white text-gray-500">
                        <option value="" disabled selected>Year</option>
                        @for ($i = date('Y'); $i >= 1950; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-[11px] text-black pointer-events-none"></i>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-[#B3B3B3] text-white font-medium py-3.5 rounded-2xl hover:bg-gray-400 transition mb-6">
            Create New Account
        </button>

        <div class="text-center text-[14px] text-gray-800">
            Already have account? Login <a href="{{ route('login') }}" class="font-bold hover:underline">here</a>
        </div>
    </form>
</x-guest-layout>

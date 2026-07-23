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
            <div class="relative hidden md:block">
                <button id="currency-btn" class="flex items-center space-x-2 mr-2 hover:opacity-70 transition focus:outline-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Flag_of_Indonesia.svg" alt="IDR" class="w-5 h-[14px] object-cover rounded-[1px]">
                    <span class="text-[12px] font-medium tracking-wide mt-0.5">IDR</span>
                </button>
            </div>
            
            <a href="{{ url('/products') }}" class="hover:text-black transition">
                <i class="fa-solid fa-magnifying-glass text-[22px]"></i>
            </a>
            <a href="{{ url('/cart') }}" class="relative hover:text-black transition">
                <i class="fa-solid fa-bag-shopping text-[22px]"></i>
            </a>
            
            <!-- Settings Dropdown -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center hover:text-black transition focus:outline-none">
                            <i class="fa-regular fa-user text-[22px]"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</header>

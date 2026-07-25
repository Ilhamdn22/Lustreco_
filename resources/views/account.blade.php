{{-- resources/views/account.blade.php --}}
@extends('layouts.store')

@section('title', 'My Account')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Toast Notifikasi Global --}}
    @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div id="success-toast" class="mb-6 bg-black text-white text-sm font-medium px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 animate-fade-in-down">
            <i class="fa-solid fa-check-circle text-green-400"></i>
            {{ session('status') === 'profile-updated' ? 'Profile updated successfully!' : 'Password updated successfully!' }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold text-gray-900 mb-6">My Account</h1>

    {{-- Guest Banner --}}
    @guest
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row items-center justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h2 class="text-[15px] font-medium text-gray-900 mb-2">Enjoy Special Discounts and Stay Connected</h2>
                <p class="text-[13px] text-gray-500 max-w-3xl leading-relaxed">
                    Get access to exclusive discounts while keeping track of your orders and chats with ease.
                </p>
            </div>
            <div class="flex space-x-3 shrink-0 ml-0 md:ml-6 w-full md:w-auto">
                <a href="{{ route('login') }}" class="flex-1 md:flex-none text-center px-6 py-2 border border-gray-300 rounded-full text-sm font-medium hover:bg-gray-50 transition">Login</a>
                <a href="{{ route('register') }}" class="flex-1 md:flex-none text-center px-6 py-2 bg-black text-white rounded-full text-sm font-medium hover:bg-gray-800 transition">Signup</a>
            </div>
        </div>
    @endguest

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Tab Navigation --}}
        <div class="flex border-b border-gray-200" id="tabHeader">
            <button class="tab-btn active" data-tab="orders">Orders</button>
            @auth
                <button class="tab-btn" data-tab="profile">Profile</button>
            @endauth
        </div>

        {{-- Tab Content --}}
        <div class="p-6">
            {{-- Orders Tab --}}
            <div id="tab-orders" class="tab-panel active">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                    <h3 class="text-base font-medium">My Orders ({{ isset($orders) ? $orders->count() : 0 }})</h3>
                    <div class="relative">
                        <select id="status-filter" class="appearance-none border border-gray-200 rounded-md text-sm px-4 py-2 pr-8 focus:outline-none focus:border-gray-400 bg-white cursor-pointer min-w-[130px]">
                            <option value="all">All status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-[10px] text-gray-500 pointer-events-none"></i>
                    </div>
                </div>

                @if(isset($orders) && $orders->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <div class="py-4 flex flex-wrap items-center justify-between gap-3 hover:bg-gray-50/50 -mx-2 px-2 rounded-lg transition">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $order->items->count() }} item(s) · Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full
                                        @if($order->status == 'completed') bg-green-100 text-green-700
                                        @elseif($order->status == 'processing') bg-yellow-100 text-yellow-700
                                        @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($order->status ?? 'Pending') }}
                                    </span>
                                    <a href="{{ route('orders.show', $order) }}" class="text-sm text-gray-500 hover:text-black transition font-medium">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fa-solid fa-box-open text-5xl text-gray-300 mb-4"></i>
                        <h4 class="text-base font-medium text-gray-900 mb-1">No Orders Found</h4>
                        <p class="text-sm text-gray-500">Place an order to see it listed here.</p>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">
                            Start Shopping
                        </a>
                    </div>
                @endif

                @auth
                    <div class="mt-6 text-right border-t border-gray-100 pt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-500 hover:text-black transition">Logout</button>
                        </form>
                    </div>
                @endauth
            </div>

            {{-- Profile Tab --}}
            @auth
                <div id="tab-profile" class="tab-panel">
                    @php $user = auth()->user(); @endphp

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        {{-- Sidebar --}}
                        <div class="lg:col-span-4">
                            <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-6 text-center">
                                <div class="w-24 h-24 bg-white rounded-full mx-auto mb-4 border-2 border-gray-200 overflow-hidden flex items-center justify-center shadow-sm">
                                    @if($user?->avatar && Storage::exists('public/' . $user->avatar))
                                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-regular fa-user text-3xl text-gray-400"></i>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $user?->name ?? 'User' }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $user?->email ?? '' }}</p>
                                <div class="border-t border-gray-200 mt-4 pt-4 text-left space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Member Since</span>
                                        <span class="font-medium text-gray-900">{{ $user?->created_at ? $user->created_at->format('M Y') : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Status</span>
                                        <span class="text-xs font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-full border border-green-200">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Forms --}}
                        <div class="lg:col-span-8 space-y-6">
                            {{-- Profile Information --}}
                            <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-sm transition">
                                <h3 class="text-base font-semibold text-gray-900 mb-4">Profile Information</h3>
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                                    @csrf @method('patch')
                                    <div>
                                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                                        <input id="avatar" name="avatar" type="file" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50">
                                        @error('avatar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                        <input id="name" name="name" type="text" value="{{ old('name', $user?->name ?? '') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                        @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input id="email" name="email" type="email" value="{{ old('email', $user?->email ?? '') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                        @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <button type="submit" class="bg-black text-white text-sm font-medium px-8 py-3 rounded-xl hover:bg-gray-800 transition shadow-sm">Save Changes</button>
                                </form>
                            </div>

                            {{-- Change Password --}}
                            <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-sm transition">
                                <h3 class="text-base font-semibold text-gray-900 mb-4">Change Password</h3>
                                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                                    @csrf @method('put')
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                        <input id="current_password" name="current_password" type="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                        @error('current_password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                        <input id="password" name="password" type="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                        @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                    </div>
                                    <button type="submit" class="bg-black text-white text-sm font-medium px-8 py-3 rounded-xl hover:bg-gray-800 transition shadow-sm">Update Password</button>
                                </form>
                            </div>

                            {{-- Delete Account --}}
                            <div class="bg-white rounded-2xl border border-red-200 p-6 bg-red-50/20 hover:border-red-300 transition">
                                <h3 class="text-base font-semibold text-red-700 mb-2">Delete Account</h3>
                                <p class="text-sm text-gray-500 mb-4">Once your account is deleted, all data will be permanently removed.</p>
                                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure? This action is permanent.');">
                                    @csrf @method('delete')
                                    <div class="mb-4">
                                        <label for="password_delete" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                        <input id="password_delete" name="password" type="password" placeholder="Enter your password" class="w-full max-w-xs border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-black focus:ring-1 focus:ring-black outline-none transition bg-gray-50/50 focus:bg-white">
                                        @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                    <button type="submit" class="bg-white text-red-600 border border-red-300 text-sm font-medium px-6 py-3 rounded-xl hover:bg-red-50 transition">Delete My Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>

<style>
    .tab-btn {
        padding: 16px 24px;
        font-size: 14px;
        font-weight: 500;
        border-bottom: 2px solid transparent;
        transition: all 0.2s;
        cursor: pointer;
        background: transparent;
        color: #6b7280;
        flex: 1;
        text-align: center;
    }
    .tab-btn:hover {
        color: #111;
        border-bottom-color: #d1d5db;
    }
    .tab-btn.active {
        color: #111;
        border-bottom-color: #111;
    }
    .tab-panel {
        display: none;
    }
    .tab-panel.active {
        display: block;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.3s ease-out forwards;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tabs
        const tabs = document.querySelectorAll('.tab-btn');
        const panels = document.querySelectorAll('.tab-panel');

        tabs.forEach(btn => {
            btn.addEventListener('click', function() {
                const tab = this.dataset.tab;
                tabs.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                panels.forEach(p => p.classList.remove('active'));
                document.getElementById('tab-' + tab).classList.add('active');
            });
        });

        // Status filter
        const filter = document.getElementById('status-filter');
        if (filter) {
            filter.addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('status', this.value);
                window.location.href = url.toString();
            });
        }

        // Toast auto-hide
        const toast = document.getElementById('success-toast');
        if (toast) {
            setTimeout(() => {
                toast.style.transition = 'opacity 0.5s';
                toast.style.opacity = '0';
                setTimeout(() => { toast.style.display = 'none'; }, 500);
            }, 3000);
        }
    });
</script>
@endpush
@endsection
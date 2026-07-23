<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | lustreco®</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);
        }
        input:focus { border-color: #111; box-shadow: 0 0 0 2px rgba(0,0,0,0.07); }
        label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 6px; }
        .btn-primary {
            background: #111;
            color: #fff;
            padding: 10px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 1px 4px rgba(0,0,0,.1);
        }
        .btn-primary:hover { background: #333; }
        .btn-danger {
            background: #fff;
            color: #dc2626;
            padding: 10px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #fca5a5;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger:hover { background: #fef2f2; }
        .card { background: #fff; border-radius: 24px; border: 1px solid #f0f0f0; box-shadow: 0 1px 6px rgba(0,0,0,.05); }
    </style>
    @if (session('status') === 'profile-updated')
    <script>window.onload = () => { document.getElementById('success-toast')?.classList.remove('hidden'); setTimeout(()=>document.getElementById('success-toast')?.classList.add('hidden'), 3000); }</script>
    @endif
</head>
<body class="bg-[#F8F9FA] text-gray-900 antialiased min-h-screen">

    @include('partials.navbar')

    <!-- Success Toast -->
    @if (session('status') === 'profile-updated')
    <div id="success-toast" class="fixed top-6 left-1/2 -translate-x-1/2 z-50 bg-black text-white text-sm font-medium px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 transition-all">
        <i class="fa-solid fa-check-circle text-green-400"></i> Profile updated successfully!
    </div>
    @endif

    <div class="pt-28 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        <!-- Page Heading -->
        <div class="mb-10 text-left">
            <h2 class="text-2xl font-semibold text-gray-900 tracking-tight">Profile</h2>
            <p class="text-gray-500 text-sm mt-1">Manage your profile details and security settings.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <!-- Sidebar / Info Card -->
            <div class="lg:col-span-4 space-y-6">
                <div class="card p-8 text-center">
                    <div class="flex items-center justify-center w-24 h-24 bg-gray-50 rounded-full mx-auto mb-5 border border-gray-100 overflow-hidden">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-regular fa-user text-3xl text-gray-400"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-6">{{ Auth::user()->email }}</p>
                    <div class="border-t border-gray-100 pt-5 space-y-4 text-left">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Member Since</span>
                            <span class="text-sm font-medium text-gray-900">{{ Auth::user()->created_at->format('M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Account Status</span>
                            <span class="text-[11px] font-semibold text-green-700 bg-green-50 px-2.5 py-1 rounded-md uppercase tracking-wider border border-green-200">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forms -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Profile Info -->
                <div class="card p-8">
                    <h3 class="text-base font-semibold text-gray-900 mb-6">Profile Information</h3>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="avatar">Profile Photo</label>
                            <input id="avatar" name="avatar" type="file" accept="image/*">
                            @error('avatar') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name">
                            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email">Email Address</label>
                            <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-4 pt-1">
                            <button type="submit" class="btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

                <!-- Password -->
                <div class="card p-8">
                    <h3 class="text-base font-semibold text-gray-900 mb-6">Change Password</h3>
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password">Current Password</label>
                            <input id="current_password" name="current_password" type="password" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password">New Password</label>
                            <input id="password" name="password" type="password" autocomplete="new-password">
                            @error('password', 'updatePassword') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                        </div>

                        <div class="pt-1">
                            <button type="submit" class="btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Danger Zone -->
                <div class="card p-8 bg-red-50/30 border-red-100/60">
                    <h3 class="text-base font-semibold text-red-700 mb-2">Delete Account</h3>
                    <p class="text-sm text-gray-500 mb-6">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        @csrf
                        @method('delete')

                        <div class="mb-5">
                            <label for="password_delete">Confirm your password to continue</label>
                            <input id="password_delete" name="password" type="password" placeholder="Enter your password" style="max-width:320px;">
                            @error('password', 'userDeletion') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="btn-danger">Delete My Account</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>

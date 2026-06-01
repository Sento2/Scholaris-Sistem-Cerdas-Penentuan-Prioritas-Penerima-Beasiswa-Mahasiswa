<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk — {{ config('app.name', 'Scholaris') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        
        .bg-brand {
            background-color: #047857;
            background-image: radial-gradient(circle at 20% 150%, #059669 0%, #047857 50%, #064e3b 100%);
        }
        
        .input-field {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease-in-out;
        }
        .input-field:focus {
            background-color: #ffffff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
            outline: none;
        }
        
        .btn-primary {
            background-color: #059669;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #047857;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex">

    <!-- Left Panel - Branding -->
    <div class="hidden lg:flex lg:w-1/2 bg-brand flex-col justify-between p-12 text-white relative overflow-hidden">
        <!-- Abstract simple shape -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-300 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight">Scholaris</span>
            </div>

            <div class="max-w-md">
                <h1 class="text-4xl font-bold leading-tight mb-4">Sistem Seleksi Beasiswa Terpadu</h1>
                <p class="text-emerald-100 text-lg leading-relaxed">
                    Platform cerdas untuk mengelola dan mendaftar beasiswa menggunakan metode Simple Additive Weighting secara adil dan transparan.
                </p>
            </div>
        </div>

        <div class="relative z-10 text-sm text-emerald-200">
            &copy; {{ date('Y') }} Universitas. Hak Cipta Dilindungi.
        </div>
    </div>

    <!-- Right Panel - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white">
        <div class="w-full max-w-md">
            
            <!-- Mobile Header -->
            <div class="flex items-center gap-2 mb-8 lg:hidden">
                <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900">Scholaris</span>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang</h2>
                <p class="text-gray-500 text-sm">Masuk ke akun Anda untuk melanjutkan.</p>
            </div>

            <!-- Role Tabs -->
            <div class="flex bg-gray-100 p-1 rounded-lg mb-6" x-data="{ tab: 'mahasiswa' }">
                <button @click="tab = 'mahasiswa'" :class="tab === 'mahasiswa' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-2 text-sm rounded-md transition-all" type="button">Mahasiswa</button>
                <button @click="tab = 'dosen'" :class="tab === 'dosen' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-2 text-sm rounded-md transition-all" type="button">Dosen</button>
                <button @click="tab = 'admin'" :class="tab === 'admin' ? 'bg-white shadow-sm text-gray-900 font-semibold' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-2 text-sm rounded-md transition-all" type="button">Admin</button>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                           class="input-field w-full px-4 py-2.5 rounded-lg text-sm" placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm" />
                </div>

                <!-- Password -->
                <div x-data="{ show: false }">
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 hover:text-emerald-700 hover:underline">Lupa password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                               class="input-field w-full pl-4 pr-10 py-2.5 rounded-lg text-sm" placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.5-3.321M15.536 8.464A10.014 10.014 0 0112 5c-4.478 0-8.268 2.943-9.542 7a10.021 10.021 0 012.35 4.062M15 12a3 3 0 11-6 0 3 3 0 016 0zM3 3l18 18"/></svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded focus:ring-emerald-500">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full flex justify-center py-2.5 px-4 rounded-lg text-white font-medium text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-500">Daftar sekarang</a>
            </div>
        </div>
    </div>

</body>
</html>

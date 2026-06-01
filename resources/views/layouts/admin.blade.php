<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scholaris Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
        .animate-slide-up { animation: slideUp 0.6s ease-out forwards; opacity: 0; }
        .animate-slide-in { animation: slideIn 0.6s ease-out forwards; opacity: 0; }
        
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-500 { animation-delay: 500ms; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ===================== PRINT STYLES ===================== */
        @media print {
            /* Sembunyikan semua elemen UI yang tidak perlu */
            body { background: white !important; display: block !important; }

            /* Sembunyikan sidebar desktop & mobile */
            nav,
            aside,
            [class*="sidebar"],
            [class*="admin-sidebar"] { display: none !important; }

            /* Sembunyikan topbar/header navigasi */
            header { display: none !important; }

            /* Sembunyikan tombol Cetak Laporan */
            button[onclick="window.print()"],
            #btn-cetak-laporan,
            #laporan-header-actions { display: none !important; }

            /* Sembunyikan backdrop & mobile menu */
            [x-cloak], [x-show] { display: none !important; }

            /* Buat main content mengisi seluruh halaman */
            .flex-1.flex.flex-col { display: block !important; width: 100% !important; margin: 0 !important; padding: 0 !important; }
            main { padding: 0 !important; margin: 0 !important; width: 100% !important; }

            /* Hilangkan animasi & shadow untuk print */
            * {
                animation: none !important;
                transition: none !important;
                box-shadow: none !important;
                opacity: 1 !important;
            }

            /* Pastikan warna background kartu tetap tampil di print */
            .bg-emerald-50\/50,
            .bg-gray-50\/50 {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            /* Header print khusus laporan */
            .print-header {
                display: block !important;
                text-align: center;
                border-bottom: 2px solid #059669;
                padding-bottom: 16px;
                margin-bottom: 24px;
            }
            .print-header h1 {
                font-size: 20px;
                font-weight: 800;
                color: #065f46;
                margin: 0 0 4px 0;
            }
            .print-header p {
                font-size: 12px;
                color: #6b7280;
                margin: 0;
            }

            /* Sembunyikan hover effects */
            tr:hover { background: transparent !important; }

            /* Page break */
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }

            /* Margin halaman */
            @page {
                margin: 1.5cm 2cm;
                size: A4 portrait;
            }
        }
        /* Sembunyikan print-header di layar normal */
        .print-header { display: none; }
        /* ==================== END PRINT STYLES ==================== */
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white min-h-screen flex" x-data="{ mobileMenuOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm md:hidden" @click="mobileMenuOpen = false"></div>

    <!-- Mobile Sidebar -->
    <div x-show="mobileMenuOpen" x-cloak 
         class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl transform transition-transform duration-300 md:hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">
        @include('layouts.admin-sidebar')
    </div>

    <!-- Desktop Sidebar -->
    @include('layouts.admin-sidebar')

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden relative">
        
        <!-- Top Navigation -->
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-6 md:px-10 sticky top-0 z-30">
            <div class="flex items-center">
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = true" class="md:hidden text-gray-500 hover:text-emerald-600 focus:outline-none mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                @if (isset($header))
                    {{ $header }}
                @else
                    <h2 class="text-xl font-bold text-gray-800 hidden md:block">Dashboard Admin</h2>
                @endif
            </div>

            <!-- Right Topbar: Search, Notifications, Profile -->
            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <div class="hidden md:block relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" class="bg-gray-50 border-none rounded-full py-2 pl-10 pr-4 text-sm w-64 focus:ring-2 focus:ring-emerald-500 transition-all font-medium text-gray-600 placeholder-gray-400" placeholder="Cari...">
                </div>


                <!-- Help Button -->
                <button class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400 hover:text-emerald-600 transition-colors hidden md:flex">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center focus:outline-none">
                        <div class="w-10 h-10 rounded-full bg-[#0f172a] text-white flex items-center justify-center font-bold text-sm shadow-sm border-2 border-white ring-2 ring-gray-100 transform hover:scale-105 transition-all">
                            AD
                        </div>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute right-0 top-12 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100 z-50"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">
                        
                        <div class="px-4 py-3 border-b border-gray-50 mb-1">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] uppercase font-bold text-gray-400 mt-0.5">Administrator</p>
                        </div>
                         
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-emerald-700">Profil Saya</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-red-600">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-10 animate-fade-in bg-white">
            {{ $slot }}
        </main>

    </div>

</body>
</html>

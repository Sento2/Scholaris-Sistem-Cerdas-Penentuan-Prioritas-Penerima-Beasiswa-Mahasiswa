<x-app-layout>
    <div class="fixed inset-0 z-0 bg-gray-50/50 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-96 bg-gradient-to-b from-emerald-600/10 to-transparent pointer-events-none z-0"></div>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header Section -->
        <div class="mb-8 animate-fade-in flex items-center">
            <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mr-5 border-2 border-white shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pengaturan Profil</h2>
                <p class="text-gray-500 mt-1 text-base">Kelola informasi akun dan pengaturan keamanan Anda.</p>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-100 animate-slide-up">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-100 animate-slide-up delay-100">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</x-app-layout>

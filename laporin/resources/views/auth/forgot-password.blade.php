<x-guest-layout>
    <!-- Header Area & Instruksi -->
    <div class="mb-8 text-center">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 border border-blue-100/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Lupa Password?</h2>
        <p class="text-xs text-slate-500 mt-2 leading-relaxed max-w-xs mx-auto">
            Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status (Pesan Berhasil Terkirim) -->
    <x-auth-session-status class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-xs font-medium shadow-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Alamat Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-semibold text-xs tracking-wide" />
            <x-text-input id="email" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                type="email" 
                name="email" 
                :value="old('email')" 
                placeholder="nama@email.com"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button class="w-full justify-center py-3 bg-slate-900 hover:bg-slate-800 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-150 shadow-md shadow-slate-900/10">
                {{ __('Kirim Link Reset') }}
            </x-primary-button>

            <!-- Link Kembali ke Login -->
            <a href="{{ route('login') }}" class="text-center text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors">
                Kembali ke Halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>
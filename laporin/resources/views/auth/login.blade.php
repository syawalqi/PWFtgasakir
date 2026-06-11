<x-guest-layout>
    <!-- Bagian Header Form Login -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-sm text-slate-500 mt-2">Silakan masuk menggunakan akun Anda untuk mulai melaporkan pengaduan.</p>
    </div>

    <!-- Status Sesi (Pesan Sukses/Gagal) -->
    <x-auth-session-status class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-xs font-medium shadow-sm" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Input Alamat Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-semibold text-xs tracking-wide" />
            <x-text-input id="email" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                type="email" name="email" :value="old('email')" 
                placeholder="nama@email.com"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Input Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs tracking-wide" />
                @if (Route::has('password.request'))
                    <a class="text-[11px] font-bold text-slate-400 hover:text-slate-900 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5"
                type="password"
                name="password"
                placeholder="••••••••"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Opsi Ingat Saya (Remember Me) -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-slate-900 shadow-sm focus:ring-slate-900/5 transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-xs font-medium text-slate-500 group-hover:text-slate-700 transition-colors">{{ __('Ingat saya di perangkat ini') }}</span>
            </label>
        </div>

        <!-- Tombol Aksi Utama -->
        <div class="pt-2 flex flex-col space-y-5">
            <x-primary-button class="w-full justify-center py-3 bg-slate-900 hover:bg-slate-800 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-150 shadow-md shadow-slate-900/10">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>

            <!-- Link Pendaftaran Akun Baru -->
            <p class="text-center text-sm text-slate-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                    Daftar Akun Baru
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
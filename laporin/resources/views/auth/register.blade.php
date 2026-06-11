<x-guest-layout>
    <!-- Header Form Pendaftaran -->
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Buat Akun Baru</h2>
        <p class="text-sm text-slate-500 mt-2">Daftarkan diri Anda untuk mulai berkontribusi dalam perbaikan lingkungan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Input Nama Lengkap -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 font-semibold text-xs tracking-wide" />
            <x-text-input id="name" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                type="text" name="name" :value="old('name')" 
                placeholder="Masukkan nama lengkap sesuai identitas"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Input Alamat Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-semibold text-xs tracking-wide" />
            <x-text-input id="email" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                type="email" name="email" :value="old('email')" 
                placeholder="nama@email.com"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Input Password & Konfirmasi (Grid 2 Kolom) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-semibold text-xs tracking-wide" />
                <x-text-input id="password" 
                    class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required autocomplete="new-password" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi')" class="text-slate-700 font-semibold text-xs tracking-wide" />
                <x-text-input id="password_confirmation" 
                    class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5"
                    type="password"
                    name="password_confirmation" 
                    placeholder="••••••••"
                    required autocomplete="new-password" />
            </div>
            <div class="sm:col-span-2">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Area Tombol Aksi -->
        <div class="pt-4 flex flex-col space-y-5">
            <x-primary-button class="w-full justify-center py-3 bg-slate-900 hover:bg-slate-800 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-150 shadow-md shadow-slate-900/10">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>

            <!-- Link Kembali ke Login -->
            <p class="text-center text-sm text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition-colors">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
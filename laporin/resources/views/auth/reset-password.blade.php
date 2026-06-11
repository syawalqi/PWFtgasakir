<x-guest-layout>
    <!-- Header Form Reset Password -->
    <div class="mb-8 text-center">
        <div class="w-12 h-12 bg-slate-100 text-slate-700 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-200/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Atur Ulang Password</h2>
        <p class="text-xs text-slate-500 mt-2">Silakan masukkan password baru Anda yang kuat dan mudah diingat.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Alamat Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-slate-700 font-semibold text-xs tracking-wide" />
            <x-text-input id="email" 
                class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm bg-slate-50 text-slate-500 shadow-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5" 
                type="email" name="email" :value="old('email', $request->email)" 
                required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Input Password Baru & Konfirmasi (Grid 2 Kolom) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password Baru')" class="text-slate-700 font-semibold text-xs tracking-wide" />
                <x-text-input id="password" 
                    class="block mt-1.5 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required autocomplete="new-password" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 font-semibold text-xs tracking-wide" />
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

        <!-- Tombol Aksi Utama -->
        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-3 bg-slate-900 hover:bg-slate-800 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-150 shadow-md shadow-slate-900/10">
                {{ __('Simpan Password Baru') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
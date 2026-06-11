<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 border border-blue-100/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Verifikasi Email Anda</h2>
        <p class="text-xs text-slate-500 mt-2 leading-relaxed max-w-xs mx-auto">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-xs font-medium shadow-sm shadow-emerald-100/50 flex items-start space-x-2">
            <svg class="w-4 h-4 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan. Silakan cek kotak masuk atau folder spam Anda.</span>
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-100">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <x-primary-button class="w-full justify-center py-2.5 px-4 bg-slate-900 hover:bg-slate-800 rounded-xl font-bold text-xs uppercase tracking-widest transition duration-150 shadow-md shadow-slate-900/10">
                {{ __('Kirim Ulang Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 transition-colors duration-150 py-2">
                {{ __('Keluar / Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
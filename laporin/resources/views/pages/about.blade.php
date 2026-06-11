<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
            {{ __('Tentang LaporIn') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            <!-- Deskripsi Platform -->
            <div class="text-center space-y-4">
                <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Tentang LaporIn</h3>
                <!-- Ganti aksen pink dengan Indigo -->
                <div class="w-24 h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-[2.5rem] p-10 border border-slate-200/60 shadow-xl shadow-indigo-100/20">
                <div class="max-w-3xl mx-auto text-center space-y-6">
                    <span class="inline-flex items-center px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-bold uppercase tracking-widest rounded-full border border-indigo-100">Tentang Platform</span>
                    <h4 class="text-2xl font-bold text-slate-900">Apa itu LaporIn?</h4>
                    <p class="text-slate-500 leading-relaxed font-medium">
                        LaporIn adalah platform pengaduan masyarakat berbasis web yang dirancang modern, aman, dan transparan. Kami menjembatani warga dengan pihak berwenang untuk melaporkan berbagai kendala di lingkungan sekitar secara cepat dan terpantau.
                    </p>
                </div>
            </div>

            <!-- Cara Kerja (Ubah Aksen Angka menjadi Indigo) -->
            <div class="space-y-8">
                <div class="flex items-center space-x-3">
                    <div class="w-1 h-6 bg-indigo-600 rounded-full"></div>
                    <h4 class="font-extrabold text-slate-900 uppercase tracking-widest text-sm">Cara Kerja Sistem</h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Item 01 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start space-x-5 group hover:border-indigo-200 transition">
                        <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shrink-0 font-bold shadow-lg shadow-indigo-100">01</div>
                        <div>
                            <h5 class="font-bold text-slate-900">Registrasi Akun</h5>
                            <p class="text-xs text-slate-500 mt-1">Daftarkan akun baru menggunakan email aktif lalu login ke dalam sistem pengaduan warga.</p>
                        </div>
                    </div>
                    <!-- Item 02 -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-start space-x-5 group hover:border-indigo-200 transition">
                        <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shrink-0 font-bold shadow-lg shadow-indigo-100">02</div>
                        <div>
                            <h5 class="font-bold text-slate-900">Tulis Aduan</h5>
                            <p class="text-xs text-slate-500 mt-1">Isi form pengaduan dengan melampirkan judul, kategori yang sesuai, deskripsi, dan foto bukti.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
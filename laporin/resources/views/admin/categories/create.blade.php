<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Tambah Kategori Baru</h1>
        <p class="text-xs text-slate-400 mt-1">Buat opsi kategori baru untuk mengklasifikasikan jenis aduan yang masuk dari warga.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50 max-w-lg">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 tracking-wide mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                    placeholder="Contoh: Infrastruktur, Keamanan, Kebersihan..." required>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-50">
                <button type="submit" 
                    class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-md shadow-slate-900/10 text-center">
                    Simpan Kategori
                </button>
                <a href="{{ route('admin.categories.index') }}" 
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200/70 text-slate-600 font-semibold text-sm rounded-xl transition duration-150 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
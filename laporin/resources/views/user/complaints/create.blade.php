<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8 border border-slate-100">
                
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Buat Aduan Baru</h2>
                    <p class="text-sm text-slate-500">Laporkan fasilitas publik yang bermasalah agar segera dieksekusi oleh tim dinas lapangan.</p>
                </div>

                <!-- FIX FORMTAG: Menjamin @csrf anti error 419 dan enctype aman untuk upload foto bukti -->
                <form method="POST" action="{{ route('user.complaints.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- 1. INPUT JUDUL LAPORAN -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Laporan</label>
                        <input type="text" name="title" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3" placeholder="Tuliskan inti laporan Anda..." required value="{{ old('title') }}">
                        @error('title')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 2. SELECT KATEGORI FASILITAS -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori Fasilitas</label>
                        <select name="category_id" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3 bg-white" required>
                            <option value="">Pilih kategori laporan...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 3. TEXTAREA DESKRIPSI LENGKAP -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="5" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3" placeholder="Jelaskan detail kendala, lokasi, dan informasi pendukung lainnya..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 4. INPUT FILE LAMPIRAN FOTO BUKTI -->
                    <div class="p-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200 text-center">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Lampiran Foto Bukti (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="mx-auto block text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                        <p class="text-[10px] text-slate-400 mt-2">FORMAT: JPG, JPEG, PNG (MAKS. 2MB)</p>
                        @error('image')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 5. TOMBOL AKSI KIRIM -->
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('user.complaints.index') }}" class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl uppercase tracking-wider transition text-center">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl uppercase tracking-wider shadow-md shadow-indigo-200 transition">
                            🚀 Kirim Laporan Aduan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
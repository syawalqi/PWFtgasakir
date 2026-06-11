<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
            {{ __('Buat Aduan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Card dengan Efek Glassmorphism yang Bersih -->
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-2xl shadow-indigo-100/50 sm:rounded-3xl border border-slate-200/60">
                <div class="p-8 sm:p-10">
                    <form method="POST" action="{{ route('user.complaints.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Judul Aduan -->
                        <div>
                            <label for="title" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Laporan</label>
                            <input type="text" name="title" id="title" 
                                class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-slate-400 text-sm py-3 px-4 transition" 
                                placeholder="Tuliskan inti laporan Anda..." required>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="category_id" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori Fasilitas</label>
                            <select name="category_id" id="category_id" 
                                class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-3 px-4 transition" required>
                                <option value="" disabled selected>Pilih kategori laporan...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Deskripsi Lengkap</label>
                            <textarea name="description" id="description" rows="5" 
                                class="w-full rounded-2xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-slate-400 text-sm py-3 px-4 transition" 
                                placeholder="Jelaskan detail kendala, lokasi, dan informasi pendukung lainnya..." required></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Gambar -->
                        <div class="p-6 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 group hover:border-indigo-300 transition">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 text-center">Lampiran Foto Bukti (Opsional)</label>
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-xs file:font-bold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100 transition cursor-pointer">
                            <p class="mt-3 text-[10px] text-slate-400 text-center uppercase tracking-tighter">Format: JPG, PNG (Maks. 2MB)</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('user.complaints.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex items-center px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-widest rounded-2xl transition shadow-lg shadow-indigo-200 transform active:scale-95">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Kirim Aduan Resmi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
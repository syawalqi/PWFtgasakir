<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 tracking-tight">{{ __('Edit Aduan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Wrapper Form -->
            <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h3 class="text-lg font-bold text-slate-900">Perbarui Pengaduan Anda</h3>
                    <p class="text-xs text-slate-400 mt-1">Lakukan perubahan pada form di bawah ini jika terdapat informasi laporan yang salah.</p>
                </div>

                <form method="POST" action="{{ route('user.complaints.update', $complaint) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')
                    
                    <!-- Input Judul -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 tracking-wide mb-2">Judul Laporan</label>
                        <input type="text" name="title" value="{{ old('title', $complaint->title) }}" 
                            class="block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" required>
                        @error('title') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 tracking-wide mb-2">Kategori Masalah</label>
                        <div class="relative">
                            <select name="category_id" 
                                class="block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5 appearance-none" required>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ (old('category_id', $complaint->category_id) == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 tracking-wide mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="5" 
                            class="block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5" required>{{ old('description', $complaint->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input Gambar / Foto Bukti -->
                    <div x-data="{ preview: null }">
                        <label class="block text-sm font-semibold text-slate-700 tracking-wide mb-2">Gambar / Foto Bukti <span class="text-xs font-normal text-slate-400">(Biarkan kosong jika tidak diubah)</span></label>
                        
                        <div class="mt-1 flex flex-col items-start gap-4">
                            <input type="file" name="image" accept="image/jpeg,image/png" 
                                @change="preview = URL.createObjectURL($event.target.files[0])" 
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200/80 file:transition-colors file:cursor-pointer cursor-pointer">
                        </div>

                        <!-- Kotak Live Preview Foto Baru -->
                        <div x-show="preview" class="mt-4 relative inline-block">
                            <img :src="preview" class="max-w-xs h-auto rounded-xl shadow-md border border-slate-100">
                            <div class="absolute top-2 left-2 bg-slate-900/70 text-white text-[10px] px-2 py-0.5 rounded-md backdrop-blur-sm">
                                Preview Foto Baru
                            </div>
                        </div>
                        @error('image') <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <!-- Area Tombol Aksi -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('user.complaints.index') }}" 
                            class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200/70 text-slate-600 font-semibold text-sm rounded-xl transition duration-150 text-center">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-md shadow-blue-600/10 text-center">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
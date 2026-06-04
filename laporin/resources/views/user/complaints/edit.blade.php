<x-app-layout>
<div class="user-page">

    <!-- Breadcrumb -->
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;font-size:.85rem;color:#64748b">
        <a href="{{ route('user.complaints.index') }}" style="color:#818cf8;text-decoration:none">Aduan Saya</a>
        <i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i>
        <span>Edit Aduan</span>
    </div>

    <div style="max-width:720px">
        <div style="margin-bottom:1.75rem">
            <h1 style="font-size:1.5rem;font-weight:800;color:#f1f5f9">Edit Aduan</h1>
            <p style="color:#64748b;font-size:.875rem;margin-top:.25rem">Perbarui informasi aduan Anda</p>
        </div>

        <div class="card animate-fadein">
            <div class="card-body">
                <form method="POST" action="{{ route('user.complaints.update', $complaint) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <!-- Judul -->
                    <div class="form-group">
                        <label class="form-label" for="title">
                            <i class="fa-solid fa-heading" style="margin-right:.35rem"></i>Judul Aduan <span style="color:#f87171">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $complaint->title) }}"
                            class="form-input"
                            required
                            maxlength="255"
                        >
                        @error('title')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label class="form-label" for="category_id">
                            <i class="fa-solid fa-tag" style="margin-right:.35rem"></i>Kategori <span style="color:#f87171">*</span>
                        </label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (old('category_id', $complaint->category_id) == $cat->id) ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="section-divider">

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label class="form-label" for="description">
                            <i class="fa-solid fa-align-left" style="margin-right:.35rem"></i>Deskripsi Lengkap <span style="color:#f87171">*</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="6"
                            class="form-textarea"
                            required
                        >{{ old('description', $complaint->description) }}</textarea>
                        @error('description')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="section-divider">

                    <!-- Image -->
                    <div class="form-group" x-data="{ preview: null }">
                        <label class="form-label">
                            <i class="fa-solid fa-image" style="margin-right:.35rem"></i>Foto Bukti
                        </label>

                        @if ($complaint->image)
                            <div style="margin-bottom:1rem">
                                <p style="font-size:.8rem;color:#64748b;margin-bottom:.5rem">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $complaint->image) }}" style="max-height:160px;border-radius:10px;border:1px solid var(--border)">
                            </div>
                        @endif

                        <div class="file-input-wrapper" @click="$refs.fileInput2.click()">
                            <div x-show="!preview">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:1.75rem;color:#6366f1;margin-bottom:.5rem"></i>
                                <p style="color:#94a3b8;font-size:.875rem">{{ $complaint->image ? 'Klik untuk ganti foto' : 'Klik untuk pilih foto' }}</p>
                                <p style="font-size:.75rem;color:#64748b">JPG, PNG – Maks. 2MB</p>
                            </div>
                            <div x-show="preview">
                                <img :src="preview" style="max-height:160px;border-radius:8px;margin:0 auto;display:block">
                            </div>
                        </div>

                        <input
                            x-ref="fileInput2"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png"
                            style="display:none"
                            @change="if ($event.target.files[0]) preview = URL.createObjectURL($event.target.files[0])"
                        >

                        @error('image')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div style="display:flex;justify-content:flex-end;gap:.75rem;padding-top:1rem;border-top:1px solid var(--border)">
                        <a href="{{ route('user.complaints.index') }}" class="btn btn-ghost">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

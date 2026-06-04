<x-app-layout>
<div class="user-page">

    <!-- Breadcrumb -->
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;font-size:.85rem;color:#64748b">
        <a href="{{ route('user.complaints.index') }}" style="color:#818cf8;text-decoration:none">Aduan Saya</a>
        <i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i>
        <span>Buat Aduan Baru</span>
    </div>

    <div style="max-width:720px">
        <div style="margin-bottom:1.75rem">
            <h1 style="font-size:1.5rem;font-weight:800;color:#f1f5f9">Buat Aduan Baru</h1>
            <p style="color:#64748b;font-size:.875rem;margin-top:.25rem">Sampaikan masalah Anda dengan detail agar dapat segera ditangani</p>
        </div>

        <div class="card animate-fadein">
            <div class="card-body">
                <form method="POST" action="{{ route('user.complaints.store') }}" enctype="multipart/form-data" id="complaintForm">
                    @csrf

                    <!-- Progress Steps -->
                    <div style="display:flex;gap:.75rem;margin-bottom:2rem">
                        <div style="display:flex;align-items:center;gap:.5rem;flex:1">
                            <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0">1</div>
                            <span style="font-size:.8rem;font-weight:600;color:#818cf8">Informasi</span>
                            <div style="flex:1;height:2px;background:linear-gradient(90deg,#6366f1,rgba(99,102,241,.2));border-radius:1px"></div>
                        </div>
                        <div style="display:flex;align-items:center;gap:.5rem;flex:1">
                            <div style="width:28px;height:28px;border-radius:50%;background:rgba(99,102,241,.15);border:2px solid rgba(99,102,241,.3);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#818cf8;flex-shrink:0">2</div>
                            <span style="font-size:.8rem;color:#64748b">Deskripsi</span>
                            <div style="flex:1;height:2px;background:rgba(99,102,241,.15);border-radius:1px"></div>
                        </div>
                        <div style="display:flex;align-items:center;gap:.5rem">
                            <div style="width:28px;height:28px;border-radius:50%;background:rgba(99,102,241,.15);border:2px solid rgba(99,102,241,.3);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#818cf8;flex-shrink:0">3</div>
                            <span style="font-size:.8rem;color:#64748b">Lampiran</span>
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="form-group">
                        <label class="form-label" for="title">
                            <i class="fa-solid fa-heading" style="margin-right:.35rem"></i>Judul Aduan <span style="color:#f87171">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-input"
                            placeholder="Contoh: Jalan berlubang di depan sekolah SDN 01"
                            required
                            maxlength="255"
                            oninput="updateCharCount(this, 'titleCount', 255)"
                        >
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:.35rem">
                            @error('title')
                                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span id="titleCount" style="font-size:.75rem;color:#64748b">0 / 255</span>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label class="form-label" for="category_id">
                            <i class="fa-solid fa-tag" style="margin-right:.35rem"></i>Kategori <span style="color:#f87171">*</span>
                        </label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">— Pilih kategori yang sesuai —</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                            placeholder="Jelaskan masalah Anda secara lengkap: lokasi, waktu kejadian, dampak yang ditimbulkan, dll."
                            required
                            oninput="updateCharCount(this, 'descCount', 2000)"
                        >{{ old('description') }}</textarea>
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:.35rem">
                            @error('description')
                                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                            @else
                                <span style="font-size:.75rem;color:#64748b"><i class="fa-solid fa-circle-info" style="margin-right:.25rem"></i>Semakin detail, semakin cepat ditangani</span>
                            @enderror
                            <span id="descCount" style="font-size:.75rem;color:#64748b">0 / 2000</span>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <!-- Image Upload -->
                    <div class="form-group" x-data="{ preview: null, fileName: '' }">
                        <label class="form-label">
                            <i class="fa-solid fa-image" style="margin-right:.35rem"></i>Lampiran Foto (Opsional)
                        </label>

                        <div class="file-input-wrapper" @click="$refs.fileInput.click()">
                            <div x-show="!preview" style="pointer-events:none">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:2rem;color:#6366f1;margin-bottom:.5rem"></i>
                                <p style="color:#94a3b8;font-size:.875rem;margin-bottom:.25rem">Klik untuk pilih foto atau seret ke sini</p>
                                <p style="font-size:.75rem;color:#64748b">JPG, PNG – Maks. 2MB</p>
                            </div>
                            <div x-show="preview" style="pointer-events:none">
                                <img :src="preview" style="max-height:200px;border-radius:8px;margin:0 auto;display:block">
                                <p x-text="fileName" style="font-size:.75rem;color:#818cf8;margin-top:.5rem;text-align:center"></p>
                            </div>
                        </div>

                        <input
                            x-ref="fileInput"
                            type="file"
                            name="image"
                            accept="image/jpeg,image/png"
                            style="display:none"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    preview = URL.createObjectURL(file);
                                    fileName = file.name;
                                }
                            "
                        >

                        <button type="button" x-show="preview" @click="preview = null; fileName = ''; $refs.fileInput.value = ''"
                            style="margin-top:.5rem;background:none;border:none;color:#f87171;font-size:.8rem;cursor:pointer">
                            <i class="fa-solid fa-xmark" style="margin-right:.25rem"></i>Hapus foto
                        </button>

                        @error('image')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div style="display:flex;justify-content:flex-end;gap:.75rem;padding-top:1rem;border-top:1px solid var(--border)">
                        <a href="{{ route('user.complaints.index') }}" class="btn btn-ghost">
                            <i class="fa-solid fa-xmark"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Aduan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateCharCount(el, countId, max) {
    const count = el.value.length;
    const counter = document.getElementById(countId);
    if (counter) {
        counter.textContent = `${count} / ${max}`;
        counter.style.color = count > max * 0.9 ? '#f87171' : '#64748b';
    }
}

// Initialize counts
document.addEventListener('DOMContentLoaded', () => {
    const title = document.getElementById('title');
    const desc = document.getElementById('description');
    if (title?.value) updateCharCount(title, 'titleCount', 255);
    if (desc?.value) updateCharCount(desc, 'descCount', 2000);

    // Submit loading state
    document.getElementById('complaintForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
        btn.disabled = true;
    });
});
</script>
</x-app-layout>

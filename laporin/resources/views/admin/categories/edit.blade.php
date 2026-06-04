<x-admin-layout>

<div style="max-width:520px">
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;font-size:.85rem;color:#64748b">
        <a href="{{ route('admin.categories.index') }}" style="color:#818cf8;text-decoration:none">Kategori</a>
        <i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i>
        <span>Edit Kategori</span>
    </div>

    <h1 style="font-size:1.5rem;font-weight:800;color:#f1f5f9;margin-bottom:1.75rem">Edit Kategori</h1>

    <div class="card animate-fadein">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label" for="name">
                        <i class="fa-solid fa-tag" style="margin-right:.35rem"></i>Nama Kategori <span style="color:#f87171">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="form-input"
                        required
                        autofocus
                    >
                    @error('name')
                        <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                    @enderror
                </div>

                <div style="display:flex;gap:.75rem;padding-top:1rem;border-top:1px solid var(--border)">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</x-admin-layout>

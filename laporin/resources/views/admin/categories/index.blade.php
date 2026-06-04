<x-admin-layout>

<!-- Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
    <div>
        <h1 style="font-size:1.75rem;font-weight:800;color:#f1f5f9;margin-bottom:.25rem">Kelola Kategori</h1>
        <p style="color:#64748b;font-size:.875rem">Atur kategori pengaduan yang tersedia</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Kategori
    </a>
</div>

<!-- Table -->
<div class="card animate-fadein">
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Aduan</th>
                    <th>Dibuat</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $i => $cat)
                    <tr>
                        <td style="color:#64748b;font-size:.8rem">{{ $i+1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.75rem">
                                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,rgba(99,102,241,.3),rgba(192,132,252,.2));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <i class="fa-solid fa-tag" style="color:#c084fc;font-size:.85rem"></i>
                                </div>
                                <span style="font-weight:600;color:#e2e8f0">{{ $cat->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.5rem">
                                <span style="font-size:1.1rem;font-weight:700;color:#818cf8">{{ $cat->complaints_count }}</span>
                                <span style="font-size:.75rem;color:#64748b">aduan</span>
                            </div>
                        </td>
                        <td style="color:#64748b;font-size:.8rem">{{ $cat->created_at->format('d M Y') }}</td>
                        <td style="text-align:center">
                            <div style="display:flex;gap:.5rem;justify-content:center">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori \'{{ $cat->name }}\'? Aduan terkait bisa terpengaruh.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:4rem;color:#64748b">
                            <div style="font-size:3rem;margin-bottom:.75rem">🏷️</div>
                            <p style="font-weight:600;color:#94a3b8">Belum ada kategori</p>
                            <a href="{{ route('admin.categories.create') }}" style="color:#818cf8;font-size:.875rem">Tambah kategori pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-admin-layout>

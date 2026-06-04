<x-admin-layout>

<!-- Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
    <div>
        <h1 style="font-size:1.75rem;font-weight:800;color:#f1f5f9;margin-bottom:.25rem">Semua Aduan</h1>
        <p style="color:#64748b;font-size:.875rem">Kelola dan tindaklanjuti pengaduan dari masyarakat</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="card animate-fadein" style="margin-bottom:1.5rem">
    <div class="card-body" style="padding:1.25rem 1.5rem">
        <form method="GET" class="filter-bar">
            <div>
                <label class="form-label" style="margin-bottom:.35rem">Status</label>
                <select name="status" class="form-select" style="width:160px">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>⏳ Pending</option>
                    <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>⚙️ Diproses</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>✅ Selesai</option>
                </select>
            </div>
            <div style="flex:1;min-width:200px">
                <label class="form-label" style="margin-bottom:.35rem">Cari Aduan</label>
                <div style="position:relative">
                    <i class="fa-solid fa-magnifying-glass" style="position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#64748b;font-size:.875rem"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-input"
                        placeholder="Cari judul, pelapor..."
                        style="padding-left:2.5rem"
                    >
                </div>
            </div>
            <div style="display:flex;gap:.5rem;align-self:flex-end">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.complaints.index') }}" class="btn btn-ghost btn-sm">
                    <i class="fa-solid fa-rotate-left"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card animate-fadein-delay-1">
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelapor</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($complaints as $i => $c)
                    <tr>
                        <td style="color:#64748b;font-size:.8rem">{{ $complaints->firstItem() + $i }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.625rem">
                                <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0">
                                    {{ strtoupper(substr($c->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p style="font-weight:600;font-size:.85rem;color:#e2e8f0">{{ $c->user->name }}</p>
                                    <p style="font-size:.75rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:140px">{{ $c->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="max-width:200px">
                            <p style="font-weight:600;color:#e2e8f0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $c->title }}</p>
                            <p style="font-size:.75rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-top:.1rem">{{ Str::limit($c->description, 60) }}</p>
                        </td>
                        <td>
                            <span style="font-size:.75rem;padding:.2rem .625rem;border-radius:999px;background:rgba(192,132,252,.15);color:#c084fc;font-weight:600">{{ $c->category->name }}</span>
                        </td>
                        <td>
                            @if($c->status === 'pending')
                                <span class="badge badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                            @elseif($c->status === 'diproses')
                                <span class="badge badge-diproses"><i class="fa-solid fa-gears"></i> Diproses</span>
                            @else
                                <span class="badge badge-selesai"><i class="fa-solid fa-check"></i> Selesai</span>
                            @endif
                        </td>
                        <td style="color:#64748b;font-size:.8rem;white-space:nowrap">{{ $c->created_at->format('d M Y') }}</td>
                        <td style="text-align:center">
                            <a href="{{ route('admin.complaints.show', $c) }}" class="btn btn-ghost btn-sm">
                                <i class="fa-solid fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:4rem;color:#64748b">
                            <div style="font-size:3rem;margin-bottom:.75rem">📭</div>
                            <p style="font-weight:600;color:#94a3b8">Tidak ada aduan ditemukan</p>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.complaints.index') }}" style="color:#818cf8;font-size:.875rem">Hapus filter</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-wrap">{{ $complaints->links() }}</div>

</x-admin-layout>

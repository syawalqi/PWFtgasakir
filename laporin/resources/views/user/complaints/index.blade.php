<x-app-layout>
<div class="user-page">

    <!-- Header -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.75rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h1 style="font-size:1.5rem;font-weight:800;color:#f1f5f9">Aduan Saya</h1>
            <p style="color:#64748b;font-size:.875rem;margin-top:.2rem">Kelola semua pengaduan yang Anda kirimkan</p>
        </div>
        <a href="{{ route('user.complaints.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Buat Aduan Baru
        </a>
    </div>

    <!-- Filter Tabs -->
    <div x-data="{ tab: '{{ request('tab', 'all') }}' }" style="margin-bottom:1.75rem">
        <div class="tabs" style="max-width:400px">
            <button @click="tab='all';window.location='{{ route('user.complaints.index') }}'" :class="tab==='all' ? 'active' : ''" class="tab-btn">
                Semua
            </button>
            <button @click="tab='pending';window.location='{{ route('user.complaints.index') }}?tab=pending'" :class="tab==='pending' ? 'active' : ''" class="tab-btn">
                Pending
            </button>
            <button @click="tab='diproses';window.location='{{ route('user.complaints.index') }}?tab=diproses'" :class="tab==='diproses' ? 'active' : ''" class="tab-btn">
                Diproses
            </button>
            <button @click="tab='selesai';window.location='{{ route('user.complaints.index') }}?tab=selesai'" :class="tab==='selesai' ? 'active' : ''" class="tab-btn">
                Selesai
            </button>
        </div>
    </div>

    @if ($complaints->count() > 0)
        <div style="display:flex;flex-direction:column;gap:1rem">
            @foreach ($complaints as $complaint)
            <div class="complaint-card animate-fadein" onclick="window.location='{{ route('user.complaints.show', $complaint) }}'" style="cursor:pointer">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap">
                    <div style="flex:1;min-width:0">
                        <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.4rem">
                            <span style="font-size:.7rem;padding:.15rem .5rem;border-radius:999px;background:rgba(192,132,252,.15);color:#c084fc;font-weight:600">
                                {{ $complaint->category->name }}
                            </span>
                            @if($complaint->responses->count() > 0)
                                <span style="font-size:.7rem;padding:.15rem .5rem;border-radius:999px;background:rgba(16,185,129,.15);color:#34d399;font-weight:600">
                                    <i class="fa-solid fa-comment-dots" style="margin-right:.2rem"></i>{{ $complaint->responses->count() }} respons
                                </span>
                            @endif
                        </div>
                        <h3 style="font-size:1rem;font-weight:700;color:#f1f5f9;margin-bottom:.3rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                            {{ $complaint->title }}
                        </h3>
                        <p style="font-size:.8rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">
                            {{ $complaint->description }}
                        </p>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5rem;flex-shrink:0">
                        @if($complaint->status === 'pending')
                            <span class="badge badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                        @elseif($complaint->status === 'diproses')
                            <span class="badge badge-diproses"><i class="fa-solid fa-gears"></i> Diproses</span>
                        @else
                            <span class="badge badge-selesai"><i class="fa-solid fa-check"></i> Selesai</span>
                        @endif
                        <span style="font-size:.75rem;color:#475569;white-space:nowrap">
                            <i class="fa-regular fa-calendar" style="margin-right:.25rem"></i>
                            {{ $complaint->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>

                @if($complaint->isPending())
                <div style="display:flex;gap:.5rem;margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border)" onclick="event.stopPropagation()">
                    <a href="{{ route('user.complaints.edit', $complaint) }}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('user.complaints.destroy', $complaint) }}" onsubmit="return confirmDelete(this)">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">{{ $complaints->links() }}</div>

    @else
        <div class="card">
            <div class="card-body" style="text-align:center;padding:4rem">
                <div class="empty-icon">📭</div>
                <h3 style="font-size:1.1rem;font-weight:700;color:#e2e8f0;margin-bottom:.5rem">Belum Ada Aduan</h3>
                <p style="color:#94a3b8;font-size:.875rem;margin-bottom:1.5rem">Anda belum memiliki aduan. Buat aduan pertama Anda sekarang!</p>
                <a href="{{ route('user.complaints.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Buat Aduan Sekarang
                </a>
            </div>
        </div>
    @endif
</div>

<script>
function confirmDelete(form) {
    if (confirm('Yakin ingin menghapus aduan ini? Tindakan ini tidak dapat dibatalkan.')) {
        form.submit();
    }
    return false;
}
</script>
</x-app-layout>

<x-admin-layout>

<!-- Breadcrumb -->
<div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;font-size:.85rem;color:#64748b">
    <a href="{{ route('admin.complaints.index') }}" style="color:#818cf8;text-decoration:none"><i class="fa-solid fa-inbox" style="margin-right:.35rem"></i>Semua Aduan</a>
    <i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i>
    <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:300px">{{ $complaint->title }}</span>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start" id="complaint-grid">

    <!-- Left Column -->
    <div>
        <!-- Complaint Header -->
        <div class="card animate-fadein" style="margin-bottom:1.5rem">
            <div class="card-body">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.25rem">
                    <div style="flex:1;min-width:0">
                        <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;margin-bottom:.5rem">
                            <span style="font-size:.75rem;padding:.2rem .625rem;border-radius:999px;background:rgba(192,132,252,.15);color:#c084fc;font-weight:600">
                                <i class="fa-solid fa-tag" style="margin-right:.25rem"></i>{{ $complaint->category->name }}
                            </span>
                            @if($complaint->status === 'pending')
                                <span class="badge badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>
                            @elseif($complaint->status === 'diproses')
                                <span class="badge badge-diproses"><i class="fa-solid fa-gears"></i> Diproses</span>
                            @else
                                <span class="badge badge-selesai"><i class="fa-solid fa-check"></i> Selesai</span>
                            @endif
                        </div>
                        <h1 style="font-size:1.4rem;font-weight:800;color:#f1f5f9;margin-bottom:.5rem">{{ $complaint->title }}</h1>
                        <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
                            <div style="display:flex;align-items:center;gap:.5rem">
                                <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:#fff;flex-shrink:0">
                                    {{ strtoupper(substr($complaint->user->name, 0, 1)) }}
                                </div>
                                <span style="font-size:.85rem;font-weight:600;color:#94a3b8">{{ $complaint->user->name }}</span>
                            </div>
                            <span style="font-size:.8rem;color:#475569">
                                <i class="fa-regular fa-clock" style="margin-right:.25rem"></i>{{ $complaint->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                <hr class="section-divider">

                <p style="line-height:1.8;color:#cbd5e1;white-space:pre-wrap">{{ $complaint->description }}</p>

                @if ($complaint->image)
                    <div style="margin-top:1.5rem">
                        <p style="font-size:.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem">
                            <i class="fa-solid fa-image" style="margin-right:.35rem"></i>Foto Lampiran
                        </p>
                        <img
                            src="{{ asset('storage/'.$complaint->image) }}"
                            alt="Lampiran"
                            style="max-width:100%;border-radius:12px;border:1px solid var(--border);cursor:pointer;transition:.2s"
                            onclick="openLightbox(this.src)"
                            onmouseover="this.style.transform='scale(1.01)'"
                            onmouseout="this.style.transform='scale(1)'"
                        >
                    </div>
                @endif
            </div>
        </div>

        <!-- Responses -->
        <div class="card animate-fadein-delay-1" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-comments" style="color:#818cf8;margin-right:.5rem"></i>
                    Riwayat Tanggapan
                    @if($complaint->responses->count() > 0)
                        <span style="margin-left:.5rem;font-size:.75rem;padding:.15rem .5rem;border-radius:999px;background:rgba(99,102,241,.2);color:#818cf8">{{ $complaint->responses->count() }}</span>
                    @endif
                </h3>
            </div>
            <div class="card-body">
                @forelse ($complaint->responses as $r)
                    <div style="display:flex;gap:.75rem;margin-bottom:1.25rem">
                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f43f5e,#e11d48);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0">
                            {{ strtoupper(substr($r->user->name, 0, 1)) }}
                        </div>
                        <div style="flex:1">
                            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem;flex-wrap:wrap">
                                <span style="font-size:.85rem;font-weight:700;color:#e2e8f0">{{ $r->user->name }}</span>
                                <span style="font-size:.7rem;padding:.1rem .4rem;border-radius:999px;background:rgba(244,63,94,.15);color:#fb7185;font-weight:600">Admin</span>
                                <span style="font-size:.75rem;color:#475569;margin-left:auto">{{ $r->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="response-bubble response-admin">
                                <p style="font-size:.875rem;line-height:1.6;color:#cbd5e1">{{ $r->message }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="padding:2rem">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">💬</div>
                        <p style="font-size:.875rem">Belum ada tanggapan untuk aduan ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Add Response Form -->
        <div class="card animate-fadein-delay-2">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-reply" style="color:#818cf8;margin-right:.5rem"></i>Tambah Tanggapan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.responses.store', $complaint) }}" id="responseForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Pesan Tanggapan</label>
                        <textarea
                            name="message"
                            rows="4"
                            class="form-textarea"
                            placeholder="Tulis tanggapan resmi Anda di sini..."
                            required
                        ></textarea>
                        @error('message')
                            <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
                        @enderror
                    </div>
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit" class="btn btn-primary" id="responseBtn">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Tanggapan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column – Actions -->
    <div style="display:flex;flex-direction:column;gap:1rem">
        <!-- Update Status -->
        <div class="card animate-fadein">
            <div class="card-body">
                <h4 style="font-size:.875rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1rem">
                    <i class="fa-solid fa-sliders" style="margin-right:.35rem;color:#818cf8"></i>Update Status
                </h4>
                <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-select" style="margin-bottom:.75rem">
                            <option value="pending" {{ $complaint->status=='pending'?'selected':'' }}>⏳ Pending</option>
                            <option value="diproses" {{ $complaint->status=='diproses'?'selected':'' }}>⚙️ Diproses</option>
                            <option value="selesai" {{ $complaint->status=='selesai'?'selected':'' }}>✅ Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
                        <i class="fa-solid fa-rotate"></i> Perbarui Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card animate-fadein-delay-1">
            <div class="card-body">
                <h4 style="font-size:.875rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1rem">
                    <i class="fa-solid fa-circle-info" style="margin-right:.35rem;color:#818cf8"></i>Informasi
                </h4>
                <div style="display:flex;flex-direction:column;gap:.75rem">
                    <div>
                        <p style="font-size:.75rem;color:#64748b;margin-bottom:.2rem">Pelapor</p>
                        <p style="font-size:.875rem;font-weight:600;color:#e2e8f0">{{ $complaint->user->name }}</p>
                        <p style="font-size:.75rem;color:#64748b">{{ $complaint->user->email }}</p>
                    </div>
                    <hr class="section-divider" style="margin:.25rem 0">
                    <div>
                        <p style="font-size:.75rem;color:#64748b;margin-bottom:.2rem">Kategori</p>
                        <span style="font-size:.8rem;padding:.25rem .75rem;border-radius:999px;background:rgba(192,132,252,.15);color:#c084fc;font-weight:600">{{ $complaint->category->name }}</span>
                    </div>
                    <hr class="section-divider" style="margin:.25rem 0">
                    <div>
                        <p style="font-size:.75rem;color:#64748b;margin-bottom:.2rem">Tanggal Lapor</p>
                        <p style="font-size:.875rem;color:#e2e8f0">{{ $complaint->created_at->format('d M Y') }}</p>
                        <p style="font-size:.75rem;color:#64748b">{{ $complaint->created_at->format('H:i') }} WIB</p>
                    </div>
                    <hr class="section-divider" style="margin:.25rem 0">
                    <div>
                        <p style="font-size:.75rem;color:#64748b;margin-bottom:.2rem">Jumlah Tanggapan</p>
                        <p style="font-size:1.5rem;font-weight:800;color:#818cf8">{{ $complaint->responses->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-ghost" style="justify-content:center">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

</div>

<!-- Lightbox -->
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:999;align-items:center;justify-content:center;cursor:pointer" onclick="closeLightbox()">
    <img id="lightbox-img" style="max-width:90vw;max-height:90vh;border-radius:12px;object-fit:contain">
</div>

<style>
@media (max-width: 900px) {
    #complaint-grid { grid-template-columns: 1fr !important; }
}
</style>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

document.getElementById('responseForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('responseBtn');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
    btn.disabled = true;
});
</script>

</x-admin-layout>

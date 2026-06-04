<x-app-layout>
<div class="user-page">

    <!-- Breadcrumb -->
    <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1.75rem;font-size:.85rem;color:#64748b">
        <a href="{{ route('user.complaints.index') }}" style="color:#818cf8;text-decoration:none">Aduan Saya</a>
        <i class="fa-solid fa-chevron-right" style="font-size:.65rem"></i>
        <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px">{{ $complaint->title }}</span>
    </div>

    <div style="max-width:780px">

        <!-- Header -->
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;margin-bottom:1.5rem">
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
                <h1 style="font-size:1.4rem;font-weight:800;color:#f1f5f9;margin-bottom:.25rem">{{ $complaint->title }}</h1>
                <p style="font-size:.8rem;color:#64748b">
                    <i class="fa-regular fa-clock" style="margin-right:.3rem"></i>
                    Dilaporkan {{ $complaint->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            @if ($complaint->isPending())
            <div style="display:flex;gap:.5rem;flex-shrink:0">
                <a href="{{ route('user.complaints.edit', $complaint) }}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form method="POST" action="{{ route('user.complaints.destroy', $complaint) }}" onsubmit="return confirm('Yakin hapus aduan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- Description Card -->
        <div class="card animate-fadein" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-file-lines" style="color:#818cf8;margin-right:.5rem"></i>Detail Aduan</h3>
            </div>
            <div class="card-body">
                <p style="line-height:1.8;color:#cbd5e1;white-space:pre-wrap">{{ $complaint->description }}</p>

                @if ($complaint->image)
                    <div style="margin-top:1.5rem">
                        <p style="font-size:.8rem;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem">
                            <i class="fa-solid fa-image" style="margin-right:.35rem"></i>Foto Lampiran
                        </p>
                        <img
                            src="{{ asset('storage/' . $complaint->image) }}"
                            alt="Foto aduan"
                            style="max-width:100%;border-radius:12px;border:1px solid var(--border);cursor:pointer"
                            onclick="openLightbox(this.src)"
                        >
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Timeline -->
        <div class="card animate-fadein-delay-1" style="margin-bottom:1.5rem">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-timeline" style="color:#818cf8;margin-right:.5rem"></i>Status Aduan</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot" style="background:#10b981"></div>
                        <p style="font-size:.875rem;font-weight:600;color:#e2e8f0">Aduan Diterima</p>
                        <p style="font-size:.8rem;color:#64748b;margin-top:.1rem">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    @if(in_array($complaint->status, ['diproses', 'selesai']))
                    <div class="timeline-item">
                        <div class="timeline-dot" style="background:#6366f1"></div>
                        <p style="font-size:.875rem;font-weight:600;color:#e2e8f0">Sedang Diproses</p>
                        <p style="font-size:.8rem;color:#64748b;margin-top:.1rem">Aduan sedang ditangani</p>
                    </div>
                    @else
                    <div class="timeline-item">
                        <div class="timeline-dot" style="background:var(--surface-3);border-color:var(--border)"></div>
                        <p style="font-size:.875rem;color:#475569">Menunggu diproses</p>
                    </div>
                    @endif
                    @if($complaint->status === 'selesai')
                    <div class="timeline-item">
                        <div class="timeline-dot" style="background:#10b981"></div>
                        <p style="font-size:.875rem;font-weight:600;color:#34d399">Aduan Selesai ✓</p>
                    </div>
                    @else
                    <div class="timeline-item">
                        <div class="timeline-dot" style="background:var(--surface-3);border-color:var(--border)"></div>
                        <p style="font-size:.875rem;color:#475569">Penyelesaian</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Responses -->
        <div class="card animate-fadein-delay-2">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa-solid fa-comments" style="color:#818cf8;margin-right:.5rem"></i>
                    Tanggapan
                    @if($complaint->responses->count() > 0)
                        <span style="margin-left:.5rem;font-size:.75rem;padding:.15rem .5rem;border-radius:999px;background:rgba(99,102,241,.2);color:#818cf8">{{ $complaint->responses->count() }}</span>
                    @endif
                </h3>
            </div>
            <div class="card-body">
                @forelse ($complaint->responses as $response)
                    <div style="display:flex;gap:.75rem;margin-bottom:1.25rem">
                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#f43f5e,#e11d48);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0">
                            {{ strtoupper(substr($response->user->name, 0, 1)) }}
                        </div>
                        <div style="flex:1">
                            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.35rem">
                                <span style="font-size:.85rem;font-weight:700;color:#e2e8f0">{{ $response->user->name }}</span>
                                <span style="font-size:.7rem;padding:.1rem .4rem;border-radius:999px;background:rgba(244,63,94,.15);color:#fb7185;font-weight:600">Admin</span>
                                <span style="font-size:.75rem;color:#475569;margin-left:auto">{{ $response->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="response-bubble response-admin">
                                <p style="font-size:.875rem;line-height:1.6;color:#cbd5e1">{{ $response->message }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="padding:2rem">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">💬</div>
                        <p style="font-size:.875rem">Belum ada tanggapan dari admin.</p>
                        <p style="font-size:.8rem;color:#475569;margin-top:.25rem">Tim kami akan segera merespons aduan Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:999;align-items:center;justify-content:center;cursor:pointer" onclick="closeLightbox()">
    <img id="lightbox-img" style="max-width:90vw;max-height:90vh;border-radius:12px;object-fit:contain">
</div>

<script>
function openLightbox(src) {
    const lb = document.getElementById('lightbox');
    document.getElementById('lightbox-img').src = src;
    lb.style.display = 'flex';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
</x-app-layout>

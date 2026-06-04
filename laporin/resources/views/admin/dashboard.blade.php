<x-admin-layout>

<!-- Page Header -->
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem">
    <div>
        <h1 style="font-size:1.75rem;font-weight:800;color:#f1f5f9;margin-bottom:.25rem">Dashboard Admin</h1>
        <p style="color:#64748b;font-size:.875rem"><i class="fa-regular fa-calendar" style="margin-right:.35rem"></i>{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
    <a href="{{ route('admin.complaints.index') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-inbox"></i> Kelola Aduan
    </a>
</div>

<!-- Stats Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1rem;margin-bottom:2rem">
    <div class="stat-card blue animate-fadein">
        <div class="stat-icon">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div class="stat-value" data-counter="{{ $total }}">0</div>
        <div class="stat-label">Total Aduan</div>
    </div>
    <div class="stat-card yellow animate-fadein-delay-1">
        <div class="stat-icon">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="stat-value" data-counter="{{ $pending }}">0</div>
        <div class="stat-label">Menunggu</div>
    </div>
    <div class="stat-card amber animate-fadein-delay-2">
        <div class="stat-icon">
            <i class="fa-solid fa-gears"></i>
        </div>
        <div class="stat-value" data-counter="{{ $diproses }}">0</div>
        <div class="stat-label">Diproses</div>
    </div>
    <div class="stat-card green animate-fadein-delay-3">
        <div class="stat-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="stat-value" data-counter="{{ $selesai }}">0</div>
        <div class="stat-label">Selesai</div>
    </div>
</div>

<!-- Donut chart area + Completion rate -->
@if($total > 0)
<div style="display:grid;grid-template-columns:1fr 280px;gap:1.5rem;margin-bottom:2rem" id="dashboard-grid">
    <!-- Recent complaints table -->
    <div class="card animate-fadein">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-clock-rotate-left" style="color:#818cf8;margin-right:.5rem"></i>Aduan Terbaru</h3>
            <a href="{{ route('admin.complaints.index') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
        </div>
        <div style="overflow-x:auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentComplaints as $c)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.625rem">
                                    <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:#fff;flex-shrink:0">
                                        {{ strtoupper(substr($c->user->name, 0, 1)) }}
                                    </div>
                                    <span style="font-weight:500;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $c->user->name }}</span>
                                </div>
                            </td>
                            <td style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:500">{{ $c->title }}</td>
                            <td>
                                <span style="font-size:.75rem;padding:.2rem .6rem;border-radius:999px;background:rgba(192,132,252,.15);color:#c084fc;font-weight:600">{{ $c->category->name }}</span>
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
                            <td>
                                <a href="{{ route('admin.complaints.show', $c) }}" class="btn btn-ghost btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Completion Rate Card -->
    <div style="display:flex;flex-direction:column;gap:1rem">
        <div class="card animate-fadein-delay-1">
            <div class="card-body">
                <h4 style="font-size:.875rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1rem">Tingkat Penyelesaian</h4>
                <div style="text-align:center;margin-bottom:1.5rem">
                    <div style="font-size:3rem;font-weight:800;color:#34d399">{{ $total > 0 ? round($selesai/$total*100) : 0 }}%</div>
                    <p style="font-size:.8rem;color:#64748b">aduan berhasil diselesaikan</p>
                </div>
                <div style="display:flex;flex-direction:column;gap:.75rem">
                    @php
                        $wPending = $total > 0 ? round($pending/$total*100) : 0;
                        $wDiproses = $total > 0 ? round($diproses/$total*100) : 0;
                        $wSelesai = $total > 0 ? round($selesai/$total*100) : 0;
                    @endphp
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                            <span style="font-size:.75rem;color:#fbbf24;font-weight:600">Pending</span>
                            <span style="font-size:.75rem;color:#94a3b8">{{ $pending }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" @style(["width: {$wPending}%", "background: linear-gradient(90deg,#f59e0b,#fbbf24)"])></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                            <span style="font-size:.75rem;color:#a5b4fc;font-weight:600">Diproses</span>
                            <span style="font-size:.75rem;color:#94a3b8">{{ $diproses }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" @style(["width: {$wDiproses}%"])></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                            <span style="font-size:.75rem;color:#34d399;font-weight:600">Selesai</span>
                            <span style="font-size:.75rem;color:#94a3b8">{{ $selesai }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" @style(["width: {$wSelesai}%", "background: linear-gradient(90deg,#10b981,#34d399)"])></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card animate-fadein-delay-2">
            <div class="card-body">
                <h4 style="font-size:.875rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1rem">Aksi Cepat</h4>
                <div style="display:flex;flex-direction:column;gap:.5rem">
                    <a href="{{ route('admin.complaints.index', ['status' => 'pending']) }}" class="btn btn-ghost btn-sm" style="justify-content:flex-start">
                        <i class="fa-solid fa-clock" style="color:#fbbf24"></i>
                        Aduan Pending ({{ $pending }})
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-ghost btn-sm" style="justify-content:flex-start">
                        <i class="fa-solid fa-plus" style="color:#818cf8"></i>
                        Tambah Kategori
                    </a>
                    <a href="{{ route('admin.complaints.index') }}" class="btn btn-ghost btn-sm" style="justify-content:flex-start">
                        <i class="fa-solid fa-inbox" style="color:#34d399"></i>
                        Semua Aduan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="card animate-fadein">
    <div class="card-body" style="text-align:center;padding:4rem">
        <div style="font-size:4rem;margin-bottom:1rem">📭</div>
        <h3 style="font-weight:700;color:#e2e8f0;margin-bottom:.5rem">Belum Ada Aduan</h3>
        <p style="color:#94a3b8;font-size:.875rem">Aduan dari pengguna akan muncul di sini.</p>
    </div>
</div>
@endif

<style>
@media (max-width: 768px) {
    #dashboard-grid { grid-template-columns: 1fr !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter);
        let start = 0;
        const step = Math.max(target / 60, 1);
        const timer = setInterval(() => {
            start = Math.min(start + step, target);
            el.textContent = Math.floor(start);
            if (start >= target) { el.textContent = target; clearInterval(timer); }
        }, 16);
    });
});
</script>

</x-admin-layout>

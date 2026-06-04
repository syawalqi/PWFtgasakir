<x-app-layout>
<div class="user-page">

    <!-- Welcome Banner -->
    <div style="background:linear-gradient(135deg,rgba(99,102,241,.15) 0%,rgba(192,132,252,.08) 100%);border:1px solid rgba(99,102,241,.25);border-radius:18px;padding:1.75rem 2rem;margin-bottom:2rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem" class="animate-fadein">
        <div>
            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.4rem">
                <div style="width:8px;height:8px;border-radius:50%;background:#10b981;animation:pulse-ring 2s infinite"></div>
                <span style="font-size:.75rem;color:#34d399;font-weight:600;text-transform:uppercase;letter-spacing:.05em">Akun Aktif</span>
            </div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#f1f5f9;margin-bottom:.25rem">
                Halo, {{ Auth::user()->name }}! 👋
            </h1>
            <p style="color:#94a3b8;font-size:.9rem">Kelola dan pantau semua aduan Anda dari sini.</p>
        </div>
        <a href="{{ route('user.complaints.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i>
            Buat Aduan Baru
        </a>
    </div>

    <!-- Stats -->
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
            <div class="stat-label">Pending</div>
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

    <!-- Progress Visual -->
    @if($total > 0)
    <div class="card animate-fadein" style="margin-bottom:2rem">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-chart-pie" style="color:#818cf8;margin-right:.5rem"></i>Progres Aduan</h3>
            <span style="font-size:.8rem;color:#64748b">Total: {{ $total }}</span>
        </div>
        <div class="card-body">
            <div style="display:flex;flex-direction:column;gap:.875rem">
                @php
                    $wPending = $total > 0 ? round($pending/$total*100) : 0;
                    $wDiproses = $total > 0 ? round($diproses/$total*100) : 0;
                    $wSelesai = $total > 0 ? round($selesai/$total*100) : 0;
                @endphp
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                        <span style="font-size:.8rem;color:#fbbf24;font-weight:600"><i class="fa-solid fa-clock" style="margin-right:.3rem"></i>Pending</span>
                        <span style="font-size:.8rem;color:#94a3b8">{{ $wPending }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" @style(["width: {$wPending}%", "background: linear-gradient(90deg,#f59e0b,#fbbf24)"])></div>
                    </div>
                </div>
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                        <span style="font-size:.8rem;color:#a5b4fc;font-weight:600"><i class="fa-solid fa-gears" style="margin-right:.3rem"></i>Diproses</span>
                        <span style="font-size:.8rem;color:#94a3b8">{{ $wDiproses }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" @style(["width: {$wDiproses}%"])></div>
                    </div>
                </div>
                <div>
                    <div style="display:flex;justify-content:space-between;margin-bottom:.35rem">
                        <span style="font-size:.8rem;color:#34d399;font-weight:600"><i class="fa-solid fa-circle-check" style="margin-right:.3rem"></i>Selesai</span>
                        <span style="font-size:.8rem;color:#94a3b8">{{ $wSelesai }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" @style(["width: {$wSelesai}%", "background: linear-gradient(90deg,#10b981,#34d399)"])></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Action -->
    @if($total == 0)
    <div class="empty-state card animate-fadein">
        <div class="card-body" style="text-align:center;padding:3rem">
            <div class="empty-icon">📭</div>
            <h3 style="font-size:1.1rem;font-weight:700;color:#e2e8f0;margin-bottom:.5rem">Belum Ada Aduan</h3>
            <p style="color:#94a3b8;font-size:.875rem;margin-bottom:1.5rem">Mulai sampaikan masalah Anda agar dapat segera ditangani.</p>
            <a href="{{ route('user.complaints.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Buat Aduan Pertama Anda
            </a>
        </div>
    </div>
    @else
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
        <h2 style="font-size:1rem;font-weight:700;color:#e2e8f0"><i class="fa-solid fa-inbox" style="color:#818cf8;margin-right:.5rem"></i>Aduan Terbaru</h2>
        <a href="{{ route('user.complaints.index') }}" class="btn btn-ghost btn-sm">Lihat Semua <i class="fa-solid fa-arrow-right" style="margin-left:.3rem"></i></a>
    </div>
    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter);
        let start = 0;
        const step = target / 60;
        const timer = setInterval(() => {
            start = Math.min(start + step, target);
            el.textContent = Math.floor(start);
            if (start >= target) clearInterval(timer);
        }, 16);
    });
    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.progress-fill').forEach(el => {
            el.style.transition = 'width 1.2s cubic-bezier(.4,0,.2,1)';
        });
    }, 100);
});
</script>
</x-app-layout>

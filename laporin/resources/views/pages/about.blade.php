<x-app-layout>
<div class="user-page">

    <!-- Hero -->
    <div style="text-align:center;padding:3rem 1rem;margin-bottom:2.5rem;background:linear-gradient(135deg,rgba(99,102,241,.1),rgba(192,132,252,.07));border:1px solid rgba(99,102,241,.2);border-radius:20px" class="animate-fadein">
        <div style="width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;font-size:2rem">
            <i class="fa-solid fa-megaphone" style="color:#fff"></i>
        </div>
        <h1 style="font-size:2rem;font-weight:800;color:#f1f5f9;margin-bottom:.5rem">Tentang <span class="gradient-text">LaporIn</span></h1>
        <p style="color:#94a3b8;font-size:1rem;max-width:500px;margin:0 auto;line-height:1.7">
            Platform pengaduan masyarakat digital yang menghubungkan warga dengan pengelola untuk penanganan masalah yang transparan dan akuntabel.
        </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem;margin-bottom:2rem">

        <!-- What is LaporIn -->
        <div class="card animate-fadein">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-circle-question" style="color:#818cf8;margin-right:.5rem"></i>Apa itu LaporIn?</h3>
            </div>
            <div class="card-body">
                <p style="color:#94a3b8;line-height:1.8;font-size:.9rem">
                    LaporIn adalah sistem manajemen pengaduan masyarakat berbasis web yang memungkinkan warga untuk melaporkan masalah di lingkungan mereka secara mudah, cepat, dan terpantau.
                </p>
                <p style="color:#94a3b8;line-height:1.8;font-size:.9rem;margin-top:.75rem">
                    Setiap aduan yang masuk akan diproses oleh admin dan mendapatkan respons resmi, sehingga tidak ada aduan yang terabaikan.
                </p>
            </div>
        </div>

        <!-- How it Works -->
        <div class="card animate-fadein-delay-1">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-gears" style="color:#818cf8;margin-right:.5rem"></i>Cara Kerja</h3>
            </div>
            <div class="card-body">
                <div style="display:flex;flex-direction:column;gap:1rem">
                    @foreach([
                        ['fa-user-plus', '#818cf8', 'Daftar Akun', 'Buat akun gratis dengan email Anda'],
                        ['fa-paper-plane', '#34d399', 'Kirim Aduan', 'Isi formulir dengan detail masalah dan foto'],
                        ['fa-gears', '#fbbf24', 'Diproses Admin', 'Admin meninjau dan menindaklanjuti aduan'],
                        ['fa-circle-check', '#34d399', 'Selesai', 'Terima tanggapan resmi dan masalah teratasi'],
                    ] as $i => $step)
                    <div style="display:flex;align-items:center;gap:.875rem">
                        <div style="width:36px;height:36px;border-radius:10px;background:rgba(99,102,241,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:.85rem">
                            <i class="fa-solid {{ $step[0] }}" {!! 'style="color:' . $step[1] . '"' !!}></i>
                        </div>
                        <div>
                            <p style="font-size:.875rem;font-weight:700;color:#e2e8f0">{{ $step[2] }}</p>
                            <p style="font-size:.8rem;color:#64748b">{{ $step[3] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- Status Legend -->
    <div class="card animate-fadein-delay-2" style="margin-bottom:2rem">
        <div class="card-header">
            <h3 class="card-title"><i class="fa-solid fa-traffic-light" style="color:#818cf8;margin-right:.5rem"></i>Status Aduan</h3>
        </div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem">
                <div style="display:flex;align-items:center;gap:.75rem;padding:1rem;background:rgba(245,158,11,.08);border:1px solid rgba(245,158,11,.2);border-radius:12px">
                    <span class="badge badge-pending" style="flex-shrink:0"><i class="fa-solid fa-clock"></i> Pending</span>
                    <p style="font-size:.8rem;color:#94a3b8">Aduan baru diterima, menunggu ditinjau</p>
                </div>
                <div style="display:flex;align-items:center;gap:.75rem;padding:1rem;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.2);border-radius:12px">
                    <span class="badge badge-diproses" style="flex-shrink:0"><i class="fa-solid fa-gears"></i> Diproses</span>
                    <p style="font-size:.8rem;color:#94a3b8">Sedang dalam proses penanganan</p>
                </div>
                <div style="display:flex;align-items:center;gap:.75rem;padding:1rem;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.2);border-radius:12px">
                    <span class="badge badge-selesai" style="flex-shrink:0"><i class="fa-solid fa-check"></i> Selesai</span>
                    <p style="font-size:.8rem;color:#94a3b8">Masalah telah diselesaikan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="card animate-fadein-delay-3">
        <div class="card-body" style="text-align:center;padding:2rem">
            <h3 style="font-size:1.1rem;font-weight:700;color:#e2e8f0;margin-bottom:1rem">
                <i class="fa-solid fa-envelope" style="color:#818cf8;margin-right:.5rem"></i>Hubungi Kami
            </h3>
            <a href="mailto:support@lapor.in" style="color:#818cf8;font-size:1rem;font-weight:600;text-decoration:none">
                support@lapor.in
            </a>
            <p style="color:#64748b;font-size:.8rem;margin-top:.5rem">Kami siap membantu Senin–Jumat, 08:00–17:00 WIB</p>
        </div>
    </div>

</div>
</x-app-layout>

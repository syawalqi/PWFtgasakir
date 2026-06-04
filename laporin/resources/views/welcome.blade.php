<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LaporIn') }} – Platform Pengaduan Masyarakat</title>
    <meta name="description" content="LaporIn adalah platform pengaduan masyarakat digital. Laporkan masalah di lingkungan Anda dan pantau progresnya secara transparan.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<!-- ──── NAVBAR ──── -->
<nav style="position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(15,15,26,.85);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,.07)">
    <div style="max-width:1200px;margin:0 auto;padding:0 1.5rem;height:64px;display:flex;align-items:center;justify-content:space-between">
        <a href="/" style="display:flex;align-items:center;gap:.75rem;text-decoration:none">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#c084fc);border-radius:10px;display:flex;align-items:center;justify-content:center">
                <i class="fa-solid fa-megaphone" style="color:#fff;font-size:.85rem"></i>
            </div>
            <span style="font-size:1.25rem;font-weight:800;color:#f1f5f9">LaporIn</span>
        </a>
        <div style="display:flex;align-items:center;gap:.75rem">
            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                <i class="fa-solid fa-user-plus"></i>Daftar Gratis
            </a>
        </div>
    </div>
</nav>

<!-- ──── HERO ──── -->
<section class="landing-hero" style="padding-top:8rem">
    <!-- Orbs -->
    <div class="landing-bg-orb orb-1"></div>
    <div class="landing-bg-orb orb-2"></div>
    <div class="landing-bg-orb orb-3"></div>

    <div style="position:relative;z-index:1;max-width:800px;margin:0 auto">
        <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(99,102,241,.15);border:1px solid rgba(99,102,241,.3);border-radius:999px;padding:.375rem 1rem;margin-bottom:1.5rem;font-size:.8rem;font-weight:600;color:#a5b4fc" class="animate-fadein">
            <span style="width:6px;height:6px;border-radius:50%;background:#818cf8;animation:pulse-ring 2s infinite"></span>
            Platform Pengaduan Digital Terpercaya
        </div>

        <h1 style="font-size:clamp(2.5rem,6vw,4.5rem);font-weight:900;line-height:1.1;margin-bottom:1.25rem;letter-spacing:-.02em" class="animate-fadein-delay-1">
            Suara Anda,<br>
            <span class="gradient-text">Aksi Nyata</span>
        </h1>

        <p style="font-size:1.15rem;color:#94a3b8;line-height:1.7;max-width:560px;margin:0 auto 2.5rem" class="animate-fadein-delay-2">
            Laporkan masalah di sekitar Anda dengan mudah. Pantau progres secara transparan dan dapatkan tanggapan resmi.
        </p>

        <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center" class="animate-fadein-delay-3">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg" style="animation:pulse-ring 3s infinite">
                <i class="fa-solid fa-rocket"></i>
                Mulai Sekarang – Gratis
            </a>
            <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">
                <i class="fa-solid fa-right-to-bracket"></i>
                Masuk ke Akun
            </a>
        </div>

        <!-- Stats -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:2.5rem;margin-top:4rem;padding-top:2.5rem;border-top:1px solid rgba(255,255,255,.07)" class="animate-fadein-delay-3">
            <div style="text-align:center">
                <p style="font-size:2rem;font-weight:800;color:#f1f5f9">100%</p>
                <p style="font-size:.8rem;color:#64748b">Transparan</p>
            </div>
            <div style="text-align:center">
                <p style="font-size:2rem;font-weight:800;color:#f1f5f9">24/7</p>
                <p style="font-size:.8rem;color:#64748b">Aksesibilitas</p>
            </div>
            <div style="text-align:center">
                <p style="font-size:2rem;font-weight:800;color:#f1f5f9">3x</p>
                <p style="font-size:.8rem;color:#64748b">Status Update</p>
            </div>
        </div>
    </div>
</section>

<!-- ──── FEATURES ──── -->
<section style="padding:6rem 1.5rem;max-width:1200px;margin:0 auto">
    <div style="text-align:center;margin-bottom:3.5rem">
        <h2 style="font-size:2.25rem;font-weight:800;margin-bottom:.75rem">Kenapa <span class="gradient-text">LaporIn?</span></h2>
        <p style="color:#94a3b8;font-size:1rem;max-width:500px;margin:0 auto">Kami menyederhanakan proses pengaduan agar setiap suara didengar dan ditindaklanjuti</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem">
        <div class="feature-card animate-fadein">
            <div class="feature-icon" style="background:rgba(99,102,241,.15)">
                <i class="fa-solid fa-paper-plane" style="color:#818cf8"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Lapor Instan</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Formulir online yang dirancang simpel. Kirim aduan beserta foto bukti dalam hitungan menit.</p>
        </div>

        <div class="feature-card animate-fadein-delay-1">
            <div class="feature-icon" style="background:rgba(16,185,129,.15)">
                <i class="fa-solid fa-magnifying-glass-chart" style="color:#34d399"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Pantau Real-time</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Ikuti perkembangan status aduan Anda — Pending, Diproses, hingga Selesai secara transparan.</p>
        </div>

        <div class="feature-card animate-fadein-delay-2">
            <div class="feature-icon" style="background:rgba(244,63,94,.15)">
                <i class="fa-solid fa-shield-halved" style="color:#fb7185"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Aman & Terpercaya</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Data Anda dilindungi. Setiap aduan diverifikasi dan ditangani oleh petugas berwenang.</p>
        </div>

        <div class="feature-card animate-fadein-delay-3">
            <div class="feature-icon" style="background:rgba(245,158,11,.15)">
                <i class="fa-solid fa-comments" style="color:#fbbf24"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Tanggapan Resmi</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Admin memberikan respons tertulis untuk setiap aduan yang masuk sehingga Anda selalu informed.</p>
        </div>

        <div class="feature-card animate-fadein">
            <div class="feature-icon" style="background:rgba(192,132,252,.15)">
                <i class="fa-solid fa-tags" style="color:#c084fc"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Kategori Terorganisir</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Aduan dikelompokkan berdasarkan kategori agar proses penanganan lebih cepat dan tepat sasaran.</p>
        </div>

        <div class="feature-card animate-fadein-delay-1">
            <div class="feature-icon" style="background:rgba(20,184,166,.15)">
                <i class="fa-solid fa-mobile-screen" style="color:#2dd4bf"></i>
            </div>
            <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:.5rem">Akses dari Mana Saja</h3>
            <p style="font-size:.9rem;color:#94a3b8;line-height:1.6">Platform responsif yang bisa diakses dari smartphone, tablet, maupun komputer kapan saja.</p>
        </div>
    </div>
</section>

<!-- ──── HOW IT WORKS ──── -->
<section style="padding:5rem 1.5rem;background:linear-gradient(180deg,transparent,rgba(99,102,241,.05),transparent)">
    <div style="max-width:900px;margin:0 auto;text-align:center">
        <h2 style="font-size:2.25rem;font-weight:800;margin-bottom:.75rem">Cara Kerja <span class="gradient-text">LaporIn</span></h2>
        <p style="color:#94a3b8;margin-bottom:3.5rem">Tiga langkah mudah untuk menyampaikan aduan Anda</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:2rem;position:relative">
            <div style="text-align:center">
                <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;font-weight:900;color:#fff;box-shadow:0 0 30px rgba(99,102,241,.4)">1</div>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:.5rem">Buat Akun</h3>
                <p style="font-size:.875rem;color:#94a3b8;line-height:1.6">Daftar gratis dengan email Anda. Proses cepat, tidak perlu verifikasi panjang.</p>
            </div>
            <div style="text-align:center">
                <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#f43f5e,#e11d48);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;font-weight:900;color:#fff;box-shadow:0 0 30px rgba(244,63,94,.4)">2</div>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:.5rem">Kirim Aduan</h3>
                <p style="font-size:.875rem;color:#94a3b8;line-height:1.6">Isi formulir dengan detail masalah, pilih kategori, dan lampirkan foto bila perlu.</p>
            </div>
            <div style="text-align:center">
                <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;font-weight:900;color:#fff;box-shadow:0 0 30px rgba(16,185,129,.4)">3</div>
                <h3 style="font-size:1rem;font-weight:700;margin-bottom:.5rem">Pantau & Terima Respons</h3>
                <p style="font-size:.875rem;color:#94a3b8;line-height:1.6">Pantau status real-time dan terima tanggapan resmi dari petugas.</p>
            </div>
        </div>
    </div>
</section>

<!-- ──── CTA ──── -->
<section style="padding:6rem 1.5rem">
    <div style="max-width:700px;margin:0 auto;text-align:center;background:linear-gradient(135deg,rgba(99,102,241,.15),rgba(192,132,252,.1));border:1px solid rgba(99,102,241,.25);border-radius:24px;padding:4rem 2rem">
        <div style="font-size:3rem;margin-bottom:1.25rem">📣</div>
        <h2 style="font-size:2rem;font-weight:800;margin-bottom:.75rem">Siap untuk Bersuara?</h2>
        <p style="color:#94a3b8;margin-bottom:2rem;line-height:1.7">Bergabung sekarang dan jadilah bagian dari masyarakat yang aktif berkontribusi pada lingkungan yang lebih baik.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-user-plus"></i>
            Daftar Gratis Sekarang
        </a>
    </div>
</section>

<!-- ──── FOOTER ──── -->
<footer style="border-top:1px solid rgba(255,255,255,.07);padding:2rem 1.5rem;text-align:center;color:#475569;font-size:.875rem">
    <p>© {{ date('Y') }} <strong style="color:#818cf8">LaporIn</strong>. Platform Pengaduan Masyarakat Digital.</p>
</footer>

</body>
</html>

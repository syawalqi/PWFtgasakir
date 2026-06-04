<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LaporIn') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="auth-page">
    <!-- Left decorative panel -->
    <div class="auth-panel-left">
        <!-- Orbs -->
        <div class="landing-bg-orb orb-1"></div>
        <div class="landing-bg-orb orb-2"></div>

        <!-- Content -->
        <div style="position:relative;z-index:1;text-align:center;max-width:400px">
            <div style="display:flex;align-items:center;justify-content:center;gap:.75rem;margin-bottom:2rem">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#6366f1,#c084fc);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;animation:float 4s ease-in-out infinite">
                    <i class="fa-solid fa-megaphone" style="color:#fff"></i>
                </div>
                <h1 style="font-size:2rem;font-weight:800;color:#f1f5f9">LaporIn</h1>
            </div>

            <p style="font-size:1.1rem;color:#94a3b8;line-height:1.7;margin-bottom:2.5rem">
                Platform pengaduan masyarakat digital. Sampaikan aspirasi, pantau progres, dan dapatkan tanggapan resmi.
            </p>

            <div style="display:grid;gap:1rem">
                <div style="display:flex;align-items:center;gap:1rem;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:1rem">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(99,102,241,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="fa-solid fa-paper-plane" style="color:#818cf8"></i>
                    </div>
                    <div style="text-align:left">
                        <p style="font-weight:600;color:#e2e8f0;font-size:.9rem">Lapor Mudah</p>
                        <p style="font-size:.8rem;color:#64748b">Formulir online yang cepat dan ringkas</p>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:1rem;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:1rem">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="fa-solid fa-magnifying-glass" style="color:#34d399"></i>
                    </div>
                    <div style="text-align:left">
                        <p style="font-weight:600;color:#e2e8f0;font-size:.9rem">Pantau Real-time</p>
                        <p style="font-size:.8rem;color:#64748b">Status aduan selalu diperbarui transparan</p>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:1rem;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:1rem">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(244,63,94,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="fa-solid fa-comments" style="color:#fb7185"></i>
                    </div>
                    <div style="text-align:left">
                        <p style="font-weight:600;color:#e2e8f0;font-size:.9rem">Tanggapan Resmi</p>
                        <p style="font-size:.8rem;color:#64748b">Admin merespons setiap aduan Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right form panel -->
    <div class="auth-panel-right">
        <!-- Logo for mobile -->
        <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:2rem">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#6366f1,#c084fc);border-radius:10px;display:flex;align-items:center;justify-content:center">
                <i class="fa-solid fa-megaphone" style="color:#fff;font-size:.8rem"></i>
            </div>
            <span style="font-size:1.25rem;font-weight:800;color:#f1f5f9">LaporIn</span>
        </div>

        <div style="width:100%">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>

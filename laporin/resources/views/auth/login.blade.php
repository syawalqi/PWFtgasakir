<x-guest-layout>
    <h2 style="font-size:1.6rem;font-weight:800;color:#f1f5f9;margin-bottom:.5rem">Selamat Datang Kembali</h2>
    <p style="font-size:.875rem;color:#64748b;margin-bottom:1.75rem">Masuk ke akun LaporIn Anda</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" style="width:100%">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">
                <i class="fa-solid fa-envelope" style="margin-right:.35rem"></i>Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-input"
                placeholder="nama@email.com"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">
                <i class="fa-solid fa-lock" style="margin-right:.35rem"></i>Password
            </label>
            <div style="position:relative" x-data="{ show: false }">
                <input
                    id="password"
                    :type="show ? 'text' : 'password'"
                    name="password"
                    class="form-input"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    style="padding-right:2.75rem"
                >
                <button type="button" @click="show = !show"
                    style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:.85rem;transition:.2s"
                    :style="show ? 'color:#818cf8' : ''"
                >
                    <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password')
                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
            <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    style="width:16px;height:16px;accent-color:#6366f1;border-radius:4px">
                <span style="font-size:.875rem;color:#94a3b8">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   style="font-size:.875rem;color:#818cf8;text-decoration:none;transition:.2s"
                   onmouseover="this.style.color='#a5b4fc'"
                   onmouseout="this.style.color='#818cf8'"
                >Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center">
            <i class="fa-solid fa-right-to-bracket"></i>
            Masuk
        </button>

        <div class="divider-text" style="margin:1.5rem 0">atau</div>

        <p style="text-align:center;font-size:.875rem;color:#64748b">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color:#818cf8;font-weight:600;text-decoration:none">
                Daftar sekarang
            </a>
        </p>
    </form>
</x-guest-layout>

<x-guest-layout>
    <h2 style="font-size:1.6rem;font-weight:800;color:#f1f5f9;margin-bottom:.5rem">Buat Akun Baru</h2>
    <p style="font-size:.875rem;color:#64748b;margin-bottom:1.75rem">Bergabung dengan LaporIn dan mulai laporkan masalah Anda</p>

    <form method="POST" action="{{ route('register') }}" style="width:100%">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">
                <i class="fa-solid fa-user" style="margin-right:.35rem"></i>Nama Lengkap
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-input"
                placeholder="Masukkan nama Anda"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

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
                    placeholder="Min. 8 karakter"
                    required
                    autocomplete="new-password"
                    style="padding-right:2.75rem"
                >
                <button type="button" @click="show = !show"
                    style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:.85rem"
                >
                    <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password')
                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">
                <i class="fa-solid fa-shield-halved" style="margin-right:.35rem"></i>Konfirmasi Password
            </label>
            <div style="position:relative" x-data="{ show: false }">
                <input
                    id="password_confirmation"
                    :type="show ? 'text' : 'password'"
                    name="password_confirmation"
                    class="form-input"
                    placeholder="Ulangi password"
                    required
                    autocomplete="new-password"
                    style="padding-right:2.75rem"
                >
                <button type="button" @click="show = !show"
                    style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:.85rem"
                >
                    <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg" style="width:100%;justify-content:center;margin-top:.5rem">
            <i class="fa-solid fa-user-plus"></i>
            Daftar Sekarang
        </button>

        <div class="divider-text" style="margin:1.5rem 0">atau</div>

        <p style="text-align:center;font-size:.875rem;color:#64748b">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color:#818cf8;font-weight:600;text-decoration:none">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>

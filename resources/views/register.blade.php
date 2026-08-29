<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page register-page">

<div class="card card--wide">
    <!-- Brand -->
    <div class="brand">
        <div class="brand-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
        </div>
        <h1>NexaTopUp</h1>
        <p>Top-up game favoritmu dengan cepat &amp; aman</p>
    </div>

    <p class="form-title">Buat Akun Baru</p>
    <p class="form-subtitle">Bergabung dan mulai top-up sekarang 🚀</p>

    @if ($errors->any())
        <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama (2 kolom) -->
        <div class="grid-2">
            <div class="input-group">
                <label for="first_name">Nama Depan</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        placeholder="Budi"
                        required
                    >
                </div>
                @error('first_name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="last_name">Nama Belakang</label>
                <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        placeholder="Santoso"
                    >
                </div>
            </div>
        </div>

        <!-- Email -->
        <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@kamu.com"
                    autocomplete="email"
                    required
                >
            </div>
            @error('email') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- No. HP -->
        <div class="input-group">
            <label for="phone">No. HP</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="17" x2="12" y2="17" stroke-width="2.5"/></svg>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    autocomplete="tel"
                >
            </div>
            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Min. 8 karakter"
                    autocomplete="new-password"
                    class="has-toggle"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePassword('password', this)" tabindex="-1" aria-label="Tampilkan password">
                    <svg class="icon-eye" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="input-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Min. 8 karakter"
                    autocomplete="new-password"
                    class="has-toggle"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePassword('password_confirmation', this)" tabindex="-1" aria-label="Tampilkan password">
                    <svg class="icon-eye" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Terms -->
        <label class="terms">
            <input type="checkbox" name="terms" required>
            <span>Saya setuju dengan <a href="{{ route('terms') }}">Syarat &amp; Ketentuan</a> dan <a href="{{ route('privacy') }}">Kebijakan Privasi</a> NexaTopUp</span>
        </label>

        <button type="submit" class="btn-primary">Buat Akun</button>
    </form>

    <div class="divider">sudah punya akun?</div>

    <p class="login-link">
        <a href="{{ route('login') }}">Masuk ke akun kamu</a>
    </p>
</div>

<script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>

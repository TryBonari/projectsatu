<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-page">

<div class="card">
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

    <p class="form-title">Masuk ke Akun</p>
    <p class="form-subtitle">Selamat datang kembali 👋</p>

    {{-- Session error --}}
    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="M2 7l10 7 10-7"/>
                </svg>
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

        <!-- Password -->
        <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    class="has-toggle"
                    required
                >
                <button type="button" class="toggle-pw" id="togglePassword" aria-label="Tampilkan password">
                    <!-- Eye open -->
                    <svg id="eyeOpen" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <!-- Eye closed (hidden by default) -->
                    <svg id="eyeClosed" viewBox="0 0 24 24" style="display:none"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
            </div>
            @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- Remember -->
        <div class="form-row">
            <label class="remember">
                <input type="checkbox" name="remember"> Ingat saya
            </label>
        </div>

        <button type="submit" class="btn-primary">Masuk</button>
    </form>

    <div class="divider">atau</div>

    <p class="register-link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </p>
</div>

<script>
    (function () {
        var btn    = document.getElementById('togglePassword');
        var input  = document.getElementById('password');
        var eyeOn  = document.getElementById('eyeOpen');
        var eyeOff = document.getElementById('eyeClosed');

        btn.addEventListener('click', function () {
            var isHidden = input.type === 'password';
            input.type   = isHidden ? 'text' : 'password';
            eyeOn.style.display  = isHidden ? 'none'  : '';
            eyeOff.style.display = isHidden ? ''      : 'none';
            btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        });
    })();
</script>
</body>
</html>

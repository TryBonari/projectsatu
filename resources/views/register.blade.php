<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0b0e1a;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 24px 16px;
        }

        body::before {
            content: '';
            position: fixed;
            top: -200px;
            left: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 57, 255, 0.18) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 194, 255, 0.14) 0%, transparent 70%);
            pointer-events: none;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 48px 40px;
            backdrop-filter: blur(20px);
            position: relative;
            z-index: 1;
        }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            body { align-items: flex-start; }
            .card {
                padding: 36px 24px;
                border-radius: 16px;
            }
            .brand h1 { font-size: 20px; }
            .form-title { font-size: 16px; }
            /* Stack name fields to single column on mobile */
            .grid-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 360px) {
            .card { padding: 28px 16px; }
        }

        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            margin-bottom: 16px;
        }
        .brand-icon svg {
            width: 28px;
            height: 28px;
            fill: #fff;
        }
        .brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.3px;
        }
        .brand p {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            margin-top: 4px;
        }

        .form-title {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 6px;
        }
        .form-subtitle {
            font-size: 13px;
            color: rgba(255,255,255,0.4);
            margin-bottom: 28px;
        }

        .input-group {
            margin-bottom: 18px;
        }
        .input-group label {
            display: block;
            font-size: 12.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px;
            height: 15px;
            stroke: rgba(255,255,255,0.28);
            fill: none;
            stroke-width: 1.7;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 40px 12px 38px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #ffffff;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .input-wrap input::placeholder { color: rgba(255,255,255,0.25); }
        .input-wrap input:focus {
            border-color: rgba(99, 57, 255, 0.7);
            background: rgba(99, 57, 255, 0.07);
        }

        /* Toggle password visibility button */
        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.3);
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: rgba(255,255,255,0.7); }
        .toggle-pw svg {
            width: 16px;
            height: 16px;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            pointer-events: none;
        }

        /* Two-column grid for name fields */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
            line-height: 1.5;
        }
        .terms input[type="checkbox"] {
            accent-color: #6339ff;
            width: 14px;
            height: 14px;
            margin-top: 2px;
            flex-shrink: 0;
            cursor: pointer;
        }
        .terms a {
            color: #6339ff;
            text-decoration: none;
            font-weight: 500;
        }
        .terms a:hover { color: #00c2ff; }

        .btn-primary {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-primary:hover  { opacity: 0.88; }
        .btn-primary:active { transform: scale(0.98); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: rgba(255,255,255,0.2);
            font-size: 12px;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        .login-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .login-link a {
            color: #6339ff;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover { color: #00c2ff; }

        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 13px;
            color: #fca5a5;
            margin-bottom: 20px;
        }
        .field-error {
            font-size: 12px;
            color: #f87171;
            margin-top: 6px;
            padding-left: 2px;
        }
    </style>
</head>
<body>

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

    <p class="form-title">Buat Akun Baru</p>
    <p class="form-subtitle">Bergabung dan mulai top-up sekarang 🚀</p>

    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name row -->
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

        <!-- Phone -->
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
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePassword('password', this)" tabindex="-1" aria-label="Tampilkan password">
                    <svg class="icon-eye" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- Confirm Password -->
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
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePassword('password_confirmation', this)" tabindex="-1" aria-label="Tampilkan password">
                    <svg class="icon-eye" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display:none">
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
            <span>Saya setuju dengan <a href="#">Syarat &amp; Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> NexaTopUp</span>
        </label>

        <button type="submit" class="btn-primary">Buat Akun</button>
    </form>

    <script>
        function togglePassword(id, btn) {
            var input = document.getElementById(id);
            var isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.querySelector('.icon-eye').style.display     = isHidden ? 'none' : '';
            btn.querySelector('.icon-eye-off').style.display = isHidden ? ''     : 'none';
            btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        }
    </script>

    <div class="divider">sudah punya akun?</div>

    <p class="login-link">
        <a href="{{ route('login') }}">Masuk ke akun kamu</a>
    </p>
</div>

</body>
</html>

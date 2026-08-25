<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0b0e1a;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 24px 16px;
        }

        /* Ambient background orbs */
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
            max-width: 420px;
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
            .card {
                padding: 36px 24px;
                border-radius: 16px;
            }
            .brand h1 { font-size: 20px; }
            .form-title { font-size: 16px; }
            .form-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 360px) {
            .card { padding: 28px 16px; }
        }

        /* Logo / brand */
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

        /* Form heading */
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

        /* Input group */
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
        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            stroke: rgba(255,255,255,0.3);
            fill: none;
            stroke-width: 1.8;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 40px;
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

        /* Row: remember + forgot */
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            cursor: pointer;
        }
        .remember input[type="checkbox"] {
            accent-color: #6339ff;
            width: 14px;
            height: 14px;
            cursor: pointer;
        }
        .forgot {
            font-size: 13px;
            color: #7c5cd8;
            text-decoration: none;
            font-weight: 500;
        }
        .forgot:hover { color: #00c2ff; }

        /* Submit button */
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

        /* Divider */
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

        /* Register link */
        .register-link {
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .register-link a {
            color: #6339ff;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover { color: #00c2ff; }

        /* Error / validation */
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
            <!-- Lightning bolt icon -->
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
        <div class="alert-error">{{ session('error') }}</div>
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
                    required
                >
            </div>
            @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <!-- Remember + Forgot -->
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

</body>
</html>

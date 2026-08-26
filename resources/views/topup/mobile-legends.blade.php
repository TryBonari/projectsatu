<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up Mobile Legends — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0b0e1a;
            color: #ffffff;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: -220px; left: -220px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,57,255,0.16) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(0,194,255,0.12) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }

        /* ── Navbar ── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(11,14,26,0.88);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 0 24px; height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .nav-brand-icon {
            width: 32px; height: 32px; border-radius: 9px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .nav-brand-icon svg { width: 16px; height: 16px; fill: #fff; }
        .nav-brand span { font-size: 15px; font-weight: 700; color: #fff; letter-spacing: -0.2px; }

        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-back {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px; border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.5); font-size: 13px;
            text-decoration: none; font-weight: 500;
            transition: background 0.2s, color 0.2s;
        }
        .nav-back svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .nav-back:hover { background: rgba(255,255,255,0.07); color: #fff; }

        .nav-saldo {
            font-size: 13px; color: rgba(255,255,255,0.45);
        }
        .nav-saldo strong { color: #a78bff; font-weight: 700; }

        /* ── Page ── */
        .page {
            max-width: 860px;
            margin: 0 auto;
            padding: 32px 20px 60px;
            position: relative; z-index: 1;
        }

        /* ── Hero banner ── */
        .hero {
            display: flex;
            align-items: center;
            gap: 20px;
            background: linear-gradient(135deg, rgba(99,57,255,0.22) 0%, rgba(0,194,255,0.12) 100%);
            border: 1px solid rgba(99,57,255,0.3);
            border-radius: 18px;
            padding: 24px 28px;
            margin-bottom: 32px;
        }
        .hero-img {
            width: 72px; height: 72px;
            border-radius: 16px;
            overflow: hidden;
            flex-shrink: 0;
            background: rgba(255,255,255,0.08);
        }
        .hero-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .hero-info h1 { font-size: 20px; font-weight: 700; letter-spacing: -0.3px; margin-bottom: 4px; }
        .hero-info p  { font-size: 13px; color: rgba(255,255,255,0.45); }

        /* ── Alerts ── */
        .alert {
            display: flex; align-items: center; gap: 8px;
            border-radius: 10px; padding: 12px 16px;
            font-size: 13px; margin-bottom: 24px;
        }
        .alert svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .alert-error   { background: rgba(239,68,68,0.12);  border: 1px solid rgba(239,68,68,0.3);   color: #fca5a5; }
        .alert-success { background: rgba(34,197,94,0.10);  border: 1px solid rgba(34,197,94,0.25);  color: #86efac; }

        /* ── Section label ── */
        .section-label {
            font-size: 11px; font-weight: 600;
            letter-spacing: 0.8px; text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-bottom: 12px;
        }

        /* ── ID form ── */
        .id-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 28px;
        }
        @media (max-width: 480px) { .id-row { grid-template-columns: 1fr; } }

        .field label {
            display: block;
            font-size: 12px; font-weight: 500;
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.3px; text-transform: uppercase;
            margin-bottom: 8px;
        }
        .field input {
            width: 100%;
            padding: 11px 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            color: #ffffff;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .field input::placeholder { color: rgba(255,255,255,0.22); }
        .field input:focus {
            border-color: rgba(99,57,255,0.7);
            background: rgba(99,57,255,0.07);
        }
        .field-hint {
            font-size: 11px; color: rgba(255,255,255,0.3);
            margin-top: 6px;
        }
        .field-error-msg {
            font-size: 11.5px; color: #f87171;
            margin-top: 5px;
        }

        /* ── Package grid ── */
        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 28px;
        }
        @media (max-width: 640px) { .pkg-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 420px) { .pkg-grid { grid-template-columns: repeat(2, 1fr); } }

        .pkg-card {
            position: relative;
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 14px 12px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, transform 0.15s;
            background: rgba(255,255,255,0.03);
            user-select: none;
        }
        .pkg-card:hover {
            border-color: rgba(99,57,255,0.5);
            background: rgba(99,57,255,0.08);
            transform: translateY(-2px);
        }
        .pkg-card.selected {
            border-color: #6339ff;
            background: rgba(99,57,255,0.15);
        }
        .pkg-card.selected::after {
            content: '✓';
            position: absolute;
            top: 6px; right: 9px;
            font-size: 11px;
            color: #a78bff;
            font-weight: 700;
        }
        /* hide the real radio */
        .pkg-card input[type="radio"] {
            position: absolute; opacity: 0; pointer-events: none;
        }
        .pkg-diamond {
            font-size: 12.5px; font-weight: 700;
            color: #ffffff; margin-bottom: 5px;
        }
        .pkg-price {
            font-size: 11.5px; color: rgba(255,255,255,0.4);
        }

        /* ── Submit ── */
        .btn-topup {
            width: 100%; padding: 14px;
            border: none; border-radius: 10px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            color: #ffffff;
            font-size: 14px; font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer; letter-spacing: 0.2px;
            transition: opacity 0.2s, transform 0.15s;
        }
        .btn-topup:hover  { opacity: 0.88; }
        .btn-topup:active { transform: scale(0.98); }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">
            <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        </div>
        <span>NexaTopUp</span>
    </a>
    <div class="nav-right">
        <span class="nav-saldo">Saldo: <strong>Rp {{ number_format($user->saldo, 0, ',', '.') }}</strong></span>
        <a href="{{ route('dashboard') }}" class="nav-back">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>
</nav>

<!-- Page -->
<div class="page">

    @if(session('error'))
        <div class="alert alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Hero -->
    <div class="hero">
        <div class="hero-img">
            <img src="{{ asset('images/games/mobile-legends.png') }}" alt="Mobile Legends">
        </div>
        <div class="hero-info">
            <h1>Mobile Legends: Bang Bang</h1>
            <p>Top-up Diamond & Pass langsung ke akun kamu</p>
        </div>
    </div>

    <form method="POST" action="{{ route('topup.ml.process') }}">
        @csrf

        <!-- User ID -->
        <div class="section-label">Masukkan ID Akun</div>
        <div class="id-row">
            <div class="field">
                <label for="user_id_game">User ID</label>
                <input
                    type="text"
                    id="user_id_game"
                    name="user_id_game"
                    value="{{ old('user_id_game') }}"
                    placeholder="Contoh: 123456789"
                    maxlength="50"
                    required
                >
                <p class="field-hint">Temukan User ID di pojok kiri atas profil in-game.</p>
                @error('user_id_game') <p class="field-error-msg">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <label for="zone_id">Zone ID</label>
                <input
                    type="text"
                    id="zone_id"
                    name="zone_id"
                    value="{{ old('zone_id') }}"
                    placeholder="Contoh: 1234"
                    maxlength="20"
                    required
                >
                <p class="field-hint">Zone ID ada di bawah User ID, dipisah oleh ( ).</p>
                @error('zone_id') <p class="field-error-msg">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Packages -->
        <div class="section-label">Pilih Nominal</div>
        <div class="pkg-grid" id="pkgGrid">
            @foreach($packages as $pkg)
                <label class="pkg-card {{ old('package_id') == $pkg['id'] ? 'selected' : '' }}">
                    <input
                        type="radio"
                        name="package_id"
                        value="{{ $pkg['id'] }}"
                        {{ old('package_id') == $pkg['id'] ? 'checked' : '' }}
                        required
                    >
                    <div class="pkg-diamond">{{ $pkg['label'] }}</div>
                    <div class="pkg-price">Rp {{ number_format($pkg['amount'], 0, ',', '.') }}</div>
                </label>
            @endforeach
        </div>

        <button type="submit" class="btn-topup">Beli Sekarang</button>
    </form>

</div>

<script>
    // Toggle selected class saat package diklik
    document.querySelectorAll('.pkg-card').forEach(function(card) {
        card.addEventListener('click', function() {
            document.querySelectorAll('.pkg-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
</script>

</body>
</html>

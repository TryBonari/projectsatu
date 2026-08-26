<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0b0e1a; color: #ffffff; min-height: 100vh;
        }
        body::before {
            content: ''; position: fixed; top: -220px; left: -220px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,57,255,0.18) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }
        body::after {
            content: ''; position: fixed; bottom: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(0,194,255,0.14) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }

        /* ── Navbar ── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(11,14,26,0.88); backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 0 24px; height: 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
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

        /* ── Page ── */
        .page {
            max-width: 520px;
            margin: 0 auto;
            padding: 36px 20px 60px;
            position: relative; z-index: 1;
            display: flex; flex-direction: column; align-items: center;
        }

        /* ── Header ── */
        .page-title {
            font-size: 20px; font-weight: 700; letter-spacing: -0.3px;
            margin-bottom: 4px; text-align: center;
        }
        .page-sub {
            font-size: 13px; color: rgba(255,255,255,0.4);
            text-align: center; margin-bottom: 28px;
        }

        /* ── Amount badge ── */
        .amount-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, rgba(99,57,255,0.25), rgba(0,194,255,0.15));
            border: 1px solid rgba(99,57,255,0.4);
            border-radius: 12px; padding: 12px 24px;
            margin-bottom: 28px;
        }
        .amount-label { font-size: 12px; font-weight: 500; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.5px; }
        .amount-value { font-size: 24px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }

        /* ── QRIS card ── */
        .qris-card {
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            display: flex; flex-direction: column; align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            box-shadow: 0 0 60px rgba(99,57,255,0.2);
        }
        .qris-header {
            width: 100%;
            display: flex; align-items: center; justify-content: space-between;
        }
        .qris-brand {
            font-size: 17px; font-weight: 800; color: #1a0a4a;
            letter-spacing: -0.3px;
        }
        .qris-brand span { color: #6339ff; }
        .qris-label {
            font-size: 10.5px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #888; background: #f0f0f0;
            padding: 3px 9px; border-radius: 20px;
        }

        .qris-img-wrap {
            position: relative;
            width: 240px; height: 240px;
        }
        .qris-img-wrap img {
            width: 100%; height: 100%;
            display: block; border-radius: 8px;
        }
        /* Logo overlay di tengah QR */
        .qris-logo {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 42px; height: 42px; border-radius: 10px;
            background: linear-gradient(135deg, #6339ff, #00c2ff);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 0 0 4px #fff;
        }
        .qris-logo svg { width: 22px; height: 22px; fill: #fff; }

        .qris-footer {
            width: 100%;
            text-align: center;
        }
        .qris-merchant { font-size: 13px; font-weight: 700; color: #1a0a4a; margin-bottom: 2px; }
        .qris-nominal  { font-size: 18px; font-weight: 800; color: #6339ff; }

        /* ── Countdown timer ── */
        .timer-wrap {
            display: flex; align-items: center; gap: 8px;
            background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.25);
            border-radius: 10px; padding: 10px 18px; margin-bottom: 20px; width: 100%;
            justify-content: center;
        }
        .timer-wrap svg { width: 15px; height: 15px; stroke: #facc15; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .timer-text { font-size: 13px; color: rgba(255,255,255,0.6); }
        .timer-count { font-size: 14px; font-weight: 700; color: #facc15; min-width: 40px; display: inline-block; text-align: center; }

        /* ── Buttons ── */
        .btn-group { display: flex; flex-direction: column; gap: 10px; width: 100%; }

        .btn-confirm {
            width: 100%; padding: 14px; border: none; border-radius: 12px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            color: #ffffff; font-size: 14px; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-confirm svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round; }
        .btn-confirm:hover  { opacity: 0.88; }
        .btn-confirm:active { transform: scale(0.98); }

        .btn-download {
            width: 100%; padding: 12px; border-radius: 12px;
            border: 1px solid rgba(99,57,255,0.4);
            background: rgba(99,57,255,0.1);
            color: #a78bff; font-size: 13.5px; font-weight: 600;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            text-decoration: none;
        }
        .btn-download svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .btn-download:hover { background: rgba(99,57,255,0.2); border-color: rgba(99,57,255,0.6); }

        .btn-cancel {
            width: 100%; padding: 11px; border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            background: transparent;
            color: rgba(255,255,255,0.35); font-size: 13px; font-weight: 500;
            font-family: 'Inter', sans-serif; cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }
        .btn-cancel:hover { background: rgba(255,255,255,0.05); color: rgba(255,255,255,0.6); }

        /* ── Steps info ── */
        .steps {
            width: 100%; margin-top: 28px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px; padding: 18px 20px;
        }
        .steps-title {
            font-size: 12px; font-weight: 600; letter-spacing: 0.6px;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            margin-bottom: 14px;
        }
        .step {
            display: flex; align-items: flex-start; gap: 12px; margin-bottom: 12px;
        }
        .step:last-child { margin-bottom: 0; }
        .step-num {
            width: 22px; height: 22px; border-radius: 50%;
            background: rgba(99,57,255,0.25); border: 1px solid rgba(99,57,255,0.4);
            color: #a78bff; font-size: 11px; font-weight: 700;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .step-text { font-size: 13px; color: rgba(255,255,255,0.55); line-height: 1.5; }
        .step-text strong { color: rgba(255,255,255,0.85); font-weight: 600; }
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
        <a href="{{ route('saldo') }}" class="nav-back">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>
</nav>

<!-- Page -->
<div class="page">

    <p class="page-title">Scan & Bayar</p>
    <p class="page-sub">Scan QR di bawah menggunakan aplikasi m-banking atau e-wallet kamu</p>

    <!-- Nominal -->
    <div class="amount-badge">
        <div>
            <div class="amount-label">Total Pembayaran</div>
            <div class="amount-value">Rp {{ number_format($amount, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- QRIS Card -->
    <div class="qris-card">
        <div class="qris-header">
            <div class="qris-brand">Nexa<span>TopUp</span></div>
            <div class="qris-label">QRIS</div>
        </div>
        <div class="qris-img-wrap">
            <img src="{{ $qrisUrl }}" alt="QRIS NexaTopUp" id="qrisImg">
            <div class="qris-logo">
                <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
            </div>
        </div>
        <div class="qris-footer">
            <div class="qris-merchant">NexaTopUp</div>
            <div class="qris-nominal">Rp {{ number_format($amount, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Countdown -->
    <div class="timer-wrap">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span class="timer-text">Berlaku selama</span>
        <span class="timer-count" id="countdown">15:00</span>
        <span class="timer-text">menit</span>
    </div>

    <!-- Buttons -->
    <div class="btn-group">

        {{-- Tombol konfirmasi pembayaran --}}
        <form method="POST" action="{{ route('saldo.confirm') }}">
            @csrf
            <button type="submit" class="btn-confirm">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Konfirmasi Pembayaran
            </button>
        </form>

        {{-- Tombol download QRIS --}}
        <a href="{{ $qrisUrl }}"
           download="QRIS-NexaTopUp-{{ $amount }}.png"
           class="btn-download"
           target="_blank">
            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download QRIS
        </a>

        {{-- Tombol batal --}}
        <a href="{{ route('saldo') }}">
            <button type="button" class="btn-cancel" onclick="window.location='{{ route('saldo') }}'">
                Batalkan
            </button>
        </a>

    </div>

    <!-- Steps -->
    <div class="steps">
        <div class="steps-title">Cara Pembayaran</div>
        <div class="step">
            <div class="step-num">1</div>
            <div class="step-text">Buka aplikasi <strong>m-banking</strong> atau <strong>e-wallet</strong> (GoPay, OVO, Dana, dll)</div>
        </div>
        <div class="step">
            <div class="step-num">2</div>
            <div class="step-text">Pilih menu <strong>Scan QR</strong> atau <strong>Bayar</strong>, lalu arahkan kamera ke QR code di atas</div>
        </div>
        <div class="step">
            <div class="step-num">3</div>
            <div class="step-text">Pastikan nominal sesuai: <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong>, lalu konfirmasi pembayaran</div>
        </div>
        <div class="step">
            <div class="step-num">4</div>
            <div class="step-text">Klik tombol <strong>"Konfirmasi Pembayaran"</strong> di atas setelah transaksi berhasil</div>
        </div>
    </div>

</div>

<script>
    // Countdown 15 menit
    var total = 15 * 60;
    var el    = document.getElementById('countdown');

    var timer = setInterval(function () {
        total--;
        var m = String(Math.floor(total / 60)).padStart(2, '0');
        var s = String(total % 60).padStart(2, '0');
        el.textContent = m + ':' + s;

        if (total <= 60) {
            el.style.color = '#f87171'; // merah kalau < 1 menit
            document.querySelector('.timer-wrap').style.borderColor = 'rgba(239,68,68,0.35)';
            document.querySelector('.timer-wrap').style.background  = 'rgba(239,68,68,0.08)';
        }

        if (total <= 0) {
            clearInterval(timer);
            el.textContent = '00:00';
            // Redirect otomatis ke saldo saat expired
            window.location.href = '{{ route('saldo') }}';
        }
    }, 1000);
</script>

</body>
</html>

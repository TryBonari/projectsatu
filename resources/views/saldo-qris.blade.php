<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saldo-qris.css') }}">
</head>
<body>

@include('partials.navbar', [
    'showLinks' => false,
    'showUser'  => false,
    'backLink'  => route('saldo'),
])

<div class="page">

    <p class="page-title">Scan &amp; Bayar</p>
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

    <!-- Tombol Aksi -->
    <div class="btn-group">

        <form method="POST" action="{{ route('saldo.confirm') }}">
            @csrf
            <button type="submit" class="btn-confirm">
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                Konfirmasi Pembayaran
            </button>
        </form>

        <a href="{{ $qrisUrl }}"
           download="QRIS-NexaTopUp-{{ $amount }}.png"
           class="btn-download"
           target="_blank">
            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download QRIS
        </a>

        <a href="{{ route('saldo') }}">
            <button type="button" class="btn-cancel">Batalkan</button>
        </a>

    </div>

    <!-- Langkah Pembayaran -->
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

{{-- Inject route ke JS agar tidak ada Blade di dalam file JS --}}
<script>var SALDO_ROUTE = '{{ route('saldo') }}';</script>
<script src="{{ asset('js/saldo-qris.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $transaction->id }} — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">
</head>
<body>

@include('partials.navbar', [
    'activeNav' => 'transaksi',
    'showLinks' => true,
    'showUser'  => true,
])

<div class="detail-page">

    <!-- Nomor Invoice -->
    <span class="invoice-number">{{ $transaction->invoiceNumber() }}</span>

    <!-- Status Banner -->
    <div class="status-banner {{ $transaction->status }}">
        <div class="status-icon">
            @if($transaction->status === 'success')
                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            @elseif($transaction->status === 'failed')
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            @elseif($transaction->status === 'processing')
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            @else
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            @endif
        </div>
        <div class="status-info">
            <h3>{{ $transaction->statusLabel() }}</h3>
            <p>
                @if($transaction->status === 'success')   Transaksi berhasil diproses
                @elseif($transaction->status === 'failed') Transaksi gagal diproses
                @elseif($transaction->status === 'processing') Transaksi sedang diproses
                @else Menunggu konfirmasi pembayaran
                @endif
            </p>
        </div>
    </div>

    <!-- Detail Produk -->
    <div class="info-card">
        <div class="info-card-title">Detail Produk</div>
        <div class="info-row">
            <span class="lbl">Game</span>
            <span class="val">{{ $transaction->game }}</span>
        </div>
        <div class="info-row">
            <span class="lbl">Produk</span>
            <span class="val">{{ $transaction->item }}</span>
        </div>
        @if($transaction->user_id_game)
        <div class="info-row">
            <span class="lbl">UID / ID Game</span>
            <span class="val mono">{{ $transaction->user_id_game }}</span>
        </div>
        @endif
    </div>

    <!-- Detail Pembayaran -->
    <div class="info-card">
        <div class="info-card-title">Detail Pembayaran</div>
        <div class="info-row">
            <span class="lbl">Metode Pembayaran</span>
            <span class="val">{{ $transaction->paymentLabel() }}</span>
        </div>
        <div class="info-row">
            <span class="lbl">Harga Produk</span>
            <span class="val">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
        </div>
        @if(($transaction->admin_fee ?? 0) > 0)
        <div class="info-row">
            <span class="lbl">Biaya Admin</span>
            <span class="val">Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}</span>
        </div>
        @endif
    </div>

    <!-- Total -->
    <div class="total-row">
        <span class="total-lbl">Total Pembayaran</span>
        <span class="total-val">Rp {{ number_format($transaction->totalAmount(), 0, ',', '.') }}</span>
    </div>

    <!-- Info Transaksi -->
    <div class="info-card">
        <div class="info-card-title">Informasi Transaksi</div>
        <div class="info-row">
            <span class="lbl">Nomor Transaksi</span>
            <span class="val mono">{{ $transaction->invoiceNumber() }}</span>
        </div>
        <div class="info-row">
            <span class="lbl">ID Transaksi</span>
            <span class="val mono">#{{ $transaction->id }}</span>
        </div>
        <div class="info-row">
            <span class="lbl">Status</span>
            <span class="val"><span class="badge {{ $transaction->statusClass() }}">{{ $transaction->statusLabel() }}</span></span>
        </div>
        <div class="info-row">
            <span class="lbl">Tanggal Transaksi</span>
            <span class="val">{{ $transaction->created_at->format('d M Y, H:i:s') }}</span>
        </div>
        <div class="info-row">
            <span class="lbl">Terakhir Diperbarui</span>
            <span class="val">{{ $transaction->updated_at->format('d M Y, H:i:s') }}</span>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('transaksi.index') }}" class="btn-back">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Riwayat
    </a>

</div>

<script src="{{ asset('js/navbar.js') }}"></script>
</body>
</html>

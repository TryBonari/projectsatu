<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldo Akun — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saldo.css') }}">
</head>
<body>

@include('partials.navbar', [
    'activeNav' => 'saldo',
    'showLinks' => true,
    'showUser'  => true,
])

<div class="page">

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stat Cards -->
    <div class="top-cards">
        <div class="stat-card primary">
            <div class="stat-label">Saldo Tersedia</div>
            <div class="stat-value">Rp {{ number_format($user->saldo, 0, ',', '.') }}</div>
            <div class="stat-sub">{{ $user->email }}</div>
        </div>
        <div class="stat-card income">
            <div class="stat-label">Total Masuk</div>
            <div class="stat-value">Rp {{ number_format($totalTopup, 0, ',', '.') }}</div>
            <div class="stat-sub">Seluruh top up saldo</div>
        </div>
        <div class="stat-card spend">
            <div class="stat-label">Total Keluar</div>
            <div class="stat-value">Rp {{ number_format(abs($totalPurchase), 0, ',', '.') }}</div>
            <div class="stat-sub">Seluruh pembelian</div>
        </div>
    </div>

    <!-- Form Top Up Saldo -->
    <div class="topup-card">
        <div class="card-title">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            Top Up Saldo
        </div>

        <form method="POST" action="{{ route('saldo.qris') }}" id="topupForm">
            @csrf
            <div class="topup-form">
                <div class="topup-field">
                    <label for="amount">Nominal Top Up</label>
                    <div class="input-prefix-wrap">
                        <span class="input-prefix">Rp</span>
                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            value="{{ old('amount') }}"
                            placeholder="Contoh: 100000"
                            min="10000"
                            max="10000000"
                            required
                        >
                    </div>
                    @error('amount') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="btn-topup-saldo">
                    <svg viewBox="0 0 24 24"><polyline points="17 11 12 6 7 11"/><line x1="12" y1="18" x2="12" y2="6"/></svg>
                    Top Up
                </button>
            </div>
            <div class="presets">
                @foreach([10000, 25000, 50000, 100000, 200000, 500000] as $preset)
                    <button type="button" class="preset-btn" onclick="setAmount({{ $preset }})">
                        Rp {{ number_format($preset, 0, ',', '.') }}
                    </button>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Riwayat Saldo -->
    <div class="section-title">Riwayat Saldo</div>
    <div class="history-wrap">
        @if($histories->isEmpty())
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
                Belum ada riwayat saldo
            </div>
        @else
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tipe</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Saldo Setelah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $h)
                    <tr>
                        <td class="date-col">{{ $h->created_at->format('d M Y') }}<br>{{ $h->created_at->format('H:i') }}</td>
                        <td>
                            <span class="type-badge type-{{ $h->type }}">
                                @if($h->type === 'topup') ↑ @elseif($h->type === 'purchase') ↓ @else ↩ @endif
                                {{ $h->typeLabel() }}
                            </span>
                        </td>
                        <td class="desc-col">{{ $h->description }}</td>
                        <td class="{{ $h->isCredit() ? 'amount-credit' : 'amount-debit' }}">
                            {{ $h->isCredit() ? '+' : '' }}Rp {{ number_format($h->amount, 0, ',', '.') }}
                        </td>
                        <td class="balance-col">Rp {{ number_format($h->balance_after, 0, ',', '.') }}</td>
                        <td>
                            <span class="status-badge status-{{ $h->status }}">
                                {{ ucfirst($h->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($histories->hasPages())
            <div class="pagination-wrap">
                @if($histories->onFirstPage())
                    <span class="disabled">‹</span>
                @else
                    <a href="{{ $histories->previousPageUrl() }}">‹</a>
                @endif

                @foreach($histories->getUrlRange(1, $histories->lastPage()) as $page => $url)
                    @if($page == $histories->currentPage())
                        <span class="active">{{ $page }}</span>
                    @elseif(abs($page - $histories->currentPage()) <= 2 || $page == 1 || $page == $histories->lastPage())
                        <a href="{{ $url }}">{{ $page }}</a>
                    @elseif(abs($page - $histories->currentPage()) == 3)
                        <span class="dots">…</span>
                    @endif
                @endforeach

                @if($histories->hasMorePages())
                    <a href="{{ $histories->nextPageUrl() }}">›</a>
                @else
                    <span class="disabled">›</span>
                @endif
            </div>
            @endif
        @endif
    </div>

</div>

<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/saldo.js') }}"></script>
</body>
</html>

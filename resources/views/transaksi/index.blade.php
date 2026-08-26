<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi — NexaTopUp</title>
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

<div class="page">

    @if(session('success'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>Riwayat Transaksi</h2>
            <p>Seluruh pembelian top-up yang telah kamu lakukan</p>
        </div>
    </div>

    <!-- Stat Strip -->
    <div class="stat-strip">
        <div class="stat-mini">
            <div class="stat-mini-label">Total Transaksi</div>
            <div class="stat-mini-value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Sukses</div>
            <div class="stat-mini-value green">{{ $stats['success'] }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Diproses</div>
            <div class="stat-mini-value yellow">{{ $stats['pending'] }}</div>
        </div>
        <div class="stat-mini">
            <div class="stat-mini-label">Total Pengeluaran</div>
            <div class="stat-mini-value purple">Rp {{ number_format($stats['spent'], 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('transaksi.index') }}">
        <div class="filter-bar">

            {{-- Pencarian --}}
            <div class="filter-search-wrap">
                <label>Cari</label>
                <div class="filter-search-inner">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input
                        type="text"
                        name="search"
                        class="filter-input"
                        placeholder="ID transaksi atau nama game..."
                        value="{{ request('search') }}"
                    >
                </div>
            </div>

            {{-- Filter Status --}}
            <div class="filter-group">
                <label>Status</label>
                <select name="status" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="success"    {{ request('status') === 'success'    ? 'selected' : '' }}>Sukses</option>
                    <option value="pending"    {{ request('status') === 'pending'    ? 'selected' : '' }}>Menunggu</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="failed"     {{ request('status') === 'failed'     ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>

            {{-- Filter Tanggal Dari --}}
            <div class="filter-group">
                <label>Dari Tanggal</label>
                <input type="date" name="date_from" class="filter-input" value="{{ request('date_from') }}">
            </div>

            {{-- Filter Tanggal Sampai --}}
            <div class="filter-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="date_to" class="filter-input" value="{{ request('date_to') }}">
            </div>

            <button type="submit" class="btn-filter">Terapkan</button>

            @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                <a href="{{ route('transaksi.index') }}" class="btn-reset">Reset</a>
            @endif

        </div>
    </form>

    <!-- Tabel / Empty State -->
    <div class="tx-wrap">
        @if($transactions->isEmpty())
            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
                @if(request()->hasAny(['search','status','date_from','date_to']))
                    <p>Tidak ada transaksi yang sesuai filter</p>
                    <small>Coba ubah filter atau <a href="{{ route('transaksi.index') }}" style="color:#a78bff">reset</a></small>
                @else
                    <p>Belum ada transaksi</p>
                    <small>Mulai top-up game favoritmu dari <a href="{{ route('dashboard') }}" style="color:#a78bff">Dashboard</a></small>
                @endif
            </div>
        @else
            <table class="tx-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game & Produk</th>
                        <th>UID Game</th>
                        <th>Harga</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tx)
                    <tr onclick="window.location='{{ route('transaksi.show', $tx->id) }}'">
                        <td>
                            <span class="tx-id">#{{ $tx->id }}</span>
                        </td>
                        <td>
                            <div class="tx-game">{{ $tx->game }}</div>
                            <div class="tx-item">{{ $tx->item }}</div>
                        </td>
                        <td>
                            <span class="tx-uid">{{ $tx->user_id_game ?? '—' }}</span>
                        </td>
                        <td>
                            <span class="tx-amount">Rp {{ number_format($tx->amount, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="tx-method">{{ $tx->paymentLabel() }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $tx->statusClass() }}">{{ $tx->statusLabel() }}</span>
                        </td>
                        <td>
                            <span class="tx-date">{{ $tx->created_at->format('d M Y') }}<br>{{ $tx->created_at->format('H:i') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($transactions->hasPages())
            <div class="pagination-wrap">
                @if($transactions->onFirstPage())
                    <span class="disabled">‹</span>
                @else
                    <a href="{{ $transactions->previousPageUrl() }}">‹</a>
                @endif

                @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                    @if($page == $transactions->currentPage())
                        <span class="active">{{ $page }}</span>
                    @elseif(abs($page - $transactions->currentPage()) <= 2 || $page == 1 || $page == $transactions->lastPage())
                        <a href="{{ $url }}">{{ $page }}</a>
                    @elseif(abs($page - $transactions->currentPage()) == 3)
                        <span class="dots">…</span>
                    @endif
                @endforeach

                @if($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}">›</a>
                @else
                    <span class="disabled">›</span>
                @endif
            </div>
            @endif
        @endif
    </div>

</div>

<script src="{{ asset('js/navbar.js') }}"></script>
</body>
</html>

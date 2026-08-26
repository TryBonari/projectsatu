<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldo Akun — NexaTopUp</title>
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
            background: radial-gradient(circle, rgba(99,57,255,0.16) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }
        body::after {
            content: ''; position: fixed; bottom: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(0,194,255,0.12) 0%, transparent 70%);
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
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-links a {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 13px; border-radius: 8px; font-size: 13.5px; font-weight: 500;
            color: rgba(255,255,255,0.5); text-decoration: none;
            transition: color 0.2s, background 0.2s;
        }
        .nav-links a svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .nav-links a:hover { color: #ffffff; background: rgba(255,255,255,0.07); }
        .nav-links a.active { color: #a78bff; background: rgba(99,57,255,0.15); }
        .nav-right { display: flex; align-items: center; gap: 12px; }
        .nav-greeting { font-size: 13px; color: rgba(255,255,255,0.45); }
        .nav-greeting strong { color: #ffffff; font-weight: 600; }
        .nav-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, #6339ff, #00c2ff);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff;
            text-decoration: none; transition: opacity 0.2s, box-shadow 0.2s;
        }
        .nav-avatar:hover { opacity: 0.85; box-shadow: 0 0 0 3px rgba(99,57,255,0.4); }
        .btn-logout {
            padding: 7px 14px; border: 1px solid rgba(255,255,255,0.12); border-radius: 8px;
            background: transparent; color: rgba(255,255,255,0.5); font-size: 12.5px;
            font-family: 'Inter', sans-serif; font-weight: 500; cursor: pointer;
            transition: background 0.2s, color 0.2s; display: flex; align-items: center; gap: 6px;
        }
        .btn-logout svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
        .btn-logout:hover { background: rgba(255,255,255,0.07); color: #fff; }
        .nav-mobile-toggle { display: none; }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex; flex-direction: column; align-items: flex-start;
                position: absolute; top: 60px; left: 0; right: 0;
                background: rgba(11,14,26,0.97); border-bottom: 1px solid rgba(255,255,255,0.07);
                padding: 12px 16px; gap: 4px;
            }
            .nav-links.open a { width: 100%; }
            .nav-mobile-toggle {
                display: flex; align-items: center; background: none; border: none;
                color: rgba(255,255,255,0.6); cursor: pointer; padding: 6px;
            }
            .nav-mobile-toggle svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; }
        }

        /* ── Page ── */
        .page { max-width: 860px; margin: 0 auto; padding: 32px 20px 60px; position: relative; z-index: 1; }

        /* ── Alerts ── */
        .alert {
            display: flex; align-items: center; gap: 8px;
            border-radius: 10px; padding: 12px 16px; font-size: 13px; margin-bottom: 24px;
        }
        .alert svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
        .alert-success { background: rgba(34,197,94,0.10);  border: 1px solid rgba(34,197,94,0.25); color: #86efac; }
        .alert-error   { background: rgba(239,68,68,0.12);  border: 1px solid rgba(239,68,68,0.3);  color: #fca5a5; }

        /* ── Top cards ── */
        .top-cards {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 14px;
            margin-bottom: 28px;
        }
        @media (max-width: 640px) { .top-cards { grid-template-columns: 1fr; } }

        .stat-card {
            border-radius: 16px; padding: 20px 22px;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .stat-card.primary {
            background: linear-gradient(135deg, rgba(99,57,255,0.28) 0%, rgba(0,194,255,0.16) 100%);
            border-color: rgba(99,57,255,0.35);
        }
        .stat-card.income { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.2); }
        .stat-card.spend  { background: rgba(239,68,68,0.07);  border-color: rgba(239,68,68,0.18); }
        .stat-label {
            font-size: 11px; font-weight: 600; letter-spacing: 0.7px;
            text-transform: uppercase; margin-bottom: 8px;
        }
        .stat-card.primary .stat-label { color: rgba(255,255,255,0.5); }
        .stat-card.income .stat-label  { color: rgba(74,222,128,0.7); }
        .stat-card.spend  .stat-label  { color: rgba(248,113,113,0.7); }
        .stat-value {
            font-size: 22px; font-weight: 700; letter-spacing: -0.4px; margin-bottom: 2px;
        }
        .stat-card.primary .stat-value { color: #ffffff; }
        .stat-card.income .stat-value  { color: #4ade80; }
        .stat-card.spend  .stat-value  { color: #f87171; }
        .stat-sub { font-size: 11.5px; color: rgba(255,255,255,0.3); }

        /* ── Top-up form card ── */
        .topup-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 22px 24px; margin-bottom: 28px;
        }
        .card-title {
            font-size: 14px; font-weight: 600; color: #ffffff; margin-bottom: 16px;
            display: flex; align-items: center; gap: 8px;
        }
        .card-title svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; color: #a78bff; }

        .topup-form { display: flex; gap: 10px; align-items: flex-end; }
        @media (max-width: 500px) { .topup-form { flex-direction: column; } }

        .topup-field { flex: 1; }
        .topup-field label {
            display: block; font-size: 12px; font-weight: 500;
            color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.3px; margin-bottom: 8px;
        }
        .input-prefix-wrap { position: relative; display: flex; align-items: center; }
        .input-prefix {
            position: absolute; left: 12px;
            font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.4);
            pointer-events: none;
        }
        .topup-field input {
            width: 100%; padding: 11px 14px 11px 42px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px; color: #ffffff; font-size: 14px;
            font-family: 'Inter', sans-serif; outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .topup-field input::placeholder { color: rgba(255,255,255,0.22); }
        .topup-field input:focus { border-color: rgba(99,57,255,0.7); background: rgba(99,57,255,0.07); }
        .field-error { font-size: 11.5px; color: #f87171; margin-top: 5px; }

        .btn-topup-saldo {
            padding: 11px 22px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            color: #ffffff; font-size: 13.5px; font-weight: 700;
            font-family: 'Inter', sans-serif; cursor: pointer; white-space: nowrap;
            transition: opacity 0.2s, transform 0.15s; display: flex; align-items: center; gap: 7px;
        }
        .btn-topup-saldo svg { width: 15px; height: 15px; stroke: currentColor; fill: none; stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round; }
        .btn-topup-saldo:hover  { opacity: 0.88; }
        .btn-topup-saldo:active { transform: scale(0.97); }

        /* Preset amounts */
        .presets { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px; }
        .preset-btn {
            padding: 6px 14px; border: 1px solid rgba(255,255,255,0.1); border-radius: 20px;
            background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.55);
            font-size: 12px; font-family: 'Inter', sans-serif; cursor: pointer;
            transition: background 0.2s, border-color 0.2s, color 0.2s;
        }
        .preset-btn:hover { background: rgba(99,57,255,0.15); border-color: rgba(99,57,255,0.5); color: #a78bff; }

        /* ── Section title ── */
        .section-title {
            font-size: 11px; font-weight: 600; letter-spacing: 0.7px;
            text-transform: uppercase; color: rgba(255,255,255,0.35); margin-bottom: 14px;
        }

        /* ── History table ── */
        .history-wrap {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px; overflow: hidden;
        }
        .history-table { width: 100%; border-collapse: collapse; }
        .history-table th {
            font-size: 11px; font-weight: 600; letter-spacing: 0.5px;
            text-transform: uppercase; color: rgba(255,255,255,0.3);
            padding: 0 14px 10px; text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .history-table td {
            padding: 13px 14px; font-size: 13.5px;
            color: rgba(255,255,255,0.8);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
        }
        .history-table tr:last-child td { border-bottom: none; }
        .history-table tr:hover td { background: rgba(255,255,255,0.02); }

        .type-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;
        }
        .type-topup    { background: rgba(34,197,94,0.15);  color: #4ade80; }
        .type-purchase { background: rgba(239,68,68,0.12);  color: #f87171; }
        .type-refund   { background: rgba(234,179,8,0.15);  color: #facc15; }

        .status-badge {
            display: inline-block; padding: 3px 9px; border-radius: 20px;
            font-size: 11px; font-weight: 600;
        }
        .status-success { background: rgba(34,197,94,0.15);  color: #4ade80; }
        .status-pending { background: rgba(234,179,8,0.15);  color: #facc15; }
        .status-failed  { background: rgba(239,68,68,0.12);  color: #f87171; }

        .amount-credit { font-weight: 700; color: #4ade80; }
        .amount-debit  { font-weight: 700; color: #f87171; }
        .balance-col   { font-weight: 600; color: #ffffff; font-size: 13px; }
        .date-col      { font-size: 12px; color: rgba(255,255,255,0.3); white-space: nowrap; }
        .desc-col      { font-size: 13px; color: rgba(255,255,255,0.65); }

        .empty-state {
            text-align: center; padding: 40px 0;
            color: rgba(255,255,255,0.25); font-size: 13.5px;
        }
        .empty-state svg {
            width: 38px; height: 38px; stroke: rgba(255,255,255,0.15); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            display: block; margin: 0 auto 10px;
        }

        /* ── Pagination ── */
        .pagination-wrap {
            display: flex; justify-content: center; align-items: center;
            gap: 6px; padding: 18px 14px 14px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 34px; height: 34px; padding: 0 10px;
            border-radius: 8px; font-size: 13px; font-weight: 500;
            text-decoration: none; transition: background 0.2s, color 0.2s;
        }
        .pagination-wrap a { color: rgba(255,255,255,0.5); border: 1px solid rgba(255,255,255,0.08); }
        .pagination-wrap a:hover { background: rgba(99,57,255,0.15); border-color: rgba(99,57,255,0.4); color: #a78bff; }
        .pagination-wrap span.active { background: rgba(99,57,255,0.2); border: 1px solid rgba(99,57,255,0.5); color: #a78bff; }
        .pagination-wrap span.dots { color: rgba(255,255,255,0.25); border: none; }

        @media (max-width: 600px) {
            .history-table thead { display: none; }
            .history-table td { display: block; padding: 6px 14px; border-bottom: none; }
            .history-table tr { display: block; border-bottom: 1px solid rgba(255,255,255,0.06); padding: 10px 0; }
            .history-table tr:last-child { border-bottom: none; }
        }
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

    <div class="nav-links" id="navLinks">
        <a href="{{ route('dashboard') }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('saldo') }}" class="active">
            <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Saldo
        </a>
        <a href="#">
            <svg viewBox="0 0 24 24"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
            Transaksi
        </a>
    </div>

    <div class="nav-right">
        <span class="nav-greeting">Hai, <strong>{{ explode(' ', $user->name)[0] }}</strong></span>
        <a href="#" class="nav-avatar" title="Profil">{{ strtoupper(substr($user->name, 0, 1)) }}</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar
            </button>
        </form>
        <button class="nav-mobile-toggle" onclick="document.getElementById('navLinks').classList.toggle('open')" aria-label="Menu">
            <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>
</nav>

<!-- Page -->
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

    <!-- Top Up Form -->
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

    <!-- History -->
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
                {{-- Previous --}}
                @if($histories->onFirstPage())
                    <span style="color:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.06);min-width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">‹</span>
                @else
                    <a href="{{ $histories->previousPageUrl() }}">‹</a>
                @endif

                {{-- Page numbers --}}
                @foreach($histories->getUrlRange(1, $histories->lastPage()) as $page => $url)
                    @if($page == $histories->currentPage())
                        <span class="active">{{ $page }}</span>
                    @elseif(abs($page - $histories->currentPage()) <= 2 || $page == 1 || $page == $histories->lastPage())
                        <a href="{{ $url }}">{{ $page }}</a>
                    @elseif(abs($page - $histories->currentPage()) == 3)
                        <span class="dots">…</span>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($histories->hasMorePages())
                    <a href="{{ $histories->nextPageUrl() }}">›</a>
                @else
                    <span style="color:rgba(255,255,255,0.2);border:1px solid rgba(255,255,255,0.06);min-width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;">›</span>
                @endif
            </div>
            @endif
        @endif
    </div>

</div>

<script>
    function setAmount(val) {
        document.getElementById('amount').value = val;
        document.getElementById('amount').focus();
    }
</script>

</body>
</html>

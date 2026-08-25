<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0b0e1a;
            color: #ffffff;
            min-height: 100vh;
        }

        /* ── Ambient orbs ── */
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
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(11,14,26,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 0 24px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .nav-brand-icon {
            width: 32px; height: 32px;
            border-radius: 9px;
            background: linear-gradient(135deg, #6339ff 0%, #00c2ff 100%);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .nav-brand-icon svg { width: 16px; height: 16px; fill: #fff; }
        .nav-brand span {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.2px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-links a {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: color 0.2s, background 0.2s;
        }
        .nav-links a svg {
            width: 15px; height: 15px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
        }
        .nav-links a:hover,
        .nav-links a.active { color: #ffffff; background: rgba(255,255,255,0.07); }
        .nav-links a.active { color: #a78bff; background: rgba(99,57,255,0.15); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .nav-greeting {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
        }
        .nav-greeting strong { color: #ffffff; font-weight: 600; }
        .nav-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6339ff, #00c2ff);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s, box-shadow 0.2s;
        }
        .nav-avatar:hover {
            opacity: 0.85;
            box-shadow: 0 0 0 3px rgba(99,57,255,0.4);
        }
        .btn-logout {
            padding: 7px 14px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 8px;
            background: transparent;
            color: rgba(255,255,255,0.5);
            font-size: 12.5px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            display: flex; align-items: center; gap: 6px;
        }
        .btn-logout svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.07); color: #fff; }

        /* ── Mobile navbar ── */
        .nav-mobile-toggle { display: none; }
        @media (max-width: 640px) {
            .nav-links { display: none; }
            .nav-links.open {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                position: absolute;
                top: 60px; left: 0; right: 0;
                background: rgba(11,14,26,0.97);
                border-bottom: 1px solid rgba(255,255,255,0.07);
                padding: 12px 16px;
                gap: 4px;
            }
            .nav-links.open a { width: 100%; }
            .nav-mobile-toggle {
                display: flex;
                align-items: center;
                background: none;
                border: none;
                color: rgba(255,255,255,0.6);
                cursor: pointer;
                padding: 6px;
            }
            .nav-mobile-toggle svg {
                width: 20px; height: 20px;
                stroke: currentColor; fill: none;
                stroke-width: 2; stroke-linecap: round;
            }
        }

        /* ── Page layout ── */
        .page {
            max-width: 1060px;
            margin: 0 auto;
            padding: 28px 20px 48px;
            position: relative;
            z-index: 1;
        }

        /* ── Alert success ── */
        .alert-success {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #86efac;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success svg { width:15px; height:15px; stroke:currentColor; fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; flex-shrink:0; }

        /* ── Top row: greeting + saldo ── */
        .top-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: start;
            margin-bottom: 28px;
        }
        .greeting-block h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.3px;
            margin-bottom: 4px;
        }
        .greeting-block p {
            font-size: 13.5px;
            color: rgba(255,255,255,0.4);
        }

        .saldo-card {
            background: linear-gradient(135deg, rgba(99,57,255,0.25) 0%, rgba(0,194,255,0.15) 100%);
            border: 1px solid rgba(99,57,255,0.35);
            border-radius: 14px;
            padding: 16px 22px;
            text-align: right;
            min-width: 200px;
        }
        .saldo-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            margin-bottom: 6px;
        }
        .saldo-value {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .saldo-sub {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            margin-top: 4px;
        }

        @media (max-width: 580px) {
            .top-row { grid-template-columns: 1fr; }
            .saldo-card { text-align: left; min-width: unset; }
        }

        /* ── Section title ── */
        .section-title {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            margin-bottom: 14px;
        }

        /* ── Game grid ── */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 36px;
        }
        .game-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px;
            padding: 18px 14px;
            text-align: center;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s, transform 0.15s;
            text-decoration: none;
            display: block;
        }
        .game-card:hover {
            background: rgba(99,57,255,0.1);
            border-color: rgba(99,57,255,0.4);
            transform: translateY(-2px);
        }
        .game-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto 10px;
            background: rgba(255,255,255,0.06);
        }
        .game-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .game-name {
            font-size: 12.5px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 3px;
        }
        .game-desc {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
        }

        /* ── Transactions ── */
        .tx-table {
            width: 100%;
            border-collapse: collapse;
        }
        .tx-table th {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
            padding: 0 12px 10px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .tx-table td {
            padding: 13px 12px;
            font-size: 13.5px;
            color: rgba(255,255,255,0.8);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
        }
        .tx-table tr:last-child td { border-bottom: none; }
        .tx-table tr:hover td { background: rgba(255,255,255,0.02); }

        .tx-game-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .tx-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .tx-amount { font-weight: 600; color: #ffffff; }

        .badge-status {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-success { background: rgba(34,197,94,0.15); color: #4ade80; }
        .badge-pending { background: rgba(234,179,8,0.15);  color: #facc15; }
        .badge-failed  { background: rgba(239,68,68,0.12);  color: #f87171; }

        .tx-date { font-size: 12px; color: rgba(255,255,255,0.3); }

        .empty-tx {
            text-align: center;
            padding: 36px 0;
            color: rgba(255,255,255,0.25);
            font-size: 13.5px;
        }
        .empty-tx svg {
            width: 36px; height: 36px;
            stroke: rgba(255,255,255,0.15); fill: none;
            stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
            display: block; margin: 0 auto 10px;
        }

        .tx-wrap {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            overflow: hidden;
        }

        @media (max-width: 560px) {
            .tx-table thead { display: none; }
            .tx-table td {
                display: block;
                padding: 8px 14px;
                border-bottom: none;
            }
            .tx-table tr {
                display: block;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                padding: 10px 0;
            }
            .tx-table tr:last-child { border-bottom: none; }
        }
    </style>
</head>
<body>

<!-- ── Navbar ── -->
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">
            <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        </div>
        <span>NexaTopUp</span>
    </a>

    <div class="nav-links" id="navLinks">
        <a href="{{ route('dashboard') }}" class="active">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
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

<!-- ── Page ── -->
<div class="page">

    @if(session('success'))
        <div class="alert-success">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Greeting + Saldo -->
    <div class="top-row">
        <div class="greeting-block">
            <h2>Selamat datang, {{ explode(' ', $user->name)[0] }} 👋</h2>
            <p>{{ $user->email }}</p>
        </div>
        <div class="saldo-card">
            <div class="saldo-label">Saldo Akun</div>
            <div class="saldo-value">Rp {{ number_format($user->saldo, 0, ',', '.') }}</div>
            <div class="saldo-sub">{{ $user->phone ?? 'No HP belum diisi' }}</div>
        </div>
    </div>

    <!-- Game List -->
    <div class="section-title">Top-Up Game</div>
    <div class="game-grid">
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/mobile-legends.png') }}" alt="Mobile Legends">
            </div>
            <div class="game-name">Mobile Legends</div>
            <div class="game-desc">Diamond & Pass</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/free-fire.png') }}" alt="Free Fire">
            </div>
            <div class="game-name">Free Fire</div>
            <div class="game-desc">Diamond</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/pubg.png') }}" alt="PUBG Mobile">
            </div>
            <div class="game-name">PUBG Mobile</div>
            <div class="game-desc">UC</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/genshin.png') }}" alt="Genshin Impact">
            </div>
            <div class="game-name">Genshin Impact</div>
            <div class="game-desc">Genesis Crystal</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/valorant.png') }}" alt="Valorant">
            </div>
            <div class="game-name">Valorant</div>
            <div class="game-desc">VP</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/honkai-sr.png') }}" alt="Honkai: SR">
            </div>
            <div class="game-name">Honkai: SR</div>
            <div class="game-desc">Oneiric Shard</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/cod.png') }}" alt="COD Mobile">
            </div>
            <div class="game-name">COD Mobile</div>
            <div class="game-desc">CP</div>
        </a>
        <a href="#" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/coc.png') }}" alt="Clash of Clans">
            </div>
            <div class="game-name">Clash of Clans</div>
            <div class="game-desc">Gems</div>
        </a>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="section-title">Transaksi Terbaru</div>
    <div class="tx-wrap">
        @if($transactions->isEmpty())
            <div class="empty-tx">
                <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
                Belum ada transaksi
            </div>
        @else
            <table class="tx-table">
                <thead>
                    <tr>
                        <th>Game</th>
                        <th>Item</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tx)
                    <tr>
                        <td>
                            <span class="tx-game-badge">
                                <span class="tx-dot" style="background:#6339ff"></span>
                                {{ $tx->game }}
                            </span>
                        </td>
                        <td>{{ $tx->item }}</td>
                        <td class="tx-amount">Rp {{ number_format($tx->amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge-status badge-{{ $tx->status }}">
                                {{ ucfirst($tx->status) }}
                            </span>
                        </td>
                        <td class="tx-date">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>

</body>
</html>

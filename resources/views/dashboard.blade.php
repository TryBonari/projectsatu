<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar', [
    'activeNav' => 'dashboard',
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

    <!-- Greeting + Saldo -->
    <div class="top-row">
        <div class="greeting-block">
            <h2>Selamat datang, {{ explode(' ', $user->name)[0] }} 👋</h2>
            <p>{{ $user->email }}</p>
        </div>
        <a href="{{ route('saldo') }}" class="saldo-card" style="text-decoration:none;display:block;">
            <div class="saldo-label">Saldo Akun</div>
            <div class="saldo-value">Rp {{ number_format($user->saldo, 0, ',', '.') }}</div>
            <div class="saldo-sub">Klik untuk kelola saldo →</div>
        </a>
    </div>

    <!-- Game List -->
    <div class="section-title">Top-Up Game</div>
    <div class="game-grid">
        <a href="{{ route('topup.ml') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/mobile-legends.png') }}" alt="Mobile Legends">
            </div>
            <div class="game-name">Mobile Legends</div>
            <div class="game-desc">Diamond & Pass</div>
        </a>
        <a href="{{ route('topup.ff') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/freefire.png') }}" alt="Free Fire">
            </div>
            <div class="game-name">Free Fire</div>
            <div class="game-desc">Diamond</div>
        </a>
        <a href="{{ route('topup.genshin') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/genshin.png') }}" alt="Genshin Impact">
            </div>
            <div class="game-name">Genshin Impact</div>
            <div class="game-desc">Genesis Crystal</div>
        </a>
        <a href="{{ route('topup.pubg') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/pubg.png') }}" alt="PUBG Mobile">
            </div>
            <div class="game-name">PUBG Mobile</div>
            <div class="game-desc">UC</div>
        </a>
        <a href="{{ route('topup.valorant') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/valorant.png') }}" alt="Valorant">
            </div>
            <div class="game-name">Valorant</div>
            <div class="game-desc">VP</div>
        </a>
        <a href="{{ route('topup.honkai') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/honkai-sr.png') }}" alt="Honkai: SR">
            </div>
            <div class="game-name">Honkai: SR</div>
            <div class="game-desc">Oneiric Shard</div>
        </a>
        <a href="{{ route('topup.cod') }}" class="game-card">
            <div class="game-icon">
                <img src="{{ asset('images/games/cod.png') }}" alt="COD Mobile">
            </div>
            <div class="game-name">COD Mobile</div>
            <div class="game-desc">CP</div>
        </a>
        <a href="{{ route('topup.coc') }}" class="game-card">
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

<script src="{{ asset('js/navbar.js') }}"></script>
</body>
</html>

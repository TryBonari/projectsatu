{{--
    partials/navbar.blade.php
    Navbar universal NexaTopUp.

    Props opsional (dioper via @include atau component):
      $activeNav  — string: 'dashboard' | 'saldo' | 'transaksi' (default: null)
      $showLinks  — bool: tampilkan nav-links tengah (default: true)
      $showUser   — bool: tampilkan greeting + avatar + logout (default: true)
      $backLink   — string URL: tampilkan tombol "Kembali" (default: null)
      $saldoLabel — string: tampilkan saldo mini di kanan (default: null, mis. untuk topup)
--}}

@php
    $activeNav  = $activeNav  ?? null;
    $showLinks  = $showLinks  ?? true;
    $showUser   = $showUser   ?? true;
    $backLink   = $backLink   ?? null;
    $saldoLabel = $saldoLabel ?? null;
@endphp

<nav class="navbar">
    {{-- Brand / logo --}}
    <a href="{{ route('dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">
            <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
        </div>
        <span>NexaTopUp</span>
    </a>

    {{-- Link tengah --}}
    @if($showLinks)
    <div class="nav-links" id="navLinks">
        <a href="{{ route('dashboard') }}" class="{{ $activeNav === 'dashboard' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('transaksi.index') }}" class="{{ $activeNav === 'transaksi' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
            Transaksi
        </a>
        <a href="{{ route('saldo') }}" class="{{ $activeNav === 'saldo' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
            Saldo
        </a>
       
    </div>
    @endif

    {{-- Kanan: user info ATAU tombol kembali --}}
    <div class="nav-right">

        @if($saldoLabel)
            <span class="nav-saldo">Saldo: <strong>{{ $saldoLabel }}</strong></span>
        @endif

        @if($backLink)
            <a href="{{ $backLink }}" class="nav-back">
                <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                Kembali
            </a>
        @elseif($showUser && isset($user))
            <span class="nav-greeting">Hai, <strong>{{ explode(' ', $user->name)[0] }}</strong></span>
            <a href="#" class="nav-avatar" title="Profil">{{ strtoupper(substr($user->name, 0, 1)) }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Keluar
                </button>
            </form>
        @endif

        {{-- Mobile toggle (hanya jika ada nav-links) --}}
        @if($showLinks)
        <button class="nav-mobile-toggle" id="navToggle" aria-label="Menu">
            <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
        @endif

    </div>
</nav>

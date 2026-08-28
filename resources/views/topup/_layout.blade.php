{{--
    topup/_layout.blade.php
    Layout generik halaman top-up game.

    Required: $user, $packages, $gameName, $gameImage, $gameDesc,
              $gameIdLabel, $gameIdPlaceholder, $gameIdHint, $processRoute
    Optional: $needsZoneId (bool)
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up {{ $gameName }} — NexaTopUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('css/topup.css') }}">
</head>
<body>

@include('partials.navbar', [
    'showLinks'  => false,
    'showUser'   => false,
    'backLink'   => route('dashboard'),
    'saldoLabel' => 'Rp ' . number_format($user->saldo, 0, ',', '.'),
])

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

    <!-- Hero Game -->
    <div class="hero">
        <div class="hero-img">
            <img src="{{ asset($gameImage) }}" alt="{{ $gameName }}">
        </div>
        <div class="hero-info">
            <h1>{{ $gameName }}</h1>
            <p>{{ $gameDesc }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route($processRoute) }}">
        @csrf

        <!-- ID Akun -->
        <div class="section-label">Masukkan ID Akun</div>
        <div class="id-row">
            <div class="field">
                <label for="user_id_game">{{ $gameIdLabel }}</label>
                <input
                    type="text"
                    id="user_id_game"
                    name="user_id_game"
                    value="{{ old('user_id_game') }}"
                    placeholder="{{ $gameIdPlaceholder }}"
                    maxlength="100"
                    required
                >
                <p class="field-hint">{{ $gameIdHint }}</p>
                @error('user_id_game') <p class="field-error-msg">{{ $message }}</p> @enderror
            </div>

            @if(!empty($needsZoneId))
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
                <p class="field-hint">Zone ID ada di bawah User ID, dipisah ( ).</p>
                @error('zone_id') <p class="field-error-msg">{{ $message }}</p> @enderror
            </div>
            @endif
        </div>

        <!-- Pilih Paket -->
        <div class="section-label">Pilih Nominal</div>
        <div class="pkg-grid" id="pkgGrid">
            @foreach($packages as $pkg)
                <label class="pkg-card {{ old('package_id') == $pkg['id'] ? 'selected' : '' }}"
                       data-amount="{{ $pkg['amount'] }}">
                    <input
                        type="radio"
                        name="package_id"
                        value="{{ $pkg['id'] }}"
                        {{ old('package_id') == $pkg['id'] ? 'checked' : '' }}
                        required
                    >
                    <div class="pkg-label">{{ $pkg['label'] }}</div>
                    <div class="pkg-price">Rp {{ number_format($pkg['amount'], 0, ',', '.') }}</div>
                </label>
            @endforeach
        </div>

        <!-- Jumlah Pembelian -->
        <div class="section-label">Jumlah Pembelian</div>
        <div class="qty-row">
            <div class="qty-wrap">
                <button type="button" class="qty-btn" id="qtyMinus" aria-label="Kurangi">
                    <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
                <input type="number" name="quantity" id="qtyInput"
                       value="{{ old('quantity', 1) }}" min="1" max="10" readonly>
                <button type="button" class="qty-btn" id="qtyPlus" aria-label="Tambah">
                    <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </button>
            </div>
            <div class="qty-total">
                Total: <span id="qtyTotal">—</span>
            </div>
        </div>
        @error('quantity') <p class="field-error-msg" style="margin-bottom:16px">{{ $message }}</p> @enderror

        <button type="submit" class="btn-topup">Beli Sekarang</button>
    </form>

</div>

<script src="{{ asset('js/topup.js') }}"></script>
</body>
</html>

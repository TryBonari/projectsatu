@include('topup._layout', [
    'gameImage'         => 'images/games/cod.png',
    'gameDesc'          => 'Top-up CP (COD Points) langsung ke akun kamu',
    'gameIdLabel'       => 'ID Akun COD Mobile',
    'gameIdPlaceholder' => 'Contoh: COD1234567',
    'gameIdHint'        => 'Buka game → Profil → salin ID di bawah nama karakter.',
    'processRoute'      => 'topup.cod.process',
    'needsZoneId'       => false,
])

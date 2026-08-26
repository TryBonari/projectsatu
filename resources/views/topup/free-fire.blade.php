@include('topup._layout', [
    'gameImage'         => 'images/games/free-fire.png',
    'gameDesc'          => 'Top-up Diamond & Weekly Pass langsung ke akun kamu',
    'gameIdLabel'       => 'ID Akun Free Fire',
    'gameIdPlaceholder' => 'Contoh: 123456789',
    'gameIdHint'        => 'Buka game → Profil → salin ID yang ada di bawah nama.',
    'processRoute'      => 'topup.ff.process',
    'needsZoneId'       => false,
])

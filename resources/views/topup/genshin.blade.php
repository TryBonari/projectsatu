@include('topup._layout', [
    'gameImage'         => 'images/games/genshin.png',
    'gameDesc'          => 'Top-up Genesis Crystal langsung ke akun kamu',
    'gameIdLabel'       => 'UID Genshin Impact',
    'gameIdPlaceholder' => 'Contoh: 800000000',
    'gameIdHint'        => 'Buka game → Paimon Menu → Account → UID di pojok kanan bawah.',
    'processRoute'      => 'topup.genshin.process',
    'needsZoneId'       => false,
])
